<script>
(() => {

    // Delete button confirmation
    var deleteBtn = document.querySelector('.post-details__delete');
    if (deleteBtn) {
        var deleteClicked = false;
        deleteBtn.addEventListener('click', (e) => {
            if (deleteClicked === false) {
                e.preventDefault();
                deleteBtn.innerText = 'Confirm?';
                deleteClicked = true;
            }
        });
    }

})();
</script>