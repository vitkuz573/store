document.addEventListener('DOMContentLoaded', () => {
  function handleQuantityChange(event) {
    const form = event.target.closest('.update-form');
    const productId = form.querySelector('[name="product_id"]').value;
    const quantity = event.target.value;
    const itemPriceElem = form.closest('tr').querySelector('.item-price');
    const itemTotalElem = form.closest('tr').querySelector('.item-total');
    const totalElem = document.querySelector('.total-price');

    const csrfToken = getCsrfToken(); // функция для получения CSRF токена из скрытого поля на форме

    fetch(`/cart/update/${productId}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': csrfToken,
      },
      body: JSON.stringify({
        product_id: productId,
        quantity: quantity,
      }),
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        const itemPrice = parseFloat(itemPriceElem.innerText);
        const itemTotal = itemPrice * data.quantity;
        if (itemTotalElem) {
          itemTotalElem.innerText = `${itemTotal.toFixed(0)} руб.`;
        }
        if (totalElem) {
          totalElem.innerText = `${data.totalPrice.toFixed(0)} руб.`;
        }
      })
      .catch(error => console.error(error));
  }

  function handleRemoveFromCart(event) {
    const productId = event.target.getAttribute('data-product-id');
    const itemElem = document.querySelector(`#cart-item-${productId}`);
    const totalElem = document.querySelector('.total-price');

    const csrfToken = getCsrfToken(); // function to get CSRF token from hidden form input

    fetch(`/cart/remove/${productId}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': csrfToken,
      },
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        itemElem.remove();
        if (totalElem) {
          totalElem.innerText = `${data.totalPrice.toFixed(0)} руб.`;
        }
      })
      .catch(error => console.error(error));
  }

  const quantityInputs = document.querySelectorAll('.item-quantity input[type="number"]');
  quantityInputs.forEach(input => {
    input.addEventListener('change', handleQuantityChange);
  });

  const removeButtons = document.querySelectorAll('.remove-from-cart');
  removeButtons.forEach(button => {
    button.addEventListener('click', handleRemoveFromCart);
  });

  function getCsrfToken() {
    const csrfTokenInput = document.querySelector('input[name="_token"]');
    if (!csrfTokenInput) {
      throw new Error('CSRF token input not found');
    }
    const csrfToken = csrfTokenInput.value;
    if (!csrfToken) {
      throw new Error('CSRF token is empty');
    }
    return csrfToken;
  }
});
