<?php 
include_once 'models/security/neighborhood.model.php';
function run(){
    $viewData["error"] = "";
    $viewData["neighborhood"] =getHoods();
    renderizar("security/Entregas", $viewData);
}

run();
?>