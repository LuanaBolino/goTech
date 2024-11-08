<?php
require_once 'db.php';

$conn = getDbConnection();

$sql = 'SELECT id, categoria, nome, descricao, preco FROM produtos';
$result = $conn->query( $sql );

$produtos = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $produtos[] = $row;
    }
}

$conn->close();

header( 'Content-Type: application/json' );
echo json_encode( $produtos );
?>
