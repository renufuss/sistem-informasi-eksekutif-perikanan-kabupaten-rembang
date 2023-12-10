<?php

namespace App\Controllers;

class AboutController extends BaseController
{
    public function index()
    {
        $viewData = [
            'title' => 'About',
            'heading' => 'About',
            'breadcrumbs' => [
                'About' => base_url('about'),
            ]
        ];
        return view('About/index', $viewData);
    }
}
