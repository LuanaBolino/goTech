<?php
require_once 'db.php';

if ( isset( $_GET[ 'id' ] ) ) {
    $id = $_GET[ 'id' ];
    $conn = getDbConnection();
    $stmt = $conn->prepare( 'DELETE FROM produtos WHERE id = ?' );
    if ( !$stmt ) {
        echo 'Erro ao preparar a exclusão: ' . $conn->error;
        exit();
    }

    $stmt->bind_param( 'i', $id );

    if ( $stmt->execute() ) {
        header( 'Location: ../index.html?status=success' );
    } else {
        echo 'Erro ao excluir o produto: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'ID do produto não fornecido!';
}
?>
