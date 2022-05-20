<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Accounting\BudgetTerm;
use App\Models\Accounting\CodeSettingsView;
use App\Models\Accounting\TermItem;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\ValidationException;

class BudgetTerms extends Controller
{
    public function index($type, Request $request)
    {

        if ($request->ajax()) {

            $query = BudgetTerm::select('id', 'name')
            ->withCount('items')
            ->where('type', ($type=='revenue')?'REVEN':'EXPEN');
            
            return DataTables::of($query)
            ->make(true);
        }
        
        
        $viewData=['pageTitle'=>__('accounting.budgetTerms').' | '.ucfirst(__('accounting.'.$type)),
        'contentHeaderTitle'=>ucfirst(__('accounting.budgetTerms')).' - '.ucfirst(__('accounting.'.$type))];
        $viewData['type']=$type;

        
        return view('accounting.budgetterms.index')->with('viewData', $viewData);
    }

    public function destroy($type, $id = 'notdefinied')
    {

        $term = BudgetTerm::findOrFail($id);
        $term->delete();

        return redirect(route('accounting.budgetterms.index', $type))
        ->with('success', __('accounting.budgetterms.deleteSuccess'));
    }

    public function create($type)
    {

        $viewData=['pageTitle'=>__('accounting.budgetTermsAdd').' | '.ucfirst(__('accounting.'.$type)),
        'contentHeaderTitle'=>ucfirst(__('accounting.budgetTermsAdd')).' - '.ucfirst(__('accounting.'.$type))];
        $viewData['type']=$type;
        return view('accounting.budgetterms.create')->with('viewData', $viewData);

    }

    public function store(Request $request, $type)
    {

        $term=new BudgetTerm();
        $term->validate($request,$type);
        
        try
        {
            $term=BudgetTerm::create(
                [
                    'name'=> $request->input('name'),
                    'type'=> ($type=='revenue')?'REVEN':'EXPEN'
                ]
                );
    
            
            foreach($request->input('codes') as $code)
            {
                TermItem::create(
                    [
                        'code_setting_id' => $code,
                        'budget_term_id'=> $term['id']
                    ]
                    );
            }
    
        }
        catch(Exception $e)
        {

            throw ValidationException::withMessages([__('accounting.budgetTermUnexcepectedError')]);
            
        }

        return redirect(route('accounting.budgetterms.index', $type))
        ->with('success', __('accounting.budgetterms.storesuccess'));

    }

    public function edit($type,$id,Request $request)
    {

        $term = BudgetTerm::findOrFail($id);

        $items = TermItem::where('budget_term_id', $id)->get();

        $viewData=['pageTitle'=>__('accounting.budgetTermsEdit').' | '.ucfirst(__('accounting.'.$type)),
        'contentHeaderTitle'=>ucfirst(__('accounting.budgetTermsEdit')).' - '.ucfirst(__('accounting.'.$type))];
        $viewData['type']=$type;
        $viewData['term']=$term;
        $viewData['items']=$items;

        return view('accounting.budgetterms.edit')->with('viewData', $viewData);

    }

    public function update($type,$id,Request $request)
    {
        $term=BudgetTerm::findOrFail($id);
        $term->validate($request,$type,$id);
        $term->setName($request->input('name'));
        $term->save();
        if(!is_null($request->input('codes')))
        {
            foreach($request->input('codes') as $code)
            {
                try
                {
                    TermItem::create(
                        [
                            'code_setting_id' => $code,
                            'budget_term_id'=> $term['id']
                        ]
                        );
    
                }
                catch(Exception $e)
                {
        
                    throw ValidationException::withMessages([__('accounting.budgetTermUnexcepectedError')]);
                    
                }
            }    
        }


        return redirect(route('accounting.budgetterms.index', $type))
        ->with('success', __('accounting.budgetterms.editsuccess'));
    }



    public function destroyItem($type,$termID,$itemID)
    {
        $term=BudgetTerm::findOrFail($termID);
        $item=TermItem::findOrFail($itemID);
        $item->delete();

        return redirect(route('accounting.budgetterms.edit', [$type, $termID]))
        ->with('success', __('accounting.budgetterms.itemDestroyed'));
    }




    public function misc($type, Request $request)
    {

        if ($request->ajax()) {

            $exclude=array_merge(TermItem::pluck('code_setting_id')->toArray());

            $query = CodeSettingsView::select('id', 'code', 'breadcrumb')
            ->where('type', ($type=='revenue')?'REVEN':'EXPEN')
            ->where('is_main', '0')
            ->whereNotIn('id',$exclude);

            return DataTables::of($query)->make(true);
        }
        
        
        $viewData=['pageTitle'=>__('accounting.budgetTerms').' | '.ucfirst(__('accounting.misc')),
        'contentHeaderTitle'=>ucfirst(__('accounting.budgetTerms')).' - '.ucfirst(__('accounting.misc').' - '.ucfirst(__('accounting.'.$type)))];
        $viewData['type']=$type;
        
        return view('accounting.budgetterms.misc')->with('viewData', $viewData);
    }

    public function miscStore($type, Request $request)
    {
        
        $request->validate(
               [
                'add_to_existing' => 'required|boolean',
                'name'=>'required|max:120',
                'term'=>'required_if:add_to_existing,true',
                'codes'=>'required'
               ]

             );

        
        if($request->input('add_to_existing'))
        {
            $request->validate(
                [
                    'term'=>'required|exists:App\Models\Accounting\BudgetTerm,id'
                ]

                );

            return $this->update($type,$request->input('term'),$request);

        }   
        else
        {

            return $this->store($request,$type);

        } 
    }



    public function ajax(Request $request,$type,$operation)
    {
        switch($operation)
        {
            case 'codeSearch':
                $request->validate([
                    'exclude'=>'required',
                    'key'=>'required'
                ]);

                $exclude=is_null(json_decode($request->input('exclude')))?[]:json_decode($request->input('exclude'));
                $exclude=array_merge($exclude,TermItem::pluck('code_setting_id')->toArray());

                $query=CodeSettingsView::select('id','breadcrumb','code')
                ->where('type', ($type=='revenue')?'REVEN':'EXPEN')
                ->where('is_main', '0')
                ->where(function($query) use ($request){
                    return $query->where('breadcrumb', 'like', '%' . $request->input('key') . '%',)
                    ->orWhere('code', 'like', '%' . $request->input('key') . '%');
                })
                ->whereNotIn('id',$exclude)
                ->limit(100)
                ->get();

                return response()->json($query);
        
            break;
            
            case 'searchTerm':

                $request->validate([
                    'key'=>'required'
                ]);

                $query=BudgetTerm::select('id','name')
                ->where('type', ($type=='revenue')?'REVEN':'EXPEN')
                ->where('name', 'like', '%' . $request->input('key') . '%',)
                ->limit(100)
                ->get();

                return response()->json($query);

            break;

            default:
                abort(404);
                die();
            break;
        }
    }
}
