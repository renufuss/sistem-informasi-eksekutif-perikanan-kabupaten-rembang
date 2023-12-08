<?php

namespace App\Controllers;

class DataController extends BaseController
{
    public function index(): string
    {
        $viewData = [
            'title' => 'Data',
            'heading' => 'Data',
            'breadcrumbs' => [
                'Data' => '#',
            ]
        ];
        return view('Data/index', $viewData);
    }
}
