<?php 
    require_once 'models/support/cart.model.php';
    function run(){
        //Inicializacion de Variables
        $viewData = array();
        $viewData["hasItems"]=false;
        $viewData["subtotal"]=0;
        $viewData["newCart"]=array();
        $products = array();
        $viewData["products"] = array();

        if(isset($_GET["page"])){
            $viewData["page"]=$_GET["page"];
        }
        if(!isset($_SESSION["cart"])){
            $_SESSION["cart"]=array();
        //Si existe carrito en la sesión tomar los productos
        if(isset($_SESSION["cart"])){
            //Toma los productos
            $products = getCartItems($viewData["page"]);
             //Les hace merge a la variable de ViewData
            mergeFullArrayTo($products,$viewData);
            $viewData["subtotal"]=getCartTotal();
            $viewData["subtotal"]= sprintf('%0.2f', $viewData["subtotal"]);
            if($viewData["subtotal"]>0){
                $viewData["hasItems"]=true;
            }
        }//Cart Session
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $varBody = $_POST;
            if(isset($_POST["btnPagar"])){
                if(empty($_SESSION["cart"]) || $_SESSION["cartSize"]==0){
                    redirectWithMessage("Parece que tu canasta esta vacia", "index.php?page=cartL");
                }
                if(checkCartStock()){
                    redirectWithMessage("Parece que algo en tu canasta ya no se encuentra disponible", "index.php?page=cartL");
                }
                redirectToUrl("index.php?page=Checkout");
            }
            //Si el Post es del buton de quitar productos del carrito
            if(isset($_POST["btnAdd"])){
                
                plusCart($varBody["cartCod"],$varBody["prdQuantity"]);
                redirectToUrl("index.php?page=".$viewData["page"]);
            }//btnAdd
            //Si el Post es del buton de quitar cantidad de productos del carrito
            if(isset($_POST["btnLess"])){
                removeCart($varBody["cartCod"]);
                redirectToUrl("index.php?page=".$viewData["page"]);
            }//btnLess
            //Si el Post es del buton de quitar completamente el producto del carrito
            if(isset($_POST["btnTrash"])){
                //// echo "hola";
                trashCart($varBody["cartCod"],$varBody["prdQuantity"]);
                redirectToUrl("index.php?page=".$viewData["page"]);
            }//btnTrash
        }//Server Request
        
        //// echo '<pre>'.print_r($_SESSION["cart"]).'</pre>';
        renderizar("cart", $viewData);
    }
    run();
?>