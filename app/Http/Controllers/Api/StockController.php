<?php


namespace DwSetpoint\Http\Controllers\Api;
use Illuminate\Support\Facades\Input;

class StockController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Stock::class;
    public function getAllForDataTables() {
        return \DwSetpoint\Models\Stock::with(['product','size','color'])->get();
//        parent::getAllForDataTables();
    }
}