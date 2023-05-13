function inputMasks() {
  const cpf = document.querySelector("#cpf");

  // Máscara do CPF 000.000.000-00
  cpf.addEventListener("change", () => {
    cpf.value = cpf.value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4');
  });

  cpf.addEventListener("keypress", (event) => {
    const cpfLenght = event.target.value.length;

    if (cpfLenght == 3 || cpfLenght == 7) {
      cpf.value += ".";
    } else if (cpfLenght == 11) {
      cpf.value += "-";
    }
  });
}

inputMasks();
