<?php 
require_once 'models/security/status.model.php';
require_once 'models/security/state.model.php';
require_once 'models/orders.model.php';
require_once "libs/sendmail.php";
    function run(){
        $viewData = array();
        $viewData["statuses"] = getStatuses() ;
        $viewData["act"] = "";
        $viewData["readonly"]="";
        $viewData["mode"]= "";
        $viewData["token"]="";
        $viewData["hasErros"] = false;
        $viewData["errors"]=array();
        if($_SERVER["REQUEST_METHOD"]=="POST"){
             //Si el post viene del boton confirmar
            if(isset($_POST["btnConfirmar"])){
                $varBody = $_POST;
                mergeFullArrayTo($varBody, $viewData);
                $validated = true;
                //Revisa que el token sea valido
                if($varBody["token"]!=$_SESSION["orden_token"]){
                    error_log("Critical Token Error");
                    redirectWithMessage("Parece que algo salio mal, vuelve a intentarlo", "index.php?page=Ordenes");
                }
                //Si es valido cambia el estado de la orden
                if($validated){
                    $result=updateOrderStatus($varBody["orderCod"],$varBody["orderStatus"]);
                    if($result){
                        $orderMail = getOrderMail($varBody["orderCod"]);
                        $html = createHtmlBody($varBody["orderStatus"]);
                        sendemail($orderMail["userEmail"], 'Estado de Orden', $html);
                        redirectWithMessage("Orden Modificada Correctamente","index.php?page=Ordenes");
                    }else{
                        $viewData["hasErrors"]=true;
                        $viewData["errors"][]="No se pudo modificar la Orden";
                    }
                }

            }
        }
        $viewData["token"] = md5("token_ordenes".time());
        $_SESSION["orden_token"] = $viewData["token"];

        if(isset($_GET["cod"])){
            $orderStatus = array();
            $orderStatus = getOrderStateByCode($_GET["cod"]);
            mergeFullArrayTo($orderStatus, $viewData);
        }
        if(isset($viewData["orderStatus"])){
            $viewData["statuses"] = addSelectedCmbArray($viewData["statuses"],"statusCod",$viewData["orderStatus"]);
        }
        renderizar("security/Orden", $viewData);
    }
    function createHtmlBody($orderStatus){
        $htmlBody = '<!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>e-commerce</title>
                <style>
                    * {
                    font-family: "Poppins", sans-serif;
                    }
        
                    .mail {
                    background-color: #f7f9fc;
                    padding: 1em;
                    }
        
                    .action-title {
                    background-color: #040c5c;
                    padding: 0.5em;
                    margin: 1em 0px;
                    border-radius: 9px;
                    }
        
                    .action-title h1 {
                    text-align: center;
                    opacity: 1;
                    color: #fff;
                    font-size: 2em !important;
                    }
        
                    .content {
                    border-radius: 9px;
                    text-align: center;
                    margin: 0em;
                    background-color: #040c5c;
                    padding: 1em;
                    color: #000;
                    }
        
                    .content h2 {
                    background-color: transparent;
                    font-size: 2em;
                    }
                    .content .messages{
                        padding: 1.5em;
                        border-radius: 9px;
                        background-color: #f7f9fc;
                    }
                    .content .messages li {
                        list-style: none;
                    text-align: center;
                    font-size: 1em;
                    }
                    .thanks{
                        text-align: center;
                        color: #000;
                        font-size: 1.2em;
                        list-style: none;
                    }
                    @media (min-width: 1024px) {
                    .mail {
                        padding: 10em;
                    }
                    .content {
                        padding: 3em;
                        
                    }
                    .content .messages{
                        padding: 2em;
                        border-radius: 9px;
                        font-size: 1.5em;
                        background-color: #f7f9fc;
                    }
                    }
        
                </style>
            </head>
            <body>
                <div class="mail">
                    <div class="action-title">
                        <h1>e-commerce</h1>
                    </div>
                    <div class="content">
                        <ul class="messages">';
                            
        
        switch($orderStatus){
            case 'DNY':
                $htmlBody.='<li>Tu orden fue denegada.</li>';
                break;
            case 'PRP':
                $htmlBody.='<li>Tu orden está siendo preparada.</li>';
                break;
            case 'OMW':
                $htmlBody.='<li>Tu orden está en camino, te contactaremos muy pronto.</li>';
                break;
                case 'DLV':
                $htmlBody.='<li>Tu orden fue entregada.</li>';
                break;
            default:
            $htmlBody.='<li>Tu orden está siendo preparada.</li>';
                break;
        }
        $htmlBody .= '</ul>                
                    </div>
                    <p class="thanks">Gracias por comprar con nosotros.</p>
                </div>
            </body>
            </html>';
        return $htmlBody;       
    }
    run();
?>