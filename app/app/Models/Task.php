<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Table: accounts
 *
 * === Columns ===
 * @property int $id
 * @property string $name
 * @property Status $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    protected $attributes = [
        'status' => Status::New
    ];

    public function scopeName($query, $name)
    {
        return $name
            ? $query->where('name', $name)
            : $query;
    }

    public function scopeStatus($query, $status)
    {
        return $status
            ? $query->where('status', $status)
            : $query;
    }

    //Фильтрация по дате точно не сформулирована
    public function scopeCreatedAt($query, $date)
    {
        return $date
            ? $query->where('created_at', '>', $date)
            : $query;
    }
}
