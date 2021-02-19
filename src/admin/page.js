(() => {

    // Action confirmation
    var actionButtons = document.querySelectorAll('.dashboard-table-row__action-button');
    var cancelButtons = document.querySelectorAll('.dashboard-table-row__cancel-button');
    var containerConfirmingClass = 'dashboard-table-row__actions--confirming';
    var buttonConfirmingClass = 'dashboard-table-row__action-button--confirming';

    if (actionButtons.length > 0) {
        actionButtons.forEach(el => {
            el.addEventListener('click', ev => {
                if (!el.classList.contains(buttonConfirmingClass)) {
                    // Show confirmation prompt
                    ev.preventDefault();
                    el.parentElement.classList.add(containerConfirmingClass);
                    el.classList.add(buttonConfirmingClass);
                }
            });
        });
    }

    if (cancelButtons.length > 0) {
        cancelButtons.forEach(el => {
            el.addEventListener('click', ev => {
                // Cancel action
                ev.preventDefault();
                el.parentElement.classList.remove(containerConfirmingClass);
                el.parentElement.querySelector('.' + buttonConfirmingClass).classList.remove(buttonConfirmingClass);
            });
        });
    }

})();