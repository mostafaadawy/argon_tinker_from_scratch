<?php

namespace Modules\Accounting\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Accounting\Entities\BudgetTerm;
use Modules\Accounting\Entities\CodeSettingsView;
use Modules\Accounting\Entities\TermItem;
use PDF;
use Illuminate\Support\Facades\View;

class Report extends Controller
{
    public function index()
    {
        return view('accounting::report.index')->with('viewData', ['pageTitle'=>__('accounting.report'), 'contentHeaderTitle'=>__('accounting.generateReport')]);
    }

    public function generate(Request $request)
    {
        $request->validate(
            [
                'startDate' => 'required|date|before_or_equal:endDate',
                'endDate' => 'required|date|after_or_equal:startDate',
            ]
        );

        $revenueTerms=BudgetTerm::where('type','REVEN')->get();
        $expensesTerms=BudgetTerm::where('type','EXPEN')->get();


        $includeRevenueMisc=is_null($request->input('revenueMisc'))?false:true;
        $includeExpensesMisc=is_null($request->input('expensesMisc'))?false:true;
        $advancedReport=is_null($request->input('advancedReport'))?false:true;


        if($includeRevenueMisc || $includeExpensesMisc)
        {
            $exclude=array_merge(TermItem::pluck('code_setting_id')->toArray());
        }

        if($includeRevenueMisc)
        {

            $revenueMisc=CodeSettingsView::where('type','REVEN')
            ->where('is_main','0')
            ->whereNotIN('id',$exclude)
            ->get();

            $revenMiscTerm=['name'=>__('accounting.misc'),'totalCredit'=>0,'totalDept'=>0,'total'=>0,'subCodes'=>[]];

            foreach($revenueMisc as $code)
            {
                $report=$code->getPeriodReport($request);
                $revenMiscTerm['totalCredit']+=$report['report']['totalCredit'];
                $revenMiscTerm['totalDept']+=$report['report']['totalDept'];
                array_push($revenMiscTerm['subCodes'],$report);
            }

            $revenMiscTerm['total']=$revenMiscTerm['totalCredit']-$revenMiscTerm['totalDept'];

        }

        if($includeExpensesMisc)
        {
            $expensesMisc=CodeSettingsView::where('type','EXPEN')
            ->where('is_main','0')
            ->whereNotIN('id',$exclude)
            ->get();

            $expenMiscTerm=['name'=>__('accounting.misc'),'totalCredit'=>0,'totalDept'=>0,'total'=>0,'subCodes'=>[]];

            foreach($expensesMisc as $code)
            {
                $report=$code->getPeriodReport($request);
                $expenMiscTerm['totalCredit']+=$report['report']['totalCredit'];
                $expenMiscTerm['totalDept']+=$report['report']['totalDept'];
                array_push($expenMiscTerm['subCodes'],$report);
            }

            $expenMiscTerm['total']=$expenMiscTerm['totalCredit']-$expenMiscTerm['totalDept'];

        }



        $revenTerms=[];
        $expenTerms=[];

        foreach($revenueTerms as $term)
        {
            array_push($revenTerms,$term->getPeriodReport($request));
        }


        foreach($expensesTerms as $term)
        {
            array_push($expenTerms,$term->getPeriodReport($request));
        }

        $data=[
            'startDate'=>$request->input('startDate'),
            'endDate'=>$request->input('endDate'),
            'revenTerms'=>$revenTerms,
            'expenTerms'=>$expenTerms,
            'expenMiscTerm'=>isset($expenMiscTerm)?$expenMiscTerm:NULL,
            'revenMiscTerm'=>isset($revenMiscTerm)?$revenMiscTerm:NULL,
        ];





        $documentFileName = 'report_'.$request->input('startDate').'_'.$request->input('endDate').'.pdf';


        $view = View::make($advancedReport?'accounting.report.advancedTemplate':'accounting.report.simpleTemplate',$data);
        $html_content = $view->render();
        PDF::SetFont('aefurat', '', 10);
        //PDF::setRTL(true);
        PDF::SetTitle('Report');
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output($documentFileName);

    }




}
