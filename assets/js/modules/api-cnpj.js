export default function apiCnpj() {
  // campo onde o usuário insere o CNPJ
  const inputCnpj = document.querySelector("#cnpj");

  inputCnpj.addEventListener("change", (event) => {
    console.log(event.target.value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "$1.$2.$3/$4-$5"));
    inputCnpj.value = inputCnpj.value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "$1.$2.$3/$4-$5");
  });

  inputCnpj.addEventListener("keypress", (event) => {
    const inputCnpjLength = event.target.value.length;

    if (inputCnpjLength == 2 || inputCnpjLength == 6) {
      inputCnpj.value += ".";
    } else if (inputCnpjLength == 10) {
      inputCnpj.value += "/";
    } else if (inputCnpjLength == 15) {
      inputCnpj.value += "-";
    }
  })

  // Função que remove as pontuações do cnpj
  function removeMask(inputCnpj) {
    return inputCnpj.replace(/[^\d]+/g, "");
  }

  removeMask(inputCnpj)

  // Quando o usuário preencher o campo de CNPJ e mudar de foco, ele vai fazer a consulta na API
  inputCnpj.addEventListener("blur", function (event) {
    let cnpj = event.target.value;
    removeMask(cnpj)

    fetch(`https://api-publica.speedio.com.br/buscarcnpj?cnpj=${cnpj}`)
      .then((response) => response.json())
      .then((cnpjFields) => {
        document.querySelector("#nome-empresa").value = cnpjFields["RAZAO SOCIAL"];
        document.querySelector("#segmento-empresa").value = cnpjFields["CNAE PRINCIPAL DESCRICAO"];
        document.querySelector("#email").value = cnpjFields["EMAIL"];
        document.querySelector("#telefone").value = cnpjFields["TELEFONE"];

        document.querySelector("#cep").value = cnpjFields["CEP"];
        document.querySelector("#logradouro").value = cnpjFields["LOGRADOURO"];
        document.querySelector("#complemento").value = cnpjFields["COMPLEMENTO"];
        document.querySelector("#bairro").value = cnpjFields["BAIRRO"];
        document.querySelector("#cidade").value = cnpjFields["MUNICIPIO"];
        document.querySelector("#numero").value = cnpjFields["NUMERO"];
        document.querySelector("#estado").value = cnpjFields["UF"];
      });
  });
}