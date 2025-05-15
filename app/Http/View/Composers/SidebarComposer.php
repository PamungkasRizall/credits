<?php

namespace App\Http\View\Composers;

use App\Main\SidebarPanel;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!is_null(request()->route())) {
            $pageName = request()->route()->getName();
            $routePrefix = explode('.', $pageName)[0] ?? '';

            switch ($routePrefix) {
                case 'master':
                    $view->with('sidebarMenu', SidebarPanel::menu());
                    break;
                // case 'applications':
                //     $view->with('sidebarMenu', SidebarPanel::applications());
                //     break;
                // case 'simrs':
                //     $view->with('sidebarMenu', SidebarPanel::simrs());
                //     break;
                // case 'menus':
                //     $view->with('sidebarMenu', SidebarPanel::dashboards());
                //     break;
                default:
                    $view->with('sidebarMenu', SidebarPanel::menu());
            }

            $view->with('allSidebarItems', SidebarPanel::all());
            $view->with('pageName', $pageName);
            $view->with('routePrefix', $routePrefix);
        }
    }
}
