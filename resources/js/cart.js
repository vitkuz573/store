import axios from 'axios';

async function updateCartItem(productId, quantity) {
    try {
        const response = await axios.put(`/cart/${productId}`, {
            product_id: productId,
            quantity: quantity,
        });

        return response.data;
    } catch (error) {
        console.error(error);
    }
}

async function removeCartItem(productId) {
    try {
        const response = await axios.delete(`/cart/${productId}`);

        return response.data;
    } catch (error) {
        console.error(error);
    }
}

function updateTotalPrice(totalPrice) {
    const totalElem = document.querySelector('.total-price');

    if (totalElem) {
        totalElem.innerText = `${totalPrice.toFixed(0)} руб.`;
    }
}

function updateItemTotal(itemTotalElem, itemTotal) {
    if (itemTotalElem) {
        itemTotalElem.innerText = `${itemTotal.toFixed(0)} руб.`;
    }
}

async function handleQuantityChange(event) {
    const form = event.target.closest('.update-form');
    const productId = form.querySelector('[name="product_id"]').value;
    const quantity = event.target.value;
    const itemPriceElem = form.closest('tr').querySelector('.item-price');
    const itemTotalElem = form.closest('tr').querySelector('.item-total');

    const data = await updateCartItem(productId, quantity);

    if (data) {
        const itemPrice = parseFloat(itemPriceElem.innerText);
        const itemTotal = itemPrice * data.quantity;
        updateItemTotal(itemTotalElem, itemTotal);
        updateTotalPrice(data.totalPrice);
    }
}

async function handleRemoveFromCart(event) {
    const productId = event.target.getAttribute('data-product-id');
    const itemElem = document.querySelector(`#cart-item-${productId}`);

    const data = await removeCartItem(productId);

    if (data) {
        itemElem.remove();
        updateTotalPrice(data.totalPrice);
    }
}

function handleCartEvent(event) {
    const target = event.target;

    if (target.matches('.item-quantity input[type="number"]')) {
        handleQuantityChange(event);
    } else if (target.matches('.remove-from-cart')) {
        handleRemoveFromCart(event);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const cartTable = document.querySelector('.cart-table');

    if (cartTable) {
        cartTable.addEventListener('click', handleCartEvent);
    }
});
