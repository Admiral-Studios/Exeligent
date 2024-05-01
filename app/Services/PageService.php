<?php

namespace App\Services;

use App\Models\Form;
use App\Models\Page;
use App\Models\PageBlock;

class PageService
{

    public function renderBlock(PageBlock $block)
    {
        $view_path = "layouts.blocks.{$block->template->name}";

        if (view()->exists($view_path)) {
            $data = [
                'block' => $block,
                'pageService' => $this
            ];

            if ($block->template->name == 'form.index') {
                if ($block->model)
                    $data['formService'] = new FormService($block->model);
                else
                    return '';
            }

            return view($view_path, $data);
        }

        return '';
    }


    public static function getRoutes()
    {
        $routes = Page::pluck('slug', 'name')->toArray();
        unset($routes['leadership-tools']); // has own controller

        return $routes;
    }

}
