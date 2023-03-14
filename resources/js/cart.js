import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
    function handleQuantityChange(event) {
        const form = event.target.closest('.update-form');
        const productId = form.querySelector('[name="product_id"]').value;
        const quantity = event.target.value;
        const itemPriceElem = form.closest('tr').querySelector('.item-price');
        const itemTotalElem = form.closest('tr').querySelector('.item-total');
        const totalElem = document.querySelector('.total-price');

        axios
            .put(`/cart/${productId}`, {
                product_id: productId,
                quantity: quantity,
            })
            .then((response) => {
                const data = response.data;
                const itemPrice = parseFloat(itemPriceElem.innerText);
                const itemTotal = itemPrice * data.quantity;
                if (itemTotalElem) {
                    itemTotalElem.innerText = `${itemTotal.toFixed(0)} руб.`;
                }
                if (totalElem) {
                    totalElem.innerText = `${data.totalPrice.toFixed(0)} руб.`;
                }
            })
            .catch((error) => console.error(error));
    }

    function handleRemoveFromCart(event) {
        const productId = event.target.getAttribute('data-product-id');
        const itemElem = document.querySelector(`#cart-item-${productId}`);
        const totalElem = document.querySelector('.total-price');

        axios
            .delete(`/cart/${productId}`)
            .then((response) => {
                const data = response.data;
                itemElem.remove();
                if (totalElem) {
                    totalElem.innerText = `${data.totalPrice.toFixed(0)} руб.`;
                }
            })
            .catch((error) => console.error(error));
    }

    const quantityInputs = document.querySelectorAll('.item-quantity input[type="number"]');
    quantityInputs.forEach((input) => {
        input.addEventListener('change', handleQuantityChange);
    });

    const removeButtons = document.querySelectorAll('.remove-from-cart');
    removeButtons.forEach((button) => {
        button.addEventListener('click', handleRemoveFromCart);
    });
});
