<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportProduct extends Command
{

    protected $signature = 'products:import {--id=}';


    protected $description = 'Import products from API';

    public function __construct()
    {
        parent::__construct();

    }

    public function handle()
    {

        if($this->option('id')){
            $this->singleProduct($this->option('id'));
        }

    }

    public function singleProduct($id)
    {
        try{
            $response = Http::get('https://fakestoreapi.com/products/')[$id];
            $productApi = (object)$response;

            if($productApi->id){
                $data = (object) [
                    'id' => $productApi->id,
                    'name' => $productApi->title,
                    'price' => $productApi->price,
                    'description' => $productApi->description,
                    'category' => $productApi->category,
                    'image_url' => $productApi->image,
                ];

                Product::createProduct($data);
            }
            echo('sucesso ao importar produto!');
        }catch (\Exception $e) {
            echo('erro ao importar produto!');
        }

    }

}
