<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Developer\DashboardController;
use App\Http\Controllers\Developer\SimpleCrudController;
use App\Http\Controllers\Developer\AdvancedCrudController;
use App\Http\Controllers\Developer\CrudWithSortController;
use App\Http\Controllers\Developer\DocsController;

// ─── Dashboard ──────────────────────────────────────────────
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// ─── Developer CRUD Routes ──────────────────────────────────
Route::prefix('developer')->name('developer.')->group(function () {

    // ── Simple Modal CRUD ────────────────────────────────────
    Route::prefix('simpleCrud')->name('simpleCrud.')->group(function () {
        Route::get('/', [SimpleCrudController::class, 'index'])->name('index');
        Route::get('/datatable', [SimpleCrudController::class, 'datatable'])->name('datatable');
        Route::get('/save/{id?}', [SimpleCrudController::class, 'saveView'])->name('saveView');
        Route::post('/store', [SimpleCrudController::class, 'store'])->name('store');
        Route::post('/update', [SimpleCrudController::class, 'update'])->name('update');
        Route::delete('/delete', [SimpleCrudController::class, 'delete'])->name('delete');
        Route::post('/updateStatus', [SimpleCrudController::class, 'updateStatus'])->name('updateStatus');
    });

    // ── Advanced CRUD (Page-based) ──────────────────────────
    Route::prefix('advancedCrud')->name('advancedCrud.')->group(function () {
        Route::get('/', [AdvancedCrudController::class, 'index'])->name('index');
        Route::get('/datatable', [AdvancedCrudController::class, 'datatable'])->name('datatable');
        Route::get('/create', [AdvancedCrudController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [AdvancedCrudController::class, 'edit'])->name('edit');
        Route::get('/{id}/show', [AdvancedCrudController::class, 'show'])->name('show');
        Route::post('/store', [AdvancedCrudController::class, 'store'])->name('store');
        Route::post('/update', [AdvancedCrudController::class, 'update'])->name('update');
        Route::delete('/delete', [AdvancedCrudController::class, 'delete'])->name('delete');
        Route::post('/updateStatus', [AdvancedCrudController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/multiDelete', [AdvancedCrudController::class, 'multiDelete'])->name('multiDelete');
    });

    // ── CRUD with Sort ──────────────────────────────────────
    Route::prefix('crudWithSort')->name('crudWithSort.')->group(function () {
        Route::get('/', [CrudWithSortController::class, 'index'])->name('index');
        Route::get('/datatable', [CrudWithSortController::class, 'datatable'])->name('datatable');
        Route::post('/store', [CrudWithSortController::class, 'store'])->name('store');
        Route::post('/update', [CrudWithSortController::class, 'update'])->name('update');
        Route::delete('/delete', [CrudWithSortController::class, 'delete'])->name('delete');
        Route::get('/get', [CrudWithSortController::class, 'getSortItems'])->name('getSortItems');
        Route::post('/sort', [CrudWithSortController::class, 'sort'])->name('sort');
    });

    // ── Documentation ───────────────────────────────────────
    Route::prefix('docs')->name('docs.')->group(function () {
        Route::get('/php-helper', [DocsController::class, 'phpHelper'])->name('phpHelper');
        Route::get('/js-helper', [DocsController::class, 'jsHelper'])->name('jsHelper');
        Route::get('/datatable', [DocsController::class, 'datatable'])->name('datatable');
        Route::get('/ajax', [DocsController::class, 'ajax'])->name('ajax');
        Route::get('/inputs', [DocsController::class, 'inputs'])->name('inputs');
        Route::get('/layout', [DocsController::class, 'layout'])->name('layout');
    });
});
