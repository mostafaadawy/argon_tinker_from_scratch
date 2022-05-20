<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use Modules\Accounting\Entities\CodeSetting;
use Modules\Accounting\Http\Controllers\Codesettings;
use Modules\Accounting\Http\Controllers\Dailyrecord;
use Modules\Accounting\Http\Controllers\Report;

Route::prefix('accounting')->group(function() {
//    Route::get('/', 'AccountingController@index');
    Route::get('codesettings/{type}', [Codesettings::class, 'index'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.codesettings.index');
    Route::get('codesettings/{type}/destroy/{id?}', [Codesettings::class, 'destroy'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.codesettings.destroy');
    Route::get('codesettings/{type}/create', [Codesettings::class, 'create'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.codesettings.create');
    Route::get('codesettings/{type}/{searchType}/search', [Codesettings::class, 'search'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.codesettings.search');
    Route::post('codesettings/{type}/store', [Codesettings::class, 'store'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.codesettings.store');

//To be refractored
    Route::post('/getCodeLevel}', function(Request $request)
    {
        $request->validate(['selection'=>'required|numeric|exists:App\Models\Accounting\CodeSetting,id']);
        return response()->json(CodeSetting::select('level')->findOrFail($request['selection']));
    })->name('accounting.codesettings.getCodeLevel');


    Route::get('dailyrecords/{type}', [Dailyrecord::class, 'index'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.index');
    Route::get('dailyrecords/{type}/create', [Dailyrecord::class, 'create'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.create');
    Route::get('dailyrecords/{type}/destroy/{id?}', [Dailyrecord::class, 'destroy'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.destroy');
    Route::get('dailyrecords/{type}/edit/{id?}', [Dailyrecord::class, 'edit'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.edit');
    Route::get('dailyrecords/print/{id?}', [Dailyrecord::class, 'print'])->name('accounting.dailyrecords.print');
    Route::get('dailyrecords/preview/{id?}', [Dailyrecord::class, 'preview'])->name('accounting.dailyrecords.preview');
    Route::post('dailyrecords/{type}/ajax/{operation}', [Dailyrecord::class, 'ajax'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.ajax');
    Route::post('dailyrecords/{type}/store', [Dailyrecord::class, 'store'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.store');
    Route::put('dailyrecords/{type}/{id}/update', [Dailyrecord::class, 'update'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.update');

    Route::get('report/', [Report::class, 'index'])->name('accounting.report.index');

    Route::post('report/generate', [Report::class, 'generate'])->name('accounting.report.generate');
    Route::post('report/ajax/{action}', [Report::class, 'ajax'])->name('accounting.report.ajax');


    Route::get('budgetterms/{type}', [BudgetTerms::class, 'index'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.index');
    Route::get('budgetterms/misc/{type}', [BudgetTerms::class, 'misc'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.misc');

    Route::get('budgetterms/{type}/destroy/{id?}', [BudgetTerms::class, 'destroy'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.destroy');
    Route::get('budgetterms/{type}/edit/{id?}', [BudgetTerms::class, 'edit'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.edit');
    Route::get('budgetterms/{type}/create', [BudgetTerms::class, 'create'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.create');
    Route::post('budgetterms/{type}/ajax/{operation}', [BudgetTerms::class, 'ajax'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.ajax');
    Route::post('budgetterms/{type}/store', [BudgetTerms::class, 'store'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.store');
    Route::get('budgetterms/{type}/{termID}/termItem/destroy/{itemID}', [BudgetTerms::class, 'destroyItem'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.destroyItem');
    Route::put('budgetterms/{type}/update/{id}', [BudgetTerms::class, 'update'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.update');

    Route::post('budgetterms/misc/{type}/store', [BudgetTerms::class, 'miscStore'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.miscStore');

});
