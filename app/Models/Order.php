<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    protected function customerName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user ? $this->user->name : $this->guest_name,
        );
    }

    protected function customerEmail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user ? $this->user->email : $this->guest_email,
        );
    }

    protected function customerPhone(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user ? $this->user->phone : $this->guest_phone,
        );
    }
}
