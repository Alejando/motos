<?php


namespace DwSetpoint\Http\Controllers\Api;
use Illuminate\Support\Facades\Input;

class StockController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Stock::class;
}