<?php
$server = "127.0.0.1";
$user = "eCommerUser";
$pswd = "p@ssw0rd";
$database = "eCommerce";
$port = "3306";

$emailHost = 'smtp.gmail.com';
$smtpUser = 'tuCorreo@dominio.com';
$smtpSecret = 'tuPassword';
$smtpPort = "587";

$host_server = 'http://localhost/web/e-commerce/';
if (isset($_SERVER["SERVER_MVC"])) {
    $host_server = $_SERVER["SERVER_MVC"];
} else {
    $_SERVER["SERVER_MVC"] = $host_server;
}

?>
    