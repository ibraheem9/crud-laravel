<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Developer\DashboardController;
use App\Http\Controllers\Developer\SimpleCrudController;
use App\Http\Controllers\Developer\AdvancedCrudController;
use App\Http\Controllers\Developer\CrudWithSortController;
use App\Http\Controllers\Developer\DocsController;
use App\Http\Controllers\Media\MediaImageController;
use App\Http\Controllers\Media\MediaGalleryController;
use App\Http\Controllers\Media\MediaDocumentController;
use App\Http\Controllers\Media\MediaArchiveController;
use App\Http\Controllers\Media\MediaAudioController;
use App\Http\Controllers\Media\MediaVideoController;

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

    // ── Media CRUD Routes ────────────────────────────────────
    Route::prefix('media')->name('media.')->group(function () {

        // ── Single Image CRUD (with Doka Editor) ────────────────
        Route::prefix('images')->name('images.')->group(function () {
            Route::get('/', [MediaImageController::class, 'index'])->name('index');
            Route::get('/datatable', [MediaImageController::class, 'datatable'])->name('datatable');
            Route::get('/save/{id?}', [MediaImageController::class, 'save'])->name('save');
            Route::post('/store', [MediaImageController::class, 'store'])->name('store');
            Route::post('/store-edited', [MediaImageController::class, 'storeEdited'])->name('storeEdited');
            Route::post('/toggle-status', [MediaImageController::class, 'toggleStatus'])->name('toggleStatus');
            Route::delete('/delete', [MediaImageController::class, 'destroy'])->name('delete');
            Route::post('/multi-delete', [MediaImageController::class, 'multiDelete'])->name('multiDelete');
            Route::post('/filepond/upload', [MediaImageController::class, 'filepondUpload'])->name('filepond.upload');
            Route::delete('/filepond/revert', [MediaImageController::class, 'filepondRevert'])->name('filepond.revert');
        });

        // ── Multiple Images / Gallery CRUD ───────────────────────
        Route::prefix('gallery')->name('gallery.')->group(function () {
            Route::get('/', [MediaGalleryController::class, 'index'])->name('index');
            Route::get('/datatable', [MediaGalleryController::class, 'datatable'])->name('datatable');
            Route::get('/save/{id?}', [MediaGalleryController::class, 'save'])->name('save');
            Route::post('/store', [MediaGalleryController::class, 'store'])->name('store');
            Route::post('/remove-item', [MediaGalleryController::class, 'removeItem'])->name('removeItem');
            Route::post('/update-sort', [MediaGalleryController::class, 'updateSort'])->name('updateSort');
            Route::post('/update-caption', [MediaGalleryController::class, 'updateCaption'])->name('updateCaption');
            Route::post('/toggle-status', [MediaGalleryController::class, 'toggleStatus'])->name('toggleStatus');
            Route::delete('/delete', [MediaGalleryController::class, 'destroy'])->name('delete');
        });

        // ── Documents CRUD (PDF, Word, Excel, PPT) ──────────────
        Route::prefix('documents')->name('documents.')->group(function () {
            Route::get('/', [MediaDocumentController::class, 'index'])->name('index');
            Route::get('/datatable', [MediaDocumentController::class, 'datatable'])->name('datatable');
            Route::get('/save/{id?}', [MediaDocumentController::class, 'save'])->name('save');
            Route::post('/store', [MediaDocumentController::class, 'store'])->name('store');
            Route::get('/download/{id}', [MediaDocumentController::class, 'download'])->name('download');
            Route::post('/toggle-status', [MediaDocumentController::class, 'toggleStatus'])->name('toggleStatus');
            Route::delete('/delete', [MediaDocumentController::class, 'destroy'])->name('delete');
            Route::post('/multi-delete', [MediaDocumentController::class, 'multiDelete'])->name('multiDelete');
        });

        // ── Archives CRUD (ZIP, RAR) ────────────────────────────
        Route::prefix('archives')->name('archives.')->group(function () {
            Route::get('/', [MediaArchiveController::class, 'index'])->name('index');
            Route::get('/datatable', [MediaArchiveController::class, 'datatable'])->name('datatable');
            Route::get('/save/{id?}', [MediaArchiveController::class, 'save'])->name('save');
            Route::post('/store', [MediaArchiveController::class, 'store'])->name('store');
            Route::get('/download/{id}', [MediaArchiveController::class, 'download'])->name('download');
            Route::post('/toggle-status', [MediaArchiveController::class, 'toggleStatus'])->name('toggleStatus');
            Route::delete('/delete', [MediaArchiveController::class, 'destroy'])->name('delete');
        });

        // ── Audio CRUD ──────────────────────────────────────────
        Route::prefix('audios')->name('audios.')->group(function () {
            Route::get('/', [MediaAudioController::class, 'index'])->name('index');
            Route::get('/datatable', [MediaAudioController::class, 'datatable'])->name('datatable');
            Route::get('/save/{id?}', [MediaAudioController::class, 'save'])->name('save');
            Route::post('/store', [MediaAudioController::class, 'store'])->name('store');
            Route::post('/toggle-status', [MediaAudioController::class, 'toggleStatus'])->name('toggleStatus');
            Route::delete('/delete', [MediaAudioController::class, 'destroy'])->name('delete');
        });

        // ── Video CRUD ──────────────────────────────────────────
        Route::prefix('videos')->name('videos.')->group(function () {
            Route::get('/', [MediaVideoController::class, 'index'])->name('index');
            Route::get('/datatable', [MediaVideoController::class, 'datatable'])->name('datatable');
            Route::get('/save/{id?}', [MediaVideoController::class, 'save'])->name('save');
            Route::post('/store', [MediaVideoController::class, 'store'])->name('store');
            Route::post('/toggle-status', [MediaVideoController::class, 'toggleStatus'])->name('toggleStatus');
            Route::delete('/delete', [MediaVideoController::class, 'destroy'])->name('delete');
        });
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
