<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Accounting\CodeSetting;
use Illuminate\Http\Request;
use App\Models\Accounting\DailyRecordsView;
use App\Models\Accounting\DailyRecords;
use App\Models\Accounting\CodeSettingsView;
use App\Models\Accounting\DailyRecordsEntrie;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;
use PDF;
class Dailyrecord extends Controller
{
    public function index($type, Request $request)
    {


        if ($request->ajax()) {
            $query = DailyRecordsView::select('id', 'date','excerpt','dept', 'credit', 'total')
            ->where('type', ($type=='revenue')?'REVEN':'EXPEN');
            return DataTables::of($query)->make(true);
        }


        $viewData=['pageTitle'=>__('accounting.dailyrecords').' | '.ucfirst(__('accounting.'.$type)),
        'contentHeaderTitle'=>ucfirst(__('accounting.dailyrecords')).' - '.ucfirst(__('accounting.'.$type))];
        $viewData['type']=$type;


        return view('accounting.dailyrecords.index')->with('viewData', $viewData);
    }


    public function destroy($type, $id = 'notdefinied')
    {


        $code = DailyRecords::findOrFail($id);
        $code->delete();

        return redirect(route('accounting.dailyrecords.index', $type))
        ->with('success', __('accounting.dailyrecords.deleteSuccess'));
    }

    public function print($id='notdefinied')
    {
        $record=DailyRecordsView::findOrFail($id);
        $documentFileName = 'DailyRecord_'.$record['type']=='REVEN'?'Revenue':'Expenses'.'_'.$record['date'].'.pdf';

        $view = View::make('accounting.dailyrecords.invoice',['record'=>$record,'type'=>$record['type']=='REVEN'?__('accounting.revenue'):__('accounting.expenses')]);
        $html_content = $view->render();
        PDF::SetFont('aefurat', '', 10);
        //PDF::setRTL(true);
        PDF::SetTitle('Daily '.$record['type']=='REVEN'?'Revenue':'Expenses'.' Record Report - '.$record['date']);
        PDF::AddPage('P', 'A4');
        PDF::writeHTML($html_content, true, false, true, false, '');
        return PDF::Output($documentFileName);
    }

    public function create($type)
    {


        $viewData=['pageTitle'=>__('accounting.dailyrecords').' | '.__('accounting.add'),
        'contentHeaderTitle'=>ucfirst(__('accounting.dailyrecords')).' - '.__('accounting.add')];
        $viewData['type']=$type;


        return view('accounting.dailyrecords.create')->with('viewData', $viewData);
    }

    public function store(Request $request,$type)
    {


        $request->validate(
            [
                'date'=>'required|date|before_or_equal:today',
                'codes'=>'required|array',
                'codes.*'=>'exists:App\Models\Accounting\CodeSetting,id',
                'accounts'=>'required|array',
                'accounts.*'=>'exists:App\Models\Accounting\CodeSetting,id',
                'credit'=>'required|array',
                'credit.*'=>'numeric',
                'debt'=>'required|array',
                'debt.*'=>'numeric',
            ]
            );


            try
            {
                $record=DailyRecords::create([
                    'date'=>$request->input('date'),
                    'type' => ($type=='revenue')?'REVEN':'EXPEN',
                    'description'=>$request->input('description')
                ]);

                for ($i=0;$i<count($request->input('codes'));$i++)
                {
                    DailyRecordsEntrie::create(
                        [
                            'daily_records_id'=>$record['id'],
                            'code_settings_id'=>$request->input('codes')[$i],
                            'account_id'=>$request->input('accounts')[$i],
                            'credit'=>$request->input('credit')[$i],
                            'dept'=>$request->input('debt')[$i],
                        ]);
                }
            }
            catch(Exception $e)
            {
                throw ValidationException::withMessages([__('accounting.codesettingsUnexcepectedError')]);
            }

            return redirect(route('accounting.dailyrecords.index', $type))
            ->with('success', __('accounting.dailyrecords.storesuccess'));
    }


    public function edit($type,$id=null)
    {
        $record=DailyRecordsView::findOrFail($id);

        $viewData=['pageTitle'=>__('accounting.dailyrecords').' | '.__('accounting.edit'),
        'contentHeaderTitle'=>ucfirst(__('accounting.dailyrecords')).' - '.__('accounting.edit')];
        $viewData['type']=$type;

        return View('accounting.dailyrecords.edit',['viewData'=>$viewData,'record'=>$record]);
    }

    public function preview($id=null)
    {
        $record=DailyRecordsView::findOrFail($id);

        $viewData=['pageTitle'=>__('accounting.dailyrecords').' | '.__('accounting.preview'),
        'contentHeaderTitle'=>ucfirst(__('accounting.dailyrecords')).' - '.__('accounting.preview')];
       

        return View('accounting.dailyrecords.preview',['viewData'=>$viewData,'record'=>$record]);
    }


