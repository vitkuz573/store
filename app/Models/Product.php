<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeInCategory($query, $category)
    {
        return $query->whereHas('categories', function ($query) use ($category) {
            $query->whereName($category);
        });
    }

    public function getCategoryAttribute()
    {
        return $this->categories->first()->name ?? 'Нет';
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
