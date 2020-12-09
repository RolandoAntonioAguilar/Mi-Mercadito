<?php 
    require_once 'models/security/product.model.php';
    require_once 'models/security/category.model.php';
    require_once 'models/security/variations.model.php';
    require_once 'models/support/cart.model.php';
    function run(){
        $viewData = array();
        //Obtiene las categorias con productos activos
        $viewData["categories"]=getCategoriesWithActiveProducts();
        //Obtiene los productos activos
        $viewData["products"] = getActiveProducts();
        $viewData=variations($viewData);
        //Parte del filtro
        $viewData["activeFilter"]="";
        $viewData["check"]='<i class="fas fa-check"></i>';
        $codeExists = "";
        //Si no existe la inilizacion del carrito la hace
        if(!isset($_SESSION["cart"])){
            $_SESSION["cart"]=array();
        }
        if(isset($_GET["page"])){
            $viewData["page"]=$_GET["page"];
            foreach($viewData["categories"] as $key => $value){
                $viewData["categories"][$key]["page"]=$_GET["page"];
            }
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            //Cuando realiza el POST reviza si es para añadir un producto al carrito, ir a la pantalla de compra o si viene del filtro
            $varBody = $_POST;
                if(isset($_POST["btnCart"])){
                    //Primero revisa si hay stock
                    if(addCart($varBody["radio"],$varBody["prdCod"])){
                        redirectWithMessage("Lo que ordenaste ya no se encuentra disponible", "index.php?page=".$viewData["page"]);
                    }
                    //Si hay lo añade y hace refresh
                    redirectToUrl("index.php?page=".$viewData["page"]);
                }//btnCart   
                if(isset($_POST["btnCheckout"])){
                    resetCart();
                    //Primero revisa si hay stock
                    if(addCart($varBody["radio"],$varBody["prdCod"])){
                        redirectWithMessage("Lo que ordenaste ya no se encuentra disponible", "index.php?page=".$viewData["page"]);
                    }
                    //Si hay lo añade y hace refresh
                    redirectToUrl("index.php?page=Checkout");     
                }//btnCheckout 
                if(isset($_POST["btnFiltro"])){
                    //Realiza un filtro para obtener los productos de esa categoria
                    $viewData["products"]=getActiveProductByCategoryCode($varBody["catCod"]);
                    $viewData=variations($viewData);
                    $viewData["check"]='';
                    foreach($viewData["categories"] as $key => $value){
                        $viewData["categories"][$key]["page"]=$_GET["page"];
                        if($viewData["categories"][$key]["catCod"]===$varBody["catCod"]){
                            $viewData["categories"][$key]["check"]='<i class="fas fa-check"></i>';
                        }
                    }
                }   
        }
        renderizar("store",$viewData);    
    }
    //Muestra las distintas variaciones de los productos
    function variations($viewData){
        foreach($viewData["products"] as $key1 => $value){
        $viewData["products"][$key1]["page"]=$_GET["page"];
            if(!empty(getActiveVariations($viewData["products"][$key1]["prdCod"]))){
                $viewData["products"][$key1]["variations"]=getActiveVariations($viewData["products"][$key1]["prdCod"]);
                    foreach($viewData["products"][$key1]["variations"] as $key2 => $value){
                        $viewData["products"][$key1]["variations"][$key2]["prdDscES"]=$viewData["products"][$key1]["prdDscES"];
                        $viewData["products"][$key1]["variations"][$key2]["variationCod"]=
                        $viewData["products"][$key1]["prdCod"].'_'.$viewData["products"][$key1]["variations"][$key2]["variationCod"];
                    }
            }
        }
        return $viewData;
    }
    
    run();

?>