// da rivedere
const deleteForms = document.querySelectorAll('.delete-form');
const confirmationButton = document.getElementById('confirmation-btn');

deleteForms.forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();

        confirmationButton.addEventListener('click', () => {
            form.submit();
        })
    })
})