    public function update($type,$id,Request $request)
    {

        $record=DailyRecords::findOrFail($id);

        $request->validate(
            [
                'oldEntries'=>'required_without:codes|array',
                'oldEntries.*'=>'exists:App\Models\Accounting\DailyRecordsEntrie,id',
                'oldCredit'=>'required_with:oldEntries|array',
                'oldCredit.*'=>'numeric',
                'oldDebt'=>'required_with:oldEntries|array',
                'oldDebt.*'=>'numeric',
                'codes'=>'required_without:oldEntries|array',
                'codes.*'=>'exists:App\Models\Accounting\CodeSetting,id',
                'accounts'=>'required_with:codes|array',
                'accounts.*'=>'exists:App\Models\Accounting\CodeSetting,id',
                'credit'=>'required_with:codes|array',
                'credit.*'=>'numeric',
                'debt'=>'required_with:codes|array',
                'debt.*'=>'numeric',
            ]
            );

            //updating description
            $record->description=$request->input('description');
            $record->save();

         //updating old entries

            try

            {
                
                $oRecordsInput=is_null($request->input('oldEntries'))||empty($request->input('oldEntries'))?[]:$request->input('oldEntries');
              
                //deleting non-existing records
                DailyRecordsEntrie::whereNotIn('id',$oRecordsInput)->where('daily_records_id','=',$record->id)->delete();

                if(!is_null($request->input('oldEntries')) && !empty($request->input('oldEntries')) )
                {
                    //handling old records
                    $oldRecords=DailyRecordsEntrie::whereIn('id', $oRecordsInput)->where('daily_records_id','=',$record->id)->get();

                    $i=0;

                    foreach($oldRecords as $oRecord)
                    {
                        $oRecord->credit=$request->input('oldCredit')[$i];
                        $oRecord->dept=$request->input('oldDebt')[$i];
                        $oRecord->save();
                        $i++;
                    }
                }
            }
            catch (Exception $e)
            {
                throw ValidationException::withMessages([__('accounting.codesettingsUnexcepectedError').$e]);
            }


            //handling New entries


            //handling new records
            if(!is_null($request->input('codes')) && !empty($request->input('codes')))
            {

                try 
                {
    
                    for ($i=0;$i<count($request->input('codes'));$i++)
                    {
                        DailyRecordsEntrie::create(
                            [
                                'daily_records_id'=>$record->id,
                                'code_settings_id'=>$request->input('codes')[$i],
                                'account_id'=>$request->input('accounts')[$i],
                                'credit'=>$request->input('credit')[$i],
                                'dept'=>$request->input('debt')[$i],
                            ]);
                    }
                }
                catch(Exception $e)
                {
                    throw ValidationException::withMessages([__('accounting.codesettingsUnexcepectedError')]);
                }
        
            }

            return redirect(route('accounting.dailyrecords.edit', [$type,$id]))
            ->with('success', __('accounting.dailyrecords.editsuccess'));

    }

    public function ajax(Request $request,$type,$operation)
    {


        switch($operation)
        {
            case 'validateDate':
                $request->validate([
                    'date'=>'required|date'
                ]
                );

                $recordExist=DailyRecords::where('type', ($type=='revenue')?'REVEN':'EXPEN')
                ->where('date',$request->input('date'))->exists();

                return response(['exists'=>$recordExist?true:false]);
            break;



            case 'selCode':

                $search = $request->search;

                if($search == ''){
                    $records = CodeSettingsView::orderby("breadcrumb", "asc")
                    ->select('id', 'code', 'breadcrumb')
                    ->where('type','=',CodeSetting::getTypeEnum($type))
                    ->where('is_main','=','0')
                    ->limit(15)
                    ->get();

                }else{

                $records = CodeSettingsView::orderby("breadcrumb", "asc")
                ->select('id', 'code', 'breadcrumb')
                ->where('type','=',CodeSetting::getTypeEnum($type))
                ->where('is_main','=','0')
                ->where(function($query) use ($request){
                    return $query->where('breadcrumb', 'like', '%' . $request->input('search') . '%',)
                    ->orWhere('code', 'like', '%' . $request->input('search') . '%');
                })
                ->limit(50)
                ->get();
                }

                $response = array();
                foreach($records as $record){
                   $response[] = array(
                        "id"=>$record->id,
                        "text"=>$record->code.' - '. $record->breadcrumb
                   );
                }


                return response()->json($response);

            break;


            default:
                abort(404);
            break;

        }
    }
}
