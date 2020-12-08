<?php 
require_once 'models/security/category.model.php';
require_once 'models/security/state.model.php';

    $viewData = array();
    $viewData["states"] = getState() ;
    $viewData["act"] = "";
    $viewData["readonly"]="";
    $viewData["mode"]= "";
    $viewData["token"]="";
    $viewData["hasErros"] = false;
    $viewData["errors"]=array();
    //Crea un arreglo con los distintas operaciones, esto es para mostrar texto
    $viewData["modeDsc"] = array("INS"=>"Agregando Nueva Categoria", "UPD"=>"Actualizando Categoria", "DSP"=>"Mostrando Categoria");
    if(isset($_GET["act"])){
        $viewData["act"] = $_GET["act"];
        $viewData["mode"] = $viewData["modeDsc"][$viewData["act"]];
    }

    switch($viewData["act"]){
        case "INS":
            break;
        case "UPD":
            break;
        case "DSP":
            $viewData["readonly"]="readonly disabled";
            break;
        default:
            redirectWithMessage("Sucedio un error, vuelve a intentarlo", "index.php?page=Categorias");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //Si el post viene del boton confirmar
        if(isset($_POST["btnConfirmar"])){
            $varBody = array();
            $varBody = $_POST;
            mergeFullArrayTo($varBody, $viewData);
            $validated = true;
            //Revisa que el token sea valido
            if($varBody["token"]!=$_SESSION["categorias_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo salio mal, vuelve a intentarlo", "index.php?page=Categorias");
            }
            //Si las validaciones salen bien procede a crear o actualizar dependiendo de la accion
            if($validated){
                switch($viewData["act"]){
                    case "INS":
                        $result = "";
                        $result=newCategory($varBody["catDscES"],$varBody["catDscEN"],$varBody["catState"]);
                        if($result){
                            redirectWithMessage("Categoria Creada Correctamente","index.php?page=Categorias");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear la Categoria";
                        }
                        break;
                    case "UPD":
                        $result = "";
                        $result=updateCategory($varBody["catCod"], $varBody["catDscES"], $varBody["catDscEN"],$varBody["catState"]);
                        if($result){
                            redirectWithMessage("Categoria Modificada Correctamente","index.php?page=Categorias");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar la categoria";
                        }
                        break;
                }
            }

        }
    }
    //Crea el token
    $viewData["token"] = md5("token_categorias".time());
    $_SESSION["categorias_token"] = $viewData["token"];
    //Si se esta actualizando llena el combobox el valor anteriormente guardado
    if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
        $categories = array();
        $categories = getCategoryByCode($_GET["cod"]);
        mergeFullArrayTo($categories, $viewData);
    }
    if(isset($viewData["catState"])){
        $viewData["states"] = addSelectedCmbArray($viewData["states"],'stateCod',$viewData["catState"]);
    }
    renderizar("security/Categoria", $viewData);
?>