function loginMaks() {
  // Seleciona o campo de entrada (input)
  const input = document.getElementById("usuario");

  // Adiciona um ouvinte de eventos de entrada (input)
  input.addEventListener("input", function (event) {
    let value = event.target.value;
    value = value.replace(/\D/g, "");

    // Verifica se o valor tem 11 dígitos = CPF
    if (value.length === 11) {
      value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
    }
    // Verifica se o valor tem 14 dígitos = CNPJ
    else if (value.length === 14) {
      value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
    }

    // Atualiza o valor do campo de entrada com a máscara de CPF ou CNPJ
    event.target.value = value;
  });
}

loginMaks();
