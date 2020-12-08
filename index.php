<?php
/**
 * PHP Version 5
 * Application Router
 *
 * @category Router
 * @package  Router
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @author   Luis Fernando Gomez Figueroa <lgomezf16@gmail.com>
 * @license  Comercial http://
 *
 * @version 1.0.0
 *
 * @link http://url.com
 */
session_start();

require_once "libs/utilities.php";

$pageRequest = "home";


if (isset($_GET["page"])) {
  $pageRequest = $_GET["page"];
}


require_once "controllers/mw/verificar.mw.php";
require_once "controllers/mw/site.mw.php";


//Este switch se encarga de todo el enrutamiento público
switch ($pageRequest) {
  //Accesos Publicos
case "home":
  //llamar al controlador
  include_once "controllers/home.control.php";
  die();
case "login":
  include_once "controllers/security/login.control.php";
  die();
case "logout":
  include_once "controllers/security/logout.control.php";
  die();
}

//Este switch se encarga de todo el enrutamiento que ocupa login
$logged = mw_estaLogueado();
if ($logged) {
    addToContext("layoutFile", "verified_layout");
    include_once 'controllers/mw/autorizar.mw.php';
    if (!isAuthorized($pageRequest, $_SESSION["userEmail"])) {//Aqui
        include_once "controllers/notauth.control.php";
        die();
    }
    else{
      generarMenu($_SESSION["userEmail"]);
    } 
}

require_once "controllers/mw/support.mw.php";
switch ($pageRequest) {


case "start":
    ($logged)?
      include_once "controllers/home.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
      die();
case "storeL":
    ($logged)?
      include_once "controllers/store.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
      die();
case "cartL":
    ($logged)?
      include_once "controllers/cart.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
      die();
case "Users":
    ($logged)?
      include_once "controllers/security/Users.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "User":
    ($logged)?
      include_once "controllers/security/User.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Roles":
    ($logged)?
      include_once "controllers/security/Roles.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Tipos":
    ($logged)?
      include_once "controllers/security/Tipos.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Tipo":
    ($logged)?
      include_once "controllers/security/Tipo.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Categorias":
    ($logged)?
      include_once "controllers/security/Categorias.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Categoria":
    ($logged)?
      include_once "controllers/security/Categoria.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Modulos":
    ($logged)?
      include_once "controllers/security/Modulos.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Modulo":
    ($logged)?
      include_once "controllers/security/Modulo.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Accesos":
    ($logged)?
      include_once "controllers/security/Accesos.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Acceso":
    ($logged)?
      include_once "controllers/security/Acceso.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Productos":
    ($logged)?
      include_once "controllers/security/Productos.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Producto":
    ($logged)?
      include_once "controllers/security/Producto.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Entregas":
    ($logged)?
      include_once "controllers/security/Entregas.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Entrega":
    ($logged)?
      include_once "controllers/security/Entrega.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Manejos":
    ($logged)?
      include_once "controllers/security/Manejos.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Manejo":
    ($logged)?
      include_once "controllers/security/Manejo.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Ordenes":
    ($logged)?
      include_once "controllers/security/Ordenes.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Orden":
    ($logged)?
      include_once "controllers/security/Orden.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
            
case "Checkout":
    ($logged)?
      include_once "controllers/user/Checkout.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Historial":
    ($logged)?
      include_once "controllers/user/history.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Change":
    ($logged)?
      include_once "controllers/user/change.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Directions":
    ($logged)?
      include_once "controllers/user/directions.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();        
case "Approved":
    ($logged)?
      include_once "controllers/user/approved.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "Canceled":
    ($logged)?
      include_once "controllers/user/canceled.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
                             
}

addToContext("pageRequest", $pageRequest);
require_once "controllers/error.control.php";
