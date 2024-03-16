<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(): ProductCollection
    {
        return new ProductCollection(Product::query()->paginate(10));
    }

    public function show(int $id): ProductResource
    {
        return new ProductResource(Product::query()->findOrFail($id));
    }

}
