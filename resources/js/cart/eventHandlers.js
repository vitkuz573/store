import { removeCartItem, updateCartItem } from './api';
import { updateTotalPrice, updateItemTotal } from './helpers';
import { debounce } from 'lodash';

const handleQuantityChange = debounce(async (input) => {
    try {
        const data = await updateCartItem(input.closest('tr').querySelector('[name="product_id"]').value, input.value);

        if (data) {
            const row = input.closest('tr');
            updateItemTotal(row.querySelector('.item-total'), parseFloat(row.querySelector('.item-price').textContent) * data.quantity);
            updateTotalPrice(data.totalPrice);
        }
    } catch (error) {
        alert('Произошла ошибка при обновлении количества товара: ' + error.message);
    }
}, 300);

const handleRemoveFromCart = async (button) => {
    try {
        const data = await removeCartItem(button.getAttribute('data-product-id'));

        if (data) {
            document.getElementById(`cart-item-${button.getAttribute('data-product-id')}`).remove();
            updateTotalPrice(data.totalPrice);
        }
    } catch (error) {
        alert('Произошла ошибка при удалении товара из корзины: ' + error.message);
    }
};

export const handleCartEvent = (event) => {
    if (event.target.matches('.item-quantity input[type="number"]')) {
        handleQuantityChange(event.target);
    } else if (event.target.matches('.remove-from-cart')) {
        handleRemoveFromCart(event.target);
    }
};
