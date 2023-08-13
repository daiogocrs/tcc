const senhaInput = document.getElementById('user_senha');
    const showPasswordButton = document.getElementById('show_password_button');

    showPasswordButton.addEventListener('click', function () {
        if (senhaInput.type === 'password') {
            senhaInput.type = 'text';
        } else {
            senhaInput.type = 'password';
        }
    });