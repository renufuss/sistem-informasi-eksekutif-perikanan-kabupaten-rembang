<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $viewData = [
            'title' => 'Home',
            'heading' => 'Home',
            'breadcrumbs' => [
                'Home' => '#',
            ]
        ];
        return view('Layouts/index', $viewData);
    }
}
