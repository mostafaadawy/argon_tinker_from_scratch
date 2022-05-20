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

Route::prefix('accounting')->group(function() {
//    Route::get('/', 'AccountingController@index');
    Route::get('/codesettings/{type}', [Accounting\Codesettings::class, 'index'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.codesettings.index');
    Route::get('/codesettings/{type}/destroy/{id?}', [Accounting\Codesettings::class, 'destroy'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.codesettings.destroy');
    Route::get('/codesettings/{type}/create', [Accounting\Codesettings::class, 'create'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.codesettings.create');
    Route::get('/codesettings/{type}/{searchType}/search', [Accounting\Codesettings::class, 'search'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.codesettings.search');
    Route::post('/codesettings/{type}/store', [Accounting\Codesettings::class, 'store'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.codesettings.store');

//To be refractored
    Route::post('/getCodeLevel}', function(Request $request)
    {
        $request->validate(['selection'=>'required|numeric|exists:App\Models\Accounting\CodeSetting,id']);
        return response()->json(App\Models\Accounting\CodeSetting::select('level')->findOrFail($request['selection']));
    })->name('accounting.codesettings.getCodeLevel');


    Route::get('/dailyrecords/{type}', [Accounting\Dailyrecord::class, 'index'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.index');
    Route::get('/dailyrecords/{type}/create', [Accounting\Dailyrecord::class, 'create'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.create');
    Route::get('/dailyrecords/{type}/destroy/{id?}', [Accounting\Dailyrecord::class, 'destroy'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.destroy');
    Route::get('/dailyrecords/{type}/edit/{id?}', [Accounting\Dailyrecord::class, 'edit'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.edit');
    Route::get('/dailyrecords/print/{id?}', [Accounting\Dailyrecord::class, 'print'])->name('accounting.dailyrecords.print');
    Route::get('/dailyrecords/preview/{id?}', [Accounting\Dailyrecord::class, 'preview'])->name('accounting.dailyrecords.preview');
    Route::post('/dailyrecords/{type}/ajax/{operation}', [Accounting\Dailyrecord::class, 'ajax'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.ajax');
    Route::post('/dailyrecords/{type}/store', [Accounting\Dailyrecord::class, 'store'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.store');
    Route::put('/dailyrecords/{type}/{id}/update', [Accounting\Dailyrecord::class, 'update'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.dailyrecords.update');

    Route::get('/report/', [Accounting\Report::class, 'index'])->name('accounting.report.index');

    Route::post('/report/generate', [Accounting\Report::class, 'generate'])->name('accounting.report.generate');
    Route::post('/report/ajax/{action}', [Accounting\Report::class, 'ajax'])->name('accounting.report.ajax');


    Route::get('/budgetterms/{type}', [Accounting\BudgetTerms::class, 'index'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.index');
    Route::get('/budgetterms/misc/{type}', [Accounting\BudgetTerms::class, 'misc'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.misc');

    Route::get('/budgetterms/{type}/destroy/{id?}', [Accounting\BudgetTerms::class, 'destroy'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.destroy');
    Route::get('/budgetterms/{type}/edit/{id?}', [Accounting\BudgetTerms::class, 'edit'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.edit');
    Route::get('/budgetterms/{type}/create', [Accounting\BudgetTerms::class, 'create'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.create');
    Route::post('/budgetterms/{type}/ajax/{operation}', [Accounting\BudgetTerms::class, 'ajax'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.ajax');
    Route::post('/budgetterms/{type}/store', [Accounting\BudgetTerms::class, 'store'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.store');
    Route::get('/budgetterms/{type}/{termID}/termItem/destroy/{itemID}', [Accounting\BudgetTerms::class, 'destroyItem'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.destroyItem');
    Route::put('/budgetterms/{type}/update/{id}', [Accounting\BudgetTerms::class, 'update'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.update');

    Route::post('/budgetterms/misc/{type}/store', [Accounting\BudgetTerms::class, 'miscStore'])->where('type',CodeSetting::getRoutingTypeValidator())->name('accounting.budgetterms.miscStore');

});
