document.addEventListener('DOMContentLoaded', function() {
    const categoryDropdownToggle = document.querySelector('#categoryDropdown');
    const categoryDropdownMenu = document.querySelector('#categoryDropdownMenu');

    if (categoryDropdownToggle && categoryDropdownMenu) {
        categoryDropdownToggle.addEventListener('click', function(event) {
            event.stopPropagation();
            categoryDropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', function() {
            categoryDropdownMenu.classList.remove('show');
        });

        categoryDropdownMenu.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }

    const checkboxMenu = document.querySelector('.checkbox-menu');
    if (checkboxMenu) {
        checkboxMenu.addEventListener('change', function(event) {
            const target = event.target;
            if (target.matches('input[type="checkbox"]')) {
                const label = target.closest('label');
                if (target.checked) {
                    label.classList.add('active');
                } else {
                    label.classList.remove('active');
                }
            }
        });
    }
});
