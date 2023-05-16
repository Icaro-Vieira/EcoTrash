function eyeButtonLogin() {
    const inputPassword = document.querySelector("#senha");
    const showButton = document.querySelector(".imagem-icon");

    showButton.onclick = () => {
        if (inputPassword.type === "password") {
            inputPassword.type = "text";
            showButton.setAttribute('src', 'img/eye-visibility.svg');
        } else {
            inputPassword.type = "password";
            showButton.setAttribute('src', 'img/eye-visibility-off.svg');
        }
    };
}
eyeButtonLogin()