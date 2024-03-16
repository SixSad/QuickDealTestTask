<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Table: users
 *
 * === Columns ===
 * @property int $id
 * @property int $user_id
 * @property int $cart_id
 * @property int $total_price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * === Relationships ===
 * @property-read Cart|Collection $cart
 * @property-read User|Collection user
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cart_id',
        'total_price',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::created(fn(self $order) => $order->createNewCart());
    }

    private function createNewCart(): void
    {
        $this->user->cart()->create();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }


}
