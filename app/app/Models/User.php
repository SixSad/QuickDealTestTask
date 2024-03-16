<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;

/**
 * Table: users
 *
 * === Columns ===
 * @property int $id
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * === Relationships ===
 * @property-read Cart|Collection $cart
 * @property-read Order|Collection $orders
 * @property-read Balance|Collection $balance
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'email',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::created(fn(self $user) => $user->createCart());
        static::created(fn(self $user) => $user->createBalance());
    }

    protected function createCart(): void
    {
        $this->cart()->create();
    }

    protected function createBalance(): void
    {
        $this->balance()->create();
    }

    public function generateApiToken(): NewAccessToken
    {
        return $this->createToken(Hash::make($this->email));
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class)->latest();
    }

    public function balance(): HasOne
    {
        return $this->hasOne(Balance::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
