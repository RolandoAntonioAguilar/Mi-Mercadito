<?php 
    require_once 'models/security/access.model.php';
    $viewData["hasAccess"] = array();
    $viewData["deniedAccess"] = array();
    $viewData["typeCod"] = "";
    
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(isset($_GET["cod"])){
            $viewData["typeCod"] = $_GET["cod"];

            $viewData["hasAccess"] = hasAccess($viewData["typeCod"]);
            $viewData["deniedAccess"] = deniedAccess($viewData["typeCod"]);
        }
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(!empty($_POST)){
            $varBody = $_POST;
            $module ="";
            mergeFullArrayTo($varBody,$viewData);
        }
        //Si el post viene del formulario que deniega
        if(isset($_POST["btnDenegar"])){
            $module = $varBody["mdlCod"];
            //Si el resultado del post es exitoso carga nuevamente los accesos
            if(removeAccess($varBody["typeCod"],$varBody["mdlCod"])){
                $viewData["hasAccess"] = hasAccess($viewData["typeCod"]);
                $viewData["deniedAccess"] = deniedAccess($viewData["typeCod"]);
            }
        }
        //Si el post viene del formulario que da accesos
        if(isset($_POST["btnAcceder"])){
            $module = $varBody["mdlCod"];
            //Si el resultado del post es exitoso carga nuevamente los accesos
            if(giveAccess($varBody["typeCod"],$varBody["mdlCod"])){
                $viewData["hasAccess"] = hasAccess($viewData["typeCod"]);
                $viewData["deniedAccess"] = deniedAccess($viewData["typeCod"]);
            }
        }
    }

    renderizar("security/Acceso", $viewData);

?>