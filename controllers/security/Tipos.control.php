<?php
    require_once 'models/security/types.model.php';
    $viewData["error"] = "";
    $viewData["types"] =getTypes();
    renderizar("security/Tipos", $viewData);
?>