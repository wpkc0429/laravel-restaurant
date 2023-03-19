<?php

namespace App\View\Composers;

use Illuminate\Http\Request;

class NavbarComposer
{
    public function __construct(Request $request)
    {
        //
    }

    public function compose()
    {
        $menu = [];
        $menu = $this->setSidebar();

        view()->share('navbar', $menu->sortBy('order'));
    }

    /**
     * 檢查目前所在的Route
     * @param collect $rows
     * @return collect
     */
    public function checkRouteActive($rows)
    {
        if (empty(\Request::route())) {
            return $rows;
        }
        $route = \Request::route()->getName();

        if ($rows->pluck('route')->contains($route)) {
            $rows = $rows->map(function ($item, $key) use ($route) {
                if (isset($item['route']) && $item['route'] === $route) {
                    $item['navStatus'] = 'active';
                } else {
                    $item['navStatus'] = '';
                }
                return $item;
            });
        } else {
            $rows = $rows->map(function ($item, $key) use ($route) {
                $flag = '';
                if (isset($item['pages'])) {
                    foreach ($item['pages'] as $key => $page) {
                        if ($page['route'] === $route) {
                            $item['pages'][$key]['navStatus'] = 'active';
                            $flag = 'active';
                        } else {
                            $item['pages'][$key]['navStatus'] = '';
                            if(isset($page['child'])) {
                                if(in_array($route, $page['child'])) {
                                    $item['pages'][$key]['navStatus'] = 'active';
                                    $flag = 'active';
                                }
                            }
                        }
                    }
                }
                $item['navStatus'] = $flag;
                return $item;
            });
        }
        return $rows;
    }


    /**
     * 
     * @return collect
     */
    private function setSidebar()
    {
        // 餐廳
        $menu['store'] = [
            'label' => '餐廳',
            'icon' => 'fa-store',
            'params' => [],
            'resource' => 'store',
            'order' => "5",
            'pages' => [
                0 => [
                    'label' => '店家管理',
                    'route' => 'store.index',
                    'params' => [],
                    'scope' => [],
                    'order' => 0,
                    'child' => [
                    ],
                ],
            ],
        ];
        $menu = collect($menu);
        $menu = $this->checkRouteActive($menu);

        return $menu;
    }
}
