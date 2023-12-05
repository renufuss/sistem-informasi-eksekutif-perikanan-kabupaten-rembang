<?php

namespace App\Controllers;

use App\Models\YearModel;

class WhatIfController extends BaseController
{
    protected $yearModel;

    public function __construct()
    {
        $this->yearModel = new YearModel();
    }

    public function index(): string
    {
        $viewData = [
            'title' => 'What If Analysis',
            'heading' => 'What If Analysis',
            'years' => $this->yearModel->orderBy('year', 'Desc')->findAll(),
            'breadcrumbs' => [
                'What If Analysis' => base_url('what-if'),
            ]
        ];
        return view('WhatIf/index', $viewData);
    }
}
