<?php 
    require_once 'models/security/security.model.php';
    function run(){
        $viewData["userRoles"] = array();
        $viewData["userAvalaibleRoles"] = array();


        
        
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            if(isset($_GET["cod"])){
                $viewData["userCod"] = $_GET["cod"];
                
                $viewData["userRoles"] = userRoles($viewData["userCod"]);
                $viewData["userAvalaibleRoles"] = userAvalaibleRoles($viewData["userCod"]);

               foreach($viewData["userAvalaibleRoles"] as $key => $value){
                $viewData["userAvalaibleRoles"][$key]["userCod"]=$viewData["userCod"];
               }
               
            }
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(!empty($_POST)){
                $varBody = $_POST;
                $role ="";
                mergeFullArrayTo($varBody,$viewData);
            }
            if(isset($_POST["btnDenegar"])){
                
                $role = $varBody["typeDsc"];
                
                if(removeRole($varBody["typeCod"],$varBody["userCod"])){
                    $viewData["userRoles"] = userRoles($viewData["userCod"]);
                    $viewData["userAvalaibleRoles"] = userAvalaibleRoles($viewData["userCod"]);
                    foreach($viewData["userAvalaibleRoles"] as $key => $value){
                        $viewData["userAvalaibleRoles"][$key]["userCod"]=$viewData["userCod"];
                       }
                }
            }
            if(isset($_POST["btnAcceder"])){
                $role = $varBody["typeDsc"];
                if(addRole($varBody["typeCod"],$varBody["userCod"])){
                    $viewData["userRoles"] = userRoles($viewData["userCod"]);
                    $viewData["userAvalaibleRoles"] = userAvalaibleRoles($viewData["userCod"]);
                    foreach($viewData["userAvalaibleRoles"] as $key => $value){
                        $viewData["userAvalaibleRoles"][$key]["userCod"]=$viewData["userCod"];
                       }
                }
            }
        }

        renderizar("security/Roles", $viewData);
    }
    run();
?>