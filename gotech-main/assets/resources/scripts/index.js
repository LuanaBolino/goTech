const btnAddProduto = document.getElementById("btn-add-produto");
const modal = document.getElementById("modal");
const modal_edit = document.getElementById("modal-edit");
const btnCancel = document.getElementById("btn-cancelar");
const btnCancel_edit = document.getElementById("btn-cancelar-edit");

//modal de adição-----------------------------------------
btnAddProduto.addEventListener("click", function () {
  modal.style.display = "block";
});

window.addEventListener("click", function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
});

btnCancel.addEventListener("click", function () {
  modal.style.display = "none";
});

//modal de edição----------------------------------------

function openEditModal(productId) {
  fetch(`php/get_update.php?id=${productId}`)
    .then((response) => response.json())
    .then((product) => {
      console.log(product);
      document.getElementById("id").value = product.id;
      document.getElementById("categoria").value = product.categoria;
      document.getElementById("nome").value = product.nome;
      document.getElementById("descricao").value = product.descricao;
      document.getElementById("preco").value = product.preco;

      const modalEdit = document.getElementById("modal-edit");
      modalEdit.style.display = "block";
    })
    .catch((error) => {
      console.error("Erro ao obter o produto:", error);
    });
}

btnCancel_edit.addEventListener("click", function () {
  modal_edit.style.display = "none";
});
