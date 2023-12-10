<?php

namespace App\Controllers;

use App\Models\ProductionModel;
use App\Models\PondAreaModel;
use App\Models\ProductionDetailModel;
use App\Models\YearModel;
use App\Controllers\Utilities\Formatter;
use App\Controllers\Utilities\Converter;

class DataController extends BaseController
{
    protected $productionModel;
    protected $pondAreaModel;
    protected $productionDetailModel;
    protected $yearModel;
    protected $formatter;
    protected $utilitiesConverter;
    public function __construct()
    {
        $this->productionModel = new ProductionModel();
        $this->pondAreaModel = new PondAreaModel();
        $this->productionDetailModel = new ProductionDetailModel();
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
            $production = $this->productionModel->getProductionByYear($year);
            $pondArea = $this->pondAreaModel->getPondAreaByYear($year)->pond_wide;
            $productionKw = $this->utilitiesConverter->convertTonToKuintal($production->total_production_amount);
            $productivity = $productionKw / $pondArea;

            $tempData = [
                'year' => $year,
                'pondArea' => $this->formatter->formatToIndonesianNumber($pondArea),
                'productionAmount' => $this->formatter->formatToIndonesianNumber($production->total_production_amount),
                'productivity' => $this->formatter->formatToIndonesianNumber($productivity),
                'productionValue' => $this->formatter->formatToIndonesianNumber($production->total_production_value),
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

    public function detail($year): string
    {
        $years = $this->yearModel->orderBy('year', 'Desc')->findAll();
        $tableDatas = [];
        $production = $this->productionModel->getProductionByYear($year);
        $productionDetails = $this->productionDetailModel->getProductionDetail($production->production_id);

        foreach($productionDetails as $productionDetail) {
            $tempData = [
                'productionTypeName' => $productionDetail->production_type_name,
                'productionAmount' => $this->formatter->formatToIndonesianNumber($productionDetail->production_amount),
                'productionValue' => $this->formatter->formatToIndonesianNumber($productionDetail->production_value),
            ];
            array_push($tableDatas, $tempData);
        }

        $viewData = [
            'title' => 'Data Tahun ' . $year ,
            'heading' => 'Data Tahun ' . $year,
            'breadcrumbs' => [
                'Data' => '#',
                $year => '#',
            ],
            'tableDatas' => $tableDatas,
        ];
        return view('Data/Detail/index', $viewData);
    }
}
