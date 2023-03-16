import axios from 'axios';

export const updateCartItem = async (productId, quantity) => {
    try {
        return (await axios.put(`/cart/${productId}`, { product_id: productId, quantity })).data;
    } catch (error) {
        console.error(error);
    }
};

export const removeCartItem = async (productId) => {
    try {
        return (await axios.delete(`/cart/${productId}`)).data;
    } catch (error) {
        console.error(error);
    }
};
