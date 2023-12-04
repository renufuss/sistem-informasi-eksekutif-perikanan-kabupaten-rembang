<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DrilldownController extends BaseController
{
    protected $production;
    public function __construct()
    {
        $this->production = new ProductionController();
    }

    public function drilldownProductionAmount(): string
    {
        $productionAmount = $this->production->getProductionAmount();

        $viewData = [
            'title' => 'Drilldown Production Amount',
            'heading' => 'Drilldown Production Amount',
            'breadcrumbs' => [
                'Drilldowns' => '#',
                'Production Amount' => base_url('drilldowns/production-amount'),
            ],
            'productionAmount' => $productionAmount,
        ];

        return view('Drilldowns/ProductionAmount/index', $viewData);
    }
}
