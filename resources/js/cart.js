document.addEventListener('DOMContentLoaded', () => {
  // Обработчик события изменения количества товара в корзине
  function handleQuantityChange(event) {
    const form = event.target.closest('.update-form');
    const productId = form.querySelector('[name="product_id"]').value;
    const quantity = event.target.value;
    const itemPriceElem = form.closest('tr').querySelector('.item-price');
    const itemTotalElem = form.closest('tr').querySelector('.item-total');

    const totalElem = document.querySelector('.total-price');

    console.log(`Product ID: ${productId}, New Quantity: ${quantity}`);

    // Отправляем AJAX запрос на сервер для обновления количества товара
    fetch(`/cart/update/${productId}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': form.querySelector('[name="_token"]').value,
      },
      body: JSON.stringify({
        product_id: productId,
        quantity: quantity,
      }),
    })
      .then(response => response.json())
      .then(data => {
        // Обновляем данные в корзине и на странице
        const itemPrice = parseFloat(itemPriceElem.innerText);
        const itemTotal = itemPrice * data.quantity;
        if (itemTotalElem) {
          itemTotalElem.innerText = `${itemTotal.toFixed(0)} руб.`;
        }
        if (totalElem) {
          totalElem.innerText = `${data.totalPrice.toFixed(0)} руб.`;
        }
        console.log(data);
      })
      .catch(error => console.error(error));
  }

  // Обработчик события удаления товара из корзины
  function handleRemoveFromCart(event) {
    const productId = event.target.getAttribute('data-product-id');
    const itemElem = document.querySelector(`#cart-item-${productId}`);
    const totalElem = document.querySelector('.total-price');

    fetch(`/cart/remove/${productId}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
    })
      .then(response => response.json())
      .then(data => {
        itemElem.remove();
        if (totalElem) {
          totalElem.innerText = `${data.totalPrice.toFixed(0)} руб.`;
        }
        console.log(data);
      })
      .catch(error => console.error(error));
  }

  // Добавляем обработчики событий для элементов на странице
  const quantityInputs = document.querySelectorAll('.item-quantity input[type="number"]');
  quantityInputs.forEach(input => {
    input.addEventListener('change', handleQuantityChange);
  });

  const removeButtons = document.querySelectorAll('.remove-from-cart');
  removeButtons.forEach(button => {
    button.addEventListener('click', handleRemoveFromCart);
  });
});
