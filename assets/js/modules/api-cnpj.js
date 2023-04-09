export default function apiCnpj() {
  // campo onde o usuário insere o CNPJ
  const inputCnpj = document.querySelector("#cnpj");
  
  // Quando o usuário preencher o campo de CNPJ e mudar de foco, ele vai fazer a consulta na API
  inputCnpj.addEventListener("blur", function (event) {
    const cnpj = event.target.value;

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
      });
  });
}
