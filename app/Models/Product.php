<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'category',
        'image_url'
    ];

    public static function getProduct($request)
    {
        $model = self::query();

        if($request->name){
            $model = $model->where('id', $request->id);
        }

       if($request->name){
           $model = $model->where('name', 'like', "%".$request->name."%");
       }

        if($request->category){
            $model =  $model->where('category', $request->category);
       }

        return $model;

    }

    public static function createProduct($request)
    {

        return self::query()
            ->create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category,
            'image_url' => $request->image_url ?? null
        ]);

    }

    public static function updateProduct($request)
    {
        return self::query()
            ->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category,
            'image_url' => $request->image_url ?? null
        ]);
    }
}
