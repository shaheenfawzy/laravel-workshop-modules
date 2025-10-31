<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Order\Models\Order;

class OrderCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(public Order $order)
    {}
}
