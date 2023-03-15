import { debounce } from 'lodash';
import { updateCartItem } from './cartApi';

export const updateTotalPrice = (totalPrice) => {
    const totalElem = document.querySelector('.total-price');

    if (totalElem) {
        totalElem.innerText = `${totalPrice.toFixed(0)} руб.`;
    }
};

export const updateItemTotal = (itemTotalElem, itemTotal) => {
    if (itemTotalElem) {
        itemTotalElem.innerText = `${itemTotal.toFixed(0)} руб.`;
    }
};

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
