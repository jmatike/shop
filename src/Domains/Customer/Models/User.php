<?php

declare(strict_types=1);

namespace Domains\Customer\Models;

use Database\Factories\UserFactory;
use Domains\Fulfilment\Models\Order;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasUuid;
    use Notifiable;
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'password',
        'billing_id',
        'shipping_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function billing(): BelongsTo
    {
        return $this->belongsTo(
            related: Address::class,
            foreignKey: 'billing_id',
        );
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(
            related: Address::class,
            foreignKey: 'shipping_id',
        );
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(
            related: Address::class,
            foreignKey: 'user_id',
        );
    }

    public function cart(): HasOne
    {
        return $this->hasOne(
            related: Cart::class,
            foreignKey: 'user_id',
        );
    }

    public function orders(): HasMany
    {
        return $this->hasMany(
            related: Order::class,
            foreignKey: 'user_id',
        );
    }

    protected static function newFactory(): \Database\Factories\UserFactory
    {
        return UserFactory::new();
    }
}
