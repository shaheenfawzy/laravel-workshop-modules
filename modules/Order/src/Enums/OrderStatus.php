<?php

namespace Modules\Order\Enums;

enum OrderStatus: string
{
    case Pending = 'Pending';
    case Paid = 'Paid';
    case PaymentFailed = 'PaymentFailed';
    case Shipped = 'Shipped';
    case Cancelled = 'Cancelled';
}
