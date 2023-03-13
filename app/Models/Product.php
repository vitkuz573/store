<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperProduct
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id'];

    public function categories(): BelongsToMany
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
