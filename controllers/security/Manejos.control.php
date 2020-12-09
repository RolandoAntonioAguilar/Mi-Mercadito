<?php
    require_once 'models/support/management.model.php';
    $viewData["error"] = "";
    $viewData["management"] =obtainManagements();
    if(isset($_GET["cod"])){
        $result = "";
        $result=activateManagement($_GET["cod"]);
        if($result)
            redirectWithMessage("Horario Activado Correctamente","index.php?page=Manejos");
        else
            redirectWithMessage("Error Horario no Activado","index.php?page=Manejos");
    }
    renderizar("security/Manejos", $viewData);
?>