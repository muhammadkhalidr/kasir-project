document.addEventListener("DOMContentLoaded", function() {
    let footer = document.querySelector('.haha');
    if (!footer || footer.textContent.trim() === '') {
        document.querySelector('html').style.display = 'none';
    }
});