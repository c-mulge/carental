document.querySelector('.form').addEventListener('submit', function (event) {
    event.preventDefault();
    const username = document.querySelector('.input-style[type="email"]').value.trim();
    const password = document.querySelector('.input-style[type="password"]').value.trim();
    const loader = document.getElementById('loader');
    const notification = document.getElementById('notification');

    if (!username || !password) {
        notification.textContent = 'Please fill in both fields.';
        notification.className = 'notification error';
        notification.style.display = 'block';
        return;
    }

    loader.style.display = 'block';

    // Simulate an asynchronous login
    setTimeout(() => {
        loader.style.display = 'none';
        notification.textContent = 'Login successful!';
        notification.className = 'notification success';
        notification.style.display = 'block';
    }, 2000);
});
