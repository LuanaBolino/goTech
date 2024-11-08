<?php
require_once 'db.php';

if ( isset( $_GET[ 'id' ] ) ) {
    $id = $_GET[ 'id' ];

    $conn = getDbConnection();

    $stmt = $conn->prepare( 'SELECT * FROM produtos WHERE id = ?' );
    $stmt->bind_param( 'i', $id );
    $stmt->execute();
    $result = $stmt->get_result();

    if ( $result->num_rows > 0 ) {
        $row = $result->fetch_assoc();
        echo json_encode( $row );
    } else {
        http_response_code( 404 );
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code( 400 );
}
?>
