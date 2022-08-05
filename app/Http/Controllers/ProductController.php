<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upsertProducts(ProductRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->post();
        $products = $ids = [];
        foreach ($data as $product) {
            foreach ($product['prices'] as $region_id => $prices) {
                $products[] = [
                    'id' => $product['product_id'],
                    'region_id' => $region_id,
                    'price_purchase' => $prices['price_purchase'],
                    'price_selling' => $prices['price_selling'],
                    'price_discount' => $prices['price_discount']
                ];
                $ids[] = $product['product_id'];
            }
        }

        Product::upsert($products, ['region_id', 'id'], ['price_purchase', 'price_selling', 'price_discount']);

        return response()->json('Товары с ID: ' . implode(', ', array_unique($ids)) . ' обработаны.');
    }
}
