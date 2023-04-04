export default function apiCep() {
  const inputCep = document.querySelector("#cep");

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
