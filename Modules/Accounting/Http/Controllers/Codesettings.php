<?php

namespace Modules\Accounting\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Accounting\Entities\CodeSettingsView;
use Modules\Accounting\Entities\CodeSetting;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;


class Codesettings extends Controller
{
    public function index($type, Request $request)
    {


        if ($request->ajax()) {
            $query = CodeSettingsView::select('id', 'breadcrumb', 'is_main', 'code')
            ->where('type', CodeSetting::getTypeEnum($type));
            return DataTables::of($query)->make(true);
        }


        $viewData=['pageTitle'=>__('accounting.codesettings').' | '.ucfirst(__('accounting.'.$type)),
        'contentHeaderTitle'=>ucfirst(__('accounting.codesettings')).' - '.ucfirst(__('accounting.'.$type))];
        $viewData['type']=$type;


        return view('accounting::codesettings.index')->with('viewData', $viewData);
    }


    public function destroy($type, $id = 'notdefinied')
    {


        $code = CodeSetting::findOrFail($id);
        $code->delete();

        return redirect(route('accounting::codesettings.index', $type))
        ->with('success', __('accounting.codesettings.deleteSuccess'));
    }


    public function create($type)
    {


        $viewData=['pageTitle'=>__('accounting.codesettings').' | '.__('accounting.add'),
        'contentHeaderTitle'=>ucfirst(__('accounting.codesettings')).' - '.__('accounting.add')];
        $viewData['type']=$type;


        return view('accounting::codesettings.create')->with('viewData', $viewData);
    }


    public function store(Request $request, $type)
    {


        $request->validate([
                'parentCode' => 'required_without:parentCodeSearch',
                'parentCodeSearch' => 'required_without:parentCode|max:45',
                'childrenCodes'=>'sometimes|array|min:1',
                'childrenCodes.*'=>'required|string|max:45|min:1'
                        ]);

        if(!empty($request->input('parentCode')))
        {
            $request->validate(
                [
                    'parentCode'=>'exists:App\Models\Accounting\CodeSetting,id'
                ]
                );

            $parentCode=CodeSetting::find($request->input('parentCode'));

            if(!CodeSetting::verifyType($type))
            {
                throw ValidationException::withMessages([__('accounting.codesettingsUnexcepectedError')]);
            }
        }
        else
        {
            try
            {
                $is_main=!is_null($request->input('childrenCodes'))?'1':'0';
                $parentCode=CodeSetting::create(
                    [
                        'name'=>$request->input('parentCodeSearch'),
                        'type'=>CodeSetting::getTypeEnum($type),
                        'is_main'=>$is_main
                    ]
                );
            }
            catch(Exception $e)
            {
                throw ValidationException::withMessages([__('accounting.codesettingsUnexcepectedError')]);
            }
        }

        $maximumChilren= 5 - (int)$parentCode->level;

        if(!is_null($request->input('childrenCodes')))
        {
            $childrenCodes=$request->input('childrenCodes');
            $maximumChilren=$maximumChilren>count($childrenCodes)?count($childrenCodes):$maximumChilren;
            $childrenCodes=array_splice($childrenCodes,0,$maximumChilren);
            $lastID=$parentCode->id;

            DB::beginTransaction();

            try
            {
                foreach($childrenCodes as $key=>$code)
                {
                    $is_main= $key === array_key_last($childrenCodes)?'0':'1';

                    if($maximumChilren>0)
                    {
                        $lastID=DB::table('code_settings')->insertGetId(['name'=>$code,'code_Settings_id'=>$lastID,
                                                            'is_main'=>$is_main,'type' => CodeSetting::getTypeEnum($type)
                                                            ,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
                    }
                }

                DB::commit();
            }
            catch (Exception $e)
            {
                DB::rollback();
                throw $e;
            }


        }
            return redirect(route('accounting.codesettings.index', $type))
            ->with('success', __('accounting.codesettings.storesuccess'));
    }


    public function search($type, $searchType, Request $request)
    {
        if (!in_array($searchType, ['main','notmain'])) {
            abort(404);
            die();
        }

        if (!is_null($request->input('key')) && !empty($request->input('key'))) {
            $query['data'] = CodeSettingsView::orderby("breadcrumb", "asc")
            ->select('id', 'code', 'breadcrumb')
            ->where('type','=',CodeSetting::getTypeEnum($type))
            ->where('is_main','=',($searchType=='main')?'1':'0')
            ->where('level','<','05')
            ->where(function($query) use ($request){
                return $query->where('breadcrumb', 'like', '%' . $request->input('key') . '%',)
                ->orWhere('code', 'like', '%' . $request->input('key') . '%');
            })
            ->limit(50)
            ->get();
        } else {
            $query['data']=null;
        }

        return response()->json($query);
    }
}
