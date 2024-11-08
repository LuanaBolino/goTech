const params = new URLSearchParams(window.location.search);
const id = params.get("id");

if (id) {
  //obtendo dados do produto
  fetch(`./php/getproduct.php?id=${id}`)
    .then((response) => response.json())
    .then((product) => {
      console.log(product);
      if (product.id) {
        document.getElementById("id").value = product.id;
        document.getElementById("categoria").value = product.categoria;
        document.getElementById("nome").value = product.nome;
        document.getElementById("descricao").value = product.descricao;
        document.getElementById("preco").value = product.preco;
      } else {
        alert("Produto não encontrado!");
        window.location.href = "index.html";
      }
    })
    .catch((error) => {
      console.error("Erro ao obter o produto:", error);
    });
}
