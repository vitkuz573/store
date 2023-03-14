<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperCart
 */
class Cart extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function hasProduct(Product $product): bool
    {
        return $this->items()->whereProductId($product->id)->exists();
    }

    public function getCartItem(Product $product): Model|HasMany|null
    {
        return $this->items()->whereProductId($product->id)->first();
    }

    public function getTotalPrice(): float|int
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $totalPrice += $item->quantity * $item->product->price;
        }

        return $totalPrice;
    }

    public function addProduct(Product $product, $quantity)
    {
        $cartItem = new CartItem();
        $cartItem->cart_id = $this->id;
        $cartItem->product_id = $product->id;
        $cartItem->quantity = $quantity;
        $cartItem->save();
    }

    public function incrementQuantity(Product $product, $quantity)
    {
        $cartItem = $this->getCartItem($product);
        $cartItem->quantity += $quantity;
        $cartItem->save();
    }

    public function updateProductQuantity(Product $product, $quantity)
    {
        $cartItem = $this->getCartItem($product);

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }
    }

    public function removeProduct($productId)
    {
        $product = Product::find($productId);

        $cartItem = $this->getCartItem($product);
        $cartItem?->delete();
    }
}
