document.addEventListener('DOMContentLoaded', () => {
    const categoryDropdownToggle = document.querySelector('#categoryDropdown');
    const categoryDropdownMenu = document.querySelector('#categoryDropdownMenu');

    categoryDropdownToggle?.addEventListener('click', (e) => {
        e.stopPropagation();
        categoryDropdownMenu?.classList.toggle('show');
    });

    document.addEventListener('click', () => categoryDropdownMenu?.classList.remove('show'));
    categoryDropdownMenu?.addEventListener('click', (e) => e.stopPropagation());

    document.querySelector('.checkbox-menu')?.addEventListener('change', ({ target }) => {
        if (target.matches('input[type="checkbox"]')) {
            const label = target.closest('label');
            target.checked ? label.classList.add('active') : label.classList.remove('active');
        }
    });
});
