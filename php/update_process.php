<?php
require_once 'db.php';
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' && isset( $_POST[ 'id' ] ) ) {
    $id = $_POST[ 'id' ];
    $categoria = $_POST[ 'categoria' ];
    $nome = $_POST[ 'nome' ];
    $descricao = $_POST[ 'descricao' ];
    $preco = $_POST[ 'preco' ];

    if ( empty( $categoria ) || empty( $nome ) || empty( $preco ) ) {
        header( "Location: ../index.html?id=$id&status=error&message=Por+favor+preencha+todos+os+campos+obrigat%C3%B3rios." );
        exit();
    }

    $conn = getDbConnection();

    $stmt = $conn->prepare( 'UPDATE produtos SET categoria = ?, nome = ?, descricao = ?, preco = ? WHERE id = ?' );
    if ( !$stmt ) {

        header( "Location: ../index.html?id=$id&status=error&message=" . urlencode( $conn->error ) );
        exit();
    }

    $stmt->bind_param( 'ssssi', $categoria, $nome, $descricao, $preco, $id );

    if ( $stmt->execute() ) {
        header( 'Location: ../index.html?status=success' );
    } else {
        header( "Location: ../index.html?id=$id&status=error&message=" . urlencode( $stmt->error ) );
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Método de requisição inválido ou dados do formulário não fornecidos.';
}
?>
