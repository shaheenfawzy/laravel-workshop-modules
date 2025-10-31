<?php

namespace Modules\Order\Http\Controllers;

use App\Events\OrderCreated;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Order\Http\Requests\StoreOrderRequest;
use Modules\Order\Models\Order;

class CreateOrderController
{
    public function __invoke(StoreOrderRequest $request): JsonResponse
    {
        $order = DB::transaction(function () use ($request) {
            $requestLines = collect($request->safe()->only('lines'))
                ->pluck('quantity', 'product_id');

            $products = DB::query()
                ->table('products')
                ->whereIn('id', $requestLines->keys())
                ->get()
                ->map(function ($product) use ($requestLines) {
                    $quantity = $requestLines->get($product->id);

                    return [
                        'subtotal' => $quantity * $product->price
                    ];
                });

            $order = Order::create($request->safe()->except('lines'));
            $order->lines()->createMany();

            OrderCreated::dispatch($order);

            return $order;
        });

        return response()->json([
            'success' => true,
            'message' => "order with code {$order->code} created successfully!",
        ]);
    }
}