<?php

namespace Modules\Order\Models;

use App\Casts\Money;
use App\Traits\HasSequencedColumns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\Enums\OrderStatus;

class Order extends Model
{
    use HasSequencedColumns;

    protected $casts = [
        'customer' => 'array',
        'subtotal' => Money::class,
        'discount' => Money::class,
        'total'    => Money::class,
        'status'   => OrderStatus::class,
    ];
    protected $attributes = [
        'status' => OrderStatus::Pending,
    ];

    public function lines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }

    public static function getSequenceColumns(): array
    {
        return ['code'];
    }

    public static function getSequencePrefix(): string
    {
        return 'ORD';
    }
}
