<?php

namespace TypiCMS\Modules\Cats\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Cats\Http\Controllers\AdminController;
use TypiCMS\Modules\Cats\Http\Controllers\ApiController;
use TypiCMS\Modules\Cats\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('cats')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-cats');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('cat');
                        $router->any('/insert', [PublicController::class, 'addData'])->name('add');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('cats', [AdminController::class, 'index'])->name('index-cats')->middleware('can:read cats');
            $router->get('cats/export', [AdminController::class, 'export'])->name('export-cats')->middleware('can:read cats');
            $router->get('cats/create', [AdminController::class, 'create'])->name('create-cat')->middleware('can:create cats');
            $router->get('cats/{cat}/edit', [AdminController::class, 'edit'])->name('edit-cat')->middleware('can:read cats');
            $router->post('cats', [AdminController::class, 'store'])->name('store-cat')->middleware('can:create cats');
            $router->put('cats/{cat}', [AdminController::class, 'update'])->name('update-cat')->middleware('can:update cats');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('cats', [ApiController::class, 'index'])->middleware('can:read cats');
            $router->patch('cats/{cat}', [ApiController::class, 'updatePartial'])->middleware('can:update cats');
            $router->delete('cats/{cat}', [ApiController::class, 'destroy'])->middleware('can:delete cats');
        });
    }
}
