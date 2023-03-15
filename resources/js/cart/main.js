import { handleCartEvent } from './eventHandlers';

document.addEventListener('DOMContentLoaded', () => {
    const cartTable = document.querySelector('.cart-table');

    if (cartTable) {
        cartTable.addEventListener('click', handleCartEvent);
    }
});
