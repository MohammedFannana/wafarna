<?php

namespace App\Console\Commands;

use App\Models\WaitingProduct;
use Illuminate\Console\Command;

class DeleteWaitingProductEndDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-waiting-product-end-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $waiting_products = WaitingProduct::where('end_date','=', now()->toDateString())
        ->cursor();

        foreach($waiting_products as $waiting_product){
            $waiting_product->delete();
        }
    }
}
