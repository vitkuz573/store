document.addEventListener('DOMContentLoaded', () => {
    const updateForms = document.querySelectorAll('.update-form');

    updateForms.forEach(form => {
        const input = form.querySelector('.item-quantity');
        const productId = input.dataset.productId;

        const handleQuantityChange = debounce(() => {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const formData = new FormData(form);
            formData.append('_method', 'PUT');

            fetch(`/cart/update/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    // update cart item quantity and total price
                    const cartItem = document.getElementById(`cart-item-${productId}`);
                    const itemPrice = cartItem.querySelector('.item-price').textContent;
                    const itemTotal = cartItem.querySelector('.item-total');

                    itemTotal.textContent = `${parseFloat(itemPrice) * data.quantity} руб.`;

                    // update total price
                    const itemTotalElements = document.querySelectorAll('.item-total');
                    let totalPrice = 0;

                    itemTotalElements.forEach(element => {
                        totalPrice += parseFloat(element.textContent);
                    });

                    document.querySelector('.total-price').textContent = `${totalPrice} руб.`;
                })
                .catch(error => {
                    console.error(error);
                });
        }, 500);

        input.addEventListener('change', handleQuantityChange);
        input.addEventListener('keydown', handleQuantityChange);
    });
});

function debounce(func, wait) {
    let timeout;

    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };

        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
