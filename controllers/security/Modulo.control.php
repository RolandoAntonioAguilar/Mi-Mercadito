<?php 
require_once 'models/security/modules.model.php';
require_once 'models/security/state.model.php';

    $viewData = array();
    $viewData["module"] = array();
    $viewData["states"] = getState() ;
    $viewData["act"] = "";
    $viewData["readonly"]="";
    $viewData["mode"]= "";
    $viewData["token"]="";
    $viewData["hasErros"] = false;
    $viewData["errors"]=array();
    $viewData["class"]=array(
        array("classCod"=>"MNU", "classDsc"=>"Menu"),
        array("classCod"=>"PGE", "classDsc"=>"Pagina")
    );
    $viewData["modeDsc"] = array("INS"=>"Agregando Nuevo Modulo", "UPD"=>"Actualizando Modulo", "DSP"=>"Mostrando Modulo");
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
            redirectWithMessage("Sucedio un error, vuelve a intentarlo", "index.php?page=Modulos");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
//Si el post viene del boton confirmar
        if(isset($_POST["btnConfirmar"])){
            $varBody = array();
            $varBody = $_POST;
            mergeFullArrayTo($varBody, $viewData);
            $validated = true;
            //Revisa que el token sea valido
            if($varBody["token"]!=$_SESSION["modulos_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo salio mal, vuelve a intentarlo", "index.php?page=Modulos");
            }
            //Si las validaciones salen bien procede a crear o actualizar dependiendo de la accion
            if($validated){
                switch($viewData["act"]){
                    case "INS":
                        $result = "";

                        $result=newModule($varBody["mdlCod"],$varBody["mdlDscES"],$varBody["mdlDscEN"],$varBody["mdlState"], $varBody["mdlClass"]);
                        
                        
                        if($result){
                            redirectWithMessage("Modulo Creado Correctamente","index.php?page=Modulos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear el Tipo de Modulo";
                        }
                        
                        break;
                    case "UPD":
                        $result = "";
                        $result=updateModule($varBody["mdlCod"],$varBody["mdlDscES"],$varBody["mdlDscEN"],$varBody["mdlState"],$varBody["mdlClass"]);

                        
                        if($result){
                            redirectWithMessage("Modulo Modificado Correctamente","index.php?page=Modulos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar el Tipo de Usuario";
                        }
                        break;
                        
                }
            }

        }
    }
    //Crea el token
    $viewData["token"] = md5("modulos_token".time());
    $_SESSION["modulos_token"] = $viewData["token"];
     //Si se esta actualizando llena el combobox el valor anteriormente guardado
    if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
        $modules = array();
        $modules = getModulesByCode($_GET["cod"]);
        mergeFullArrayTo($modules, $viewData);
    }
    if(isset($viewData["mdlState"])){
        $viewData["states"] = addSelectedCmbArray($viewData["states"],'stateCod',$viewData["mdlState"]);
    }
    if(isset($viewData["mdlClass"])){
        $viewData["class"] = addSelectedCmbArray($viewData["class"],'classCod',$viewData["mdlClass"]);
    }
    renderizar("security/Modulo", $viewData);
?>