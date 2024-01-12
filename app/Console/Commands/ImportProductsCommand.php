<?php

namespace App\Console\Commands;

use App\Jobs\ImportProductProcess;
use App\Models\Product;
use App\Services\FakeApiService;
use Illuminate\Console\Command;

class ImportProductsCommand extends Command
{
    private $fake_service;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command use to import products of https://fakestoreapi.com/';

    public function __construct() {
        parent::__construct();
        $this->fake_service = new FakeApiService;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('start import');

        $products = $this->fake_service->getProducts();
        
        foreach($products as $product) {
            
            $this->line("dispatch job import product $product->title");

            ImportProductProcess::dispatch($product);

            $this->line("job import product $product->title dispached");
        }

        $this->info('finish import');
    }
}
