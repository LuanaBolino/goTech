//obter os produtos
fetch("./php/get_products.php")
  .then((response) => response.json())
  .then((data) => {
    const tableBody = document.getElementById("productTableBody");
    data.forEach((product) => {
      const row = document.createElement("tr");
      row.innerHTML = `
            <td>${product.id}</td>
            <td>${product.categoria}</td>
            <td>${product.nome}</td>
            <td>${product.descricao}</td>
            <td>${product.preco}</td>
            <td>
                <a href="#" class="edit-link" data-product-id="${product.id}" ><button class="btn-edit">Editar</button></a>
                <a href="./php/delete_product.php?id=${product.id}" onclick="return confirm('Tem certeza que deseja excluir este produto?')"><button class="btn-delete">Excluir</button></a>
            </td>
        `;
      tableBody.appendChild(row);
    });

    const editLinks = document.querySelectorAll(".edit-link");
    editLinks.forEach((link) => {
      link.addEventListener("click", (event) => {
        event.preventDefault();
        const productId = link.getAttribute("data-product-id");
        openEditModal(productId);
      });
    });
  })
  .catch((error) => {
    console.error("Erro ao obter os produtos:", error);
  });
