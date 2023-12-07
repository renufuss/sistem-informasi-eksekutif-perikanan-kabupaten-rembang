<?php

namespace App\Controllers;

use App\Models\YearModel;
use App\Models\ProductionModel;
use App\Models\PondAreaModel;
use App\Controllers\Utilities\Converter;
use App\Controllers\Utilities\Formatter;

class WhatIfController extends BaseController
{
    protected $yearModel;
    protected $productionModel;
    protected $pondAreaModel;
    protected $productionController;
    protected $utilitiesConverter;
    protected $utilitiesFormatter;

    public function __construct()
    {
        $this->yearModel = new YearModel();
        $this->productionModel = new ProductionModel();
        $this->pondAreaModel = new PondAreaModel();
        $this->productionController = new ProductionController();
        $this->utilitiesConverter = new Converter();
        $this->utilitiesFormatter = new Formatter();
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

    public function calculateAnalysis($variable, $variableValue, $year)
    {
        $variableValue = str_replace('-', '.', $variableValue);
        $pondAreaSwitch = 1;
        $productivitySwitch = 2;
        $productionSwitch = 3;

        $data = [];

        $production = $this->productionModel->getProductionByYear($year)->total_production_amount;
        $pondArea = $this->pondAreaModel->getPondAreaByYear($year)->pond_wide;
        $productivity = $this->productionController->getProductivity($production, $pondArea);

        switch ($variable) {
            case $pondAreaSwitch:
                $steadyProduction = [
                    'title' => 'Jumlah Produksi Tetap',
                    'production' => $this->utilitiesFormatter->formatToIndonesianNumber($production),
                    'pond_area' => $this->utilitiesFormatter->formatToIndonesianNumber($variableValue),
                    'productivity' => $this->utilitiesFormatter->formatToIndonesianNumber($this->calculateProductivity($production, $variableValue)),
                ];
                array_push($data, $steadyProduction);

                $steadyProductivity = [
                    'title' => 'Jumlah Produktivitas Tetap',
                    'production' => $this->utilitiesFormatter->formatToIndonesianNumber($this->calculateProduction($productivity, $variableValue)),
                    'pond_area' => $this->utilitiesFormatter->formatToIndonesianNumber($variableValue),
                    'productivity' => $this->utilitiesFormatter->formatToIndonesianNumber($productivity),
                ];

                array_push($data, $steadyProductivity);
                break;
            case $productivitySwitch:
                $steadyProduction = [
                    'title' => 'Jumlah Produksi Tetap',
                    'production' => $this->utilitiesFormatter->formatToIndonesianNumber($production),
                    'pond_area' => $this->utilitiesFormatter->formatToIndonesianNumber($this->calculatePondArea($production, $variableValue)),
                    'productivity' => $this->utilitiesFormatter->formatToIndonesianNumber($variableValue),
                ];

                array_push($data, $steadyProduction);

                $steadyPondArea = [
                    'title' => 'Jumlah Luas Kolam Tetap',
                    'production' => $this->utilitiesFormatter->formatToIndonesianNumber($this->calculateProduction($variableValue, $pondArea)),
                    'pond_area' => $this->utilitiesFormatter->formatToIndonesianNumber($pondArea),
                    'productivity' => $this->utilitiesFormatter->formatToIndonesianNumber($variableValue),
                ];

                array_push($data, $steadyPondArea);
                break;

            case $productionSwitch:
                $steadyPondArea = [
                    'title' => 'Jumlah Luas Kolam Tetap',
                    'production' => $this->utilitiesFormatter->formatToIndonesianNumber($variableValue),
                    'pond_area' => $this->utilitiesFormatter->formatToIndonesianNumber($pondArea),
                    'productivity' => $this->utilitiesFormatter->formatToIndonesianNumber($this->calculateProductivity($variableValue, $pondArea)),
                ];

                array_push($data, $steadyPondArea);

                $steadyProductivity = [
                    'title' => 'Jumlah Produktivitas Tetap',
                    'production' => $this->utilitiesFormatter->formatToIndonesianNumber($variableValue),
                    'pond_area' => $this->utilitiesFormatter->formatToIndonesianNumber($this->calculatePondArea($variableValue, $productivity)),
                    'productivity' => $this->utilitiesFormatter->formatToIndonesianNumber($productivity),
                ];

                array_push($data, $steadyProductivity);
                break;
        }
        return json_encode($data);
    }

    public function calculateProduction($productivity, $pondArea)
    {
        $production = $productivity * $pondArea;
        return $this->utilitiesConverter->convertKuintalToTon($production);
    }

    public function calculateProductivity($production, $pondArea)
    {
        $production = $this->utilitiesConverter->convertTonToKuintal($production);
        $productivity = $production / $pondArea;
        return $productivity;
    }

    public function calculatePondArea($production, $productivity)
    {
        $production = $this->utilitiesConverter->convertTonToKuintal($production);
        $pondArea = $production / $productivity;
        return $pondArea;
    }
}
