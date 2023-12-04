<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductionModel;
use App\Models\ProductionDetailModel;
use App\Controllers\Utilities\Color;

class ProductionController extends BaseController
{
    protected $productionModel;
    protected $productionDetailModel;
    protected $utilitiesColor;
    public function __construct()
    {
        $this->productionModel = new ProductionModel();
        $this->productionDetailModel = new ProductionDetailModel();
        $this->utilitiesColor = new Color();
    }

    public function getProductionAmount()
    {
        $data = [];
        $productions = $this->productionModel->getProduction();

        foreach ($productions as $production) {
            $productionDetails = $this->productionDetailModel->getProductionDetail($production->production_id);
            $detailData = [];
            $color = $this->utilitiesColor->randomRGBA();
            foreach ($productionDetails as $productionDetail) {
                array_push($detailData, [
                    'production_type_name' => $productionDetail->production_type_name,
                    'production_amount' => $productionDetail->production_amount,
                ]);
            }
            array_push($data, [
                'year' => $production->year,
                'total_production_amount' => $production->total_production_amount,
                'detail' => $detailData,
                'background_color' => $color['background_color'],
                'border_color' => $color['border_color'],
            ]);
        }
        return $data;
    }
}
