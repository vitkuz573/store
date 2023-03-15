import {removeCartItem, updateCartItem} from './api';
import {updateTotalPrice, updateItemTotal} from './helpers';
import {debounce} from "lodash";

export const handleQuantityChange = debounce(async (event) => {
    const { target } = event;
    const form = target.closest('.update-form');
    const productId = form.querySelector('[name="product_id"]').value;
    const quantity = target.value;
    const itemPriceElem = form.closest('tr').querySelector('.item-price');
    const itemTotalElem = form.closest('tr').querySelector('.item-total');

    const data = await updateCartItem(productId, quantity);

    if (data) {
        const itemPrice = parseFloat(itemPriceElem.innerText);
        const itemTotal = itemPrice * data.quantity;
        updateItemTotal(itemTotalElem, itemTotal);
        updateTotalPrice(data.totalPrice);
    }
}, 300);

export const handleRemoveFromCart = async (event) => {
    const { target } = event;
    const productId = target.getAttribute('data-product-id');
    const itemElem = document.querySelector(`#cart-item-${productId}`);

    const data = await removeCartItem(productId);

    if (data) {
        itemElem.remove();
        updateTotalPrice(data.totalPrice);
    }
};

export const handleCartEvent = (event) => {
    const { target } = event;

    if (target.matches('.item-quantity input[type="number"]')) {
        handleQuantityChange(event);
    } else if (target.matches('.remove-from-cart')) {
        handleRemoveFromCart(event);
    }
};
