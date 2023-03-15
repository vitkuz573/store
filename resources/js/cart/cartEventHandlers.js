import { removeCartItem } from './cartApi';
import { handleQuantityChange, updateTotalPrice } from './cartHelpers';

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
