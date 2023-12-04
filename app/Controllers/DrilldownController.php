<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DrilldownController extends BaseController
{
    public function drilldownProductionAmount(): string
    {
        $viewData = [
            'title' => 'Drilldown Production Amount',
            'heading' => 'Drilldown Production Amount',
            'breadcrumbs' => [
                'Drilldowns' => '#',
                'Production Amount' => base_url('drilldowns/production-amount'),
            ]
        ];

        return view('Drilldowns/ProductionAmount/index', $viewData);
    }
}
