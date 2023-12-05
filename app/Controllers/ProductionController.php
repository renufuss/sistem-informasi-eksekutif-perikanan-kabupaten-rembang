<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductionModel;
use App\Models\ProductionDetailModel;
use App\Models\PondAreaModel;
use App\Controllers\Utilities\Color;
use App\Controllers\Utilities\Converter;
use App\Controllers\Utilities\Formatter;

class ProductionController extends BaseController
{
    protected $productionModel;
    protected $productionDetailModel;
    protected $pondAreaModel;
    protected $utilitiesColor;
    protected $utilitiesConverter;
    protected $utilitiesFormatter;
    public function __construct()
    {
        $this->productionModel = new ProductionModel();
        $this->productionDetailModel = new ProductionDetailModel();
        $this->pondAreaModel = new PondAreaModel();
        $this->utilitiesColor = new Color();
        $this->utilitiesConverter = new Converter();
        $this->utilitiesFormatter = new Formatter();
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

    public function getProductionValue()
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
                    'production_value' => $productionDetail->production_value,
                ]);
            }
            array_push($data, [
                'year' => $production->year,
                'total_production_value' => $production->total_production_value,
                'detail' => $detailData,
                'background_color' => $color['background_color'],
                'border_color' => $color['border_color'],
            ]);
        }
        return $data;
    }

    public function getProductivity($productionAmountInTon, $pondWide)
    {
        $productionAmount = $this->utilitiesConverter->convertTonToKuintal($productionAmountInTon);
        $productivity = $productionAmount / $pondWide;
        return number_format($productivity, 2);
    }

    public function getDataByYear($year)
    {
        if($this->request->isAJAX()) {
            $production = $this->productionModel->getProductionByYear($year);
            $pondArea = $this->pondAreaModel->getPondAreaByYear($year);

            $productivity = $this->getProductivity($production->total_production_amount, $pondArea->pond_wide);
            $data = [
                'pond_area' => $this->utilitiesFormatter->formatToIndonesianNumber($pondArea->pond_wide),
                'productivity' => $this->utilitiesFormatter->formatToIndonesianNumber($productivity),
                'production' => $this->utilitiesFormatter->formatToIndonesianNumber($production->total_production_amount),
            ];

            return json_encode($data);
        }
    }
}
