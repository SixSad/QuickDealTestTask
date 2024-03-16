<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Table: users
 *
 * === Columns ===
 * @property int $id
 * @property int $cart_id
 * @property int $product_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CartProduct extends Pivot
{
    use HasFactory;

    protected $table = 'cart_products';

    public $incrementing = true;

    protected $fillable = [
        'product_id',
        'cart_id',
    ];

}
