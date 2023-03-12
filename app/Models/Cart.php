<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function hasProduct(Product $product)
    {
        return $this->items()->where('product_id', $product->id)->exists();
    }

    public function getCartItem(Product $product)
    {
        return $this->items()->where('product_id', $product->id)->first();
    }

    public function getTotalPrice()
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
        $cartItem->quantity = $quantity;
        $cartItem->save();
    }

    public function removeProduct(Product $product)
    {
        $cartItem = $this->getCartItem($product);
        $cartItem->delete();
    }
}
