(() => {

    // Show image from input
    var imgInputFigure = document.querySelector('.edit-post__figure');
    var imgInput = document.querySelector('.edit-post__image-input');
    var imgOutput = document.querySelector('.edit-post__image');
    var imgRemoveBtn = document.querySelector('.edit-post__image-remove-btn');

    if (imgInput) {
        imgInput.addEventListener('change', (e) => {
            if (imgInput.files && imgInput.files[0] && imgInput.files[0].type && imgInput.files[0].type.split('/')[0] === 'image') {
                var fr = new FileReader();
                fr.addEventListener('load', (e) => {
                    imgOutput.src = e.target.result;
                    imgInputFigure.classList.add('edit-post__figure--show-image');
                });
                fr.readAsDataURL(imgInput.files[0]);
            }
        });
    }

    if (imgRemoveBtn) {
        imgRemoveBtn.addEventListener('click', (e) => {
            imgInput.value = '';
            imgInput.required = true;
            imgOutput.src = '';
            imgInputFigure.classList.remove('edit-post__figure--show-image');
        });
    }

})();