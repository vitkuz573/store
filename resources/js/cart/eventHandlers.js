import { removeCartItem, updateCartItem } from './api';
import { updateTotalPrice, updateItemTotal } from './helpers';
import { debounce } from 'lodash';

const getRow = (element) => element.closest('tr');

export const handleQuantityChange = debounce(async ({ target }) => {
    const form = target.closest('.update-form');
    const productId = form.querySelector('[name="product_id"]').value;
    const quantity = target.value;
    const row = getRow(target);
    const itemPriceElem = row.querySelector('.item-price');
    const itemTotalElem = row.querySelector('.item-total');

    try {
        const data = await updateCartItem(productId, quantity);

        if (data) {
            const itemPrice = parseFloat(itemPriceElem.textContent);
            const itemTotal = itemPrice * data.quantity;
            updateItemTotal(itemTotalElem, itemTotal);
            updateTotalPrice(data.totalPrice);
        }
    } catch (error) {
        alert('Произошла ошибка при обновлении количества товара: ' + error.message);
    }
}, 300);

export const handleRemoveFromCart = async ({ target }) => {
    const productId = target.getAttribute('data-product-id');
    const itemElem = document.querySelector(`#cart-item-${productId}`);

    try {
        const data = await removeCartItem(productId);

        if (data) {
            itemElem.remove();
            updateTotalPrice(data.totalPrice);
        }
    } catch (error) {
        alert('Произошла ошибка при удалении товара из корзины: ' + error.message);
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
