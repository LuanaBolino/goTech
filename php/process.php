<?php
// process.php
require_once './db.php';

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    $categoria = $_POST[ 'categoria' ];
    $nome = $_POST[ 'nome' ];
    $descricao = $_POST[ 'descricao' ];
    $preco = $_POST[ 'preco' ];

    if ( empty( $categoria ) || empty( $nome ) || empty( $preco ) ) {
        header( 'Location: ../index.html?status=error&message=Por+favor+preencha+todos+os+campos+obrigat%C3%B3rios.' );
        exit();
    }

    $conn = getDbConnection();

    $stmt = $conn->prepare( 'INSERT INTO produtos (categoria, nome, descricao, preco) VALUES (?, ?, ?, ?)' );
    if ( !$stmt ) {
        header( 'Location: ../index.html?status=error&message=' . urlencode( $conn->error ) );
        exit();
    }

    $stmt->bind_param( 'ssss', $categoria, $nome, $descricao, $preco );

    if ( $stmt->execute() ) {
        header( 'Location: ../index.html?status=success' );
    } else {
        header( 'Location: ../index.html?status=error&message=' . urlencode( $stmt->error ) );
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Método de requisição inválido.';
}
?>
