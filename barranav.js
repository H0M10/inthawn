window.addEventListener('DOMContentLoaded', (event) => {
    fetch('barranav.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('navbar').innerHTML = data;
        });
});
