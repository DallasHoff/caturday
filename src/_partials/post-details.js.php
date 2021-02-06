<script>
(() => {

    // Show local time in timestamp
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var postTimestamps = document.querySelectorAll('.post-details__date-posted');

    postTimestamps.forEach(el => {
        var ts = Number(el.dataset.jsTimestamp);
        var date = new Date(ts);

        var day = date.getDate().toString().padStart(2, '0');
        var month = months[date.getMonth()];
        var year = date.getFullYear();
        var hourNum = date.getHours() % 12 === 0 ? 12 : date.getHours() % 12;
        var hours = hourNum.toString().padStart(2, '0');
        var minutes = date.getMinutes().toString().padStart(2, '0');
        var seconds = date.getSeconds().toString().padStart(2, '0');
        var meridian = date.getHours() < 12 ? 'AM' : 'PM';

        el.innerText = `${day} ${month} ${year} ${hours}:${minutes}:${seconds} ${meridian}`;
    });

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