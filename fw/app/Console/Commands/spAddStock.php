<?php

namespace DwSetpoint\Console\Commands;
use Illuminate\Console\Command;
class spAddStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'st:add-stock {product} {color} {size} {quantity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $product = $this->argument('product');
        $color = $this->argument('color');
        $size = $this->argument('size');
        $quantity = $this->argument('quantity');
        $stock = \DwSetpoint\Models\Stock::find($product, $color, $size);
        if(!$stock) {
            $stock = new \DwSetpoint\Models\Stock([
                'quantity' => $quantity,
                'product_id' => $product,
                'color_id' => ($color != '0' ? $color : null),
                'size_id' => ($size != '0' ? $size : null)
            ]);
            $stock->price = $this->ask('Precio:');
            $stock->code = $this->ask('Codigo:');
            $stock->codebar = $this->ask('codebar');
            $stock->save();
        } else {
            $stock->quantity += (int)$quantity;
            $stock->save();
        }
        echo "El stock ".$stock->id.' ahora cuenta '.$stock->quantity." items \n";
    }
}
