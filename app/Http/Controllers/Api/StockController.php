<?php


namespace DwSetpoint\Http\Controllers\Api;
use Illuminate\Support\Facades\Input;

class StockController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Stock::class;
    public function getStocks() {
        $ids = \DwSetpoint\Models\Stock::
            with([
                'product' => function($query) {
                    $query->select('id','name','slug');
                },
                'size',
                'color'
            ])
            ->whereIn('id', explode(',',Input::get('stocks')))
            ->select(['id', 'quantity', 'product_id', 'size_id','color_id', 'price'])
        ;
        return $ids->get();
    }
    
    public function getAllForDataTables() {
        return \DwSetpoint\Models\Stock::with(['product','size','color'])->get();
//        parent::getAllForDataTables();
    }
}