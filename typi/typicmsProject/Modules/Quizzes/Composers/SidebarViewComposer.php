<?php

namespace TypiCMS\Modules\Quizzes\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read quizzes')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Quizzes'), function (SidebarItem $item) {
                $item->id = 'quizzes';
                $item->icon = config('typicms.quizzes.sidebar.icon');
                $item->weight = config('typicms.quizzes.sidebar.weight');
                $item->route('admin::index-quizzes');
                $item->append('admin::create-quiz');
            });
        });
    }
}
