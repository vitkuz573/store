import { handleCartEvent } from './eventHandlers';

document.addEventListener('DOMContentLoaded', () => document.querySelector('.cart-table')?.addEventListener('click', handleCartEvent));
