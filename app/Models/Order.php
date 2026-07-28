<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'city',
        'address',
        'notes',
        'subtotal',
        'discount',
        'total',
        'status',
    ];

    /**
     * Relación: Un pedido pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un pedido tiene muchos ítems.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
