<?php

namespace TypiCMS\Modules\Quizzes\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Quizzes\Http\Controllers\AdminAnswerController;
use TypiCMS\Modules\Quizzes\Http\Controllers\AdminController;
use TypiCMS\Modules\Quizzes\Http\Controllers\AdminQuestionController;
use TypiCMS\Modules\Quizzes\Http\Controllers\AnswerApiController;
use TypiCMS\Modules\Quizzes\Http\Controllers\ApiController;
use TypiCMS\Modules\Quizzes\Http\Controllers\PublicController;
use TypiCMS\Modules\Quizzes\Http\Controllers\QuestionsApiController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('quizzes')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-quizzes');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('quiz');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('quizzes', [AdminController::class, 'index'])->name('index-quizzes')->middleware('can:read quizzes');
            $router->get('quizzes/export', [AdminController::class, 'export'])->name('export-quizzes')->middleware('can:read quizzes');
            $router->get('quizzes/create', [AdminController::class, 'create'])->name('create-quiz')->middleware('can:create quizzes');
            $router->get('quizzes/{quiz}/edit', [AdminController::class, 'edit'])->name('edit-quiz')->middleware('can:read quizzes');
            $router->post('quizzes', [AdminController::class, 'store'])->name('store-quiz')->middleware('can:create quizzes');
            $router->put('quizzes/{quiz}', [AdminController::class, 'update'])->name('update-quiz')->middleware('can:update quizzes');

            //question routes
            $router->get('quizzes/{quiz}/questions/create', [AdminQuestionController::class, 'create'])->name('create-quiz_question');//->middleware('can:create page_sections');
            $router->get('quizzes/{quiz}/question/{question}/edit', [AdminQuestionController::class, 'edit'])->name('edit-question');//->middleware('can:read page_sections');
            $router->post('quizzes/{quiz}/question/create', [AdminQuestionController::class, 'store'])->name('store-quiz_question');//->middleware('can:create page_sections');
            $router->put('quizzes/{quiz}/questions/{question}', [AdminQuestionController::class, 'update'])->name('update-quiz_question');//->middleware('can:update page_sections');
//            $router->post('pages/{page}/sections/sort', [SectionsAdminController::class, 'sort'])->name('sort-page_sections');

//            $router->get('sections', [SectionsAdminController::class, 'index'])->name('index-page_sections')->middleware('can:read page_sections');
            $router->delete('question/{question}', [AdminQuestionController::class, 'destroyMultiple'])->name('destroy-question');//->middleware('can:delete page_sections');

            //answer routes
            $router->get('question/{question}/answer/create', [AdminAnswerController::class, 'create'])->name('create-question_answers');//->middleware('can:create page_sections');
//            $router->get('quizzes/{quiz}/question/{question}/edit', [AdminQuestionController::class, 'edit'])->name('edit-question');//->middleware('can:read page_sections');
            $router->post('quizzes/{quiz}/question/create', [AdminAnswerController::class, 'store'])->name('store-question_answer');//->middleware('can:create page_sections');
//            $router->put('quizzes/{quiz}/questions/{question}', [AdminQuestionController::class, 'update'])->name('update-quiz_question');//->middleware('can:update page_sections');
//            $router->post('pages/{page}/sections/sort', [SectionsAdminController::class, 'sort'])->name('sort-page_sections');

//            $router->get('sections', [SectionsAdminController::class, 'index'])->name('index-page_sections')->middleware('can:read page_sections');
            $router->delete('question/{question}', [AdminQuestionController::class, 'destroyMultiple'])->name('destroy-question');//->middleware('can:delete page_sections');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('quizzes', [ApiController::class, 'index'])->middleware('can:read quizzes');
            $router->patch('quizzes/{quiz}', [ApiController::class, 'updatePartial'])->middleware('can:update quizzes');
            $router->delete('quizzes/{quiz}', [ApiController::class, 'destroy'])->middleware('can:delete quizzes');

            //question API routes
            $router->get('quizzes/{quiz}/questions', [QuestionsApiController::class, 'index']);//->middleware('can:read page_sections');
//            $router->patch('pages/{page}/sections/{section}', [SectionsApiController::class, 'updatePartial'])->middleware('can:update page_sections');
            $router->delete('quizzes/{quiz}/questions/{question}', [QuestionsApiController::class, 'destroy']);//->middleware('can:delete page_sections');

            //answers API routes

            $router->get('question/{question}/answer', [AnswerApiController::class, 'index']);//->middleware('can:read page_sections');
//            $router->patch('pages/{page}/sections/{section}', [SectionsApiController::class, 'updatePartial'])->middleware('can:update page_sections');
            $router->delete('quizzes/{quiz}/questions/{question}', [QuestionsApiController::class, 'destroy']);//->middleware('can:delete page_sections'
        });
    }
}
