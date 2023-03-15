import { handleCartEvent } from './cartEventHandlers';

document.addEventListener('DOMContentLoaded', () => {
    const cartTable = document.querySelector('.cart-table');

    if (cartTable) {
        cartTable.addEventListener('click', handleCartEvent);
    }
});
