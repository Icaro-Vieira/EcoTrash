function eyeButton() {
    const inputPassword = document.querySelector("#senha");
    const inputPassword2 = document.querySelector("#confirmar-senha");
    const showButton = document.querySelector(".imagem-icon");
    const showButton2 = document.querySelector(".imagem-icon2");

    showButton.onclick = () => {
        if (inputPassword.type === "password") {
            inputPassword.type = "text";
            showButton.setAttribute('src', 'img/eye-visibility.svg');
        } else {
            inputPassword.type = "password";
            showButton.setAttribute('src', 'img/eye-visibility-off.svg');
        }
    };

    showButton2.onclick = () => {
        if (inputPassword2.type === "password") {
            inputPassword2.type = "text";
            showButton2.setAttribute('src', 'img/eye-visibility.svg');
        } else {
            inputPassword2.type = "password";
            showButton2.setAttribute('src', 'img/eye-visibility-off.svg');
        }
    };
}
eyeButton()