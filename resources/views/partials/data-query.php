<?php

$registration = $_POST['registration'];
$name= $_POST['name'];
$email= $_POST['email'];

if ($registration == "success"){
    // some action goes here under php

    $endpoint = file_get_contents('https://w2dufry7w8.execute-api.us-west-2.amazonaws.com/test');

    $decoded_json = json_decode($endpoint, true);
    $_SESSION["data"] = $decoded_json["data"];

    $_SESSION["data"] = array_reverse($_SESSION["data"]);

    echo json_encode($_SESSION["data"]);
}
/*

*/
?>
