<?php
    require_once 'models/security/product.model.php';
    $viewData["error"] = "";
    $viewData["product"] =getProducts();
    renderizar("security/Productos", $viewData);
?>