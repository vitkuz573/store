const formatPrice = (price) => `${price.toFixed(0)}\xa0руб.`;

export const updateTotalPrice = (totalPrice) => {
    const totalElem = document.querySelector('.total-price');
    if (totalElem) totalElem.innerText = formatPrice(totalPrice);
};

export const updateItemTotal = (itemTotalElem, itemTotal) => {
    if (itemTotalElem) itemTotalElem.innerText = formatPrice(itemTotal);
};
