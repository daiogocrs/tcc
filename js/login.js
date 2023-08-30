function togglePasswordVisibility() {
    const senhaInput = document.getElementById('user_senha');
    const passwordToggle = document.getElementById('password_toggle');
    if (senhaInput.type === 'password') {
        senhaInput.type = 'text';
        passwordToggle.textContent = '👁';
    } else {
        senhaInput.type = 'password';
        passwordToggle.textContent = '👁';
    }
}