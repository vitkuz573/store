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
