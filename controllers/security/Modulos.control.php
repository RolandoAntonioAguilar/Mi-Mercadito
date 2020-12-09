<?php
    require_once 'models/security/modules.model.php';
    $viewData["error"] = "";
    $viewData["module"] =getModules();
    renderizar("security/Modulos", $viewData);
?>