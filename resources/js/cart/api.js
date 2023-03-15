import axios from 'axios';

export const updateCartItem = async (productId, quantity) => {
    try {
        const response = await axios.put(`/cart/${productId}`, {
            product_id: productId,
            quantity: quantity,
        });

        return response.data;
    } catch (error) {
        console.error(error);
    }
};

export const removeCartItem = async (productId) => {
    try {
        const response = await axios.delete(`/cart/${productId}`);

        return response.data;
    } catch (error) {
        console.error(error);
    }
};
