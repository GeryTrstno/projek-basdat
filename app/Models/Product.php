<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['seller', 'name', 'category', 'description', 'price', 'image', 'category_id', 'amount', 'slug'];

    protected static function booted(): void
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        // Optional: regenerate slug on update
        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
