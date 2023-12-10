<?php

namespace App\Controllers;

use App\Models\ProductionModel;
use App\Models\PondAreaModel;
use App\Models\YearModel;
use App\Controllers\Utilities\Formatter;
use App\Controllers\Utilities\Converter;

class DataController extends BaseController
{
    protected $productionModel;
    protected $pondAreaModel;
    protected $yearModel;
    protected $formatter;
    protected $utilitiesConverter;
    public function __construct()
    {
        $this->productionModel = new ProductionModel();
        $this->pondAreaModel = new PondAreaModel();
        $this->yearModel = new YearModel();
        $this->formatter = new Formatter();
        $this->utilitiesConverter = new Converter();
    }

    public function index(): string
    {
        $years = $this->yearModel->orderBy('year', 'Desc')->findAll();
        $tableDatas = [];

        foreach($years as $year) {
            $year = $year->year;
            $production = $this->productionModel->getProductionByYear($year)->total_production_amount;
            $pondArea = $this->pondAreaModel->getPondAreaByYear($year)->pond_wide;
            $productionKw = $this->utilitiesConverter->convertTonToKuintal($production);
            $productivity = $productionKw / $pondArea;

            $tempData = [
                'year' => $year,
                'pondArea' => $this->formatter->formatToIndonesianNumber($pondArea),
                'production' => $this->formatter->formatToIndonesianNumber($production),
                'productivity' => $this->formatter->formatToIndonesianNumber($productivity),
            ];


            array_push($tableDatas, $tempData);
        }


        $viewData = [
            'title' => 'Data',
            'heading' => 'Data',
            'breadcrumbs' => [
                'Data' => '#',
            ],
            'tableDatas' => $tableDatas,
        ];
        return view('Data/index', $viewData);
    }
}
