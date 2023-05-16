function apiCep() {
  const inputCep = document.querySelector("#cep");

  inputCep.addEventListener("change", (event) => {
    // Console para ver se a mascara está funcionando: "44270442000123".replace(Código regex)
    // console.log(event.target.value.replace(/(\d{5})(\d{3})$/, "$1-$2"));
    inputCep.value = inputCep.value.replace(/(\d{5})(\d{3})$/, "$1-$2");
  });

  inputCep.addEventListener("keypress", (event) => {
    const inputCepLength = event.target.value.length;

    if (inputCepLength == 5) {
      inputCep.value += "-";
    }
  })

  // Função que remove as pontuações do cep (No caso dessa API ela aceita pontuação)
  // function removeMask(inputCep) {
  //   return inputCep.replace(/[^\d]+/g, "");
  // }

  // Quando o usuário preencher o campo de CEP e mudar de foco, ele vai fazer a consulta na API
  inputCep.addEventListener("blur", function (event) {
    const cep = event.target.value;

    fetch(`https://viacep.com.br/ws/${cep}/json/`)
      .then((response) => response.json())
      .then((fields) => {
          document.querySelector("#logradouro").value = fields.logradouro;
          document.querySelector("#bairro").value = fields.bairro;
          document.querySelector("#cidade").value = fields.localidade;
          document.querySelector("#estado").value = fields.uf;  
        });
  });
}

apiCep();
