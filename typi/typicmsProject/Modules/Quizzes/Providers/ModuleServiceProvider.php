<?php

namespace TypiCMS\Modules\Quizzes\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Quizzes\Composers\SidebarViewComposer;
use TypiCMS\Modules\Quizzes\Facades\Quizzes;
use TypiCMS\Modules\Quizzes\Models\Quiz;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.quizzes');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.quizzes' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'quizzes');

        $this->publishes([
            __DIR__.'/../database/migrations/create_quizzes_table.php.stub' => getMigrationFileName('create_quizzes_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Quizzes', Quizzes::class);

        // Observers
        Quiz::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('quizzes::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('quizzes');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Quizzes', Quiz::class);
    }
}
