(() => {

    var forms = document.querySelectorAll('form');
    var fields = document.querySelectorAll('input[type="text"], input[type="number"], input[type="tel"], input[type="file"], input[type="email"], input[type="password"], select, textarea');

    // Show field validity
    fields.forEach(el => {
        el.addEventListener('input', () => {
            if (el.validity && el.validity.valid === false) {
                el.classList.add('invalid');
            } else {
                el.classList.remove('invalid');
            }
        });
    });

    // Prevent double submissions
    forms.forEach(el => {
        el.addEventListener('submit', () => {
            var submitBtns = el.querySelectorAll('[type=submit]');
            submitBtns.forEach(btn => btn.disabled = true);
        });
    });

})();