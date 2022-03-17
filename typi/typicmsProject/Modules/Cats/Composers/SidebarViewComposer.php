<?php

namespace TypiCMS\Modules\Cats\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read cats')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Cats'), function (SidebarItem $item) {
                $item->id = 'cats';
                $item->icon = config('typicms.cats.sidebar.icon');
                $item->weight = config('typicms.cats.sidebar.weight');
                $item->route('admin::index-cats');
                $item->append('admin::create-cat');
            });
        });
    }
}
