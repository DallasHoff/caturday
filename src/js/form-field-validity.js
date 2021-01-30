(() => {

    var fields = document.querySelectorAll('input[type="text"], input[type="number"], input[type="tel"], input[type="file"], input[type="email"], input[type="password"], select, textarea');

    fields.forEach(el => {
        el.addEventListener('input', () => {
            if (el.validity && el.validity.valid === false) {
                el.classList.add('invalid');
            } else {
                el.classList.remove('invalid');
            }
        });
    });

})();