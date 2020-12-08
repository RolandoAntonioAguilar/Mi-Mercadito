<?php
    require_once 'models/security/category.model.php';
    $viewData["error"] = "";
    $viewData["category"] =getCategories();
    renderizar("security/Categorias", $viewData);
?>