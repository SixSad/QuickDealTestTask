<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Table: users
 *
 * === Columns ===
 * @property int $id
 * @property int $user_id
 * @property float $total_price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * === Relationships ===
 * @property-read User|Collection $user
 * @property-read Product|Collection $products
 */
class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'user_id'
    ];

    protected $attributes = [
        'total_price' => 0
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'cart_products');
    }
}
