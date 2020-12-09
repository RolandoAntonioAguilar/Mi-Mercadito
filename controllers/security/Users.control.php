<?php
    require_once 'models/security/security.model.php';
    
    function run(){
      $viewData["error"] = "";

      $viewData["users"]=getUserByFilter('');
          
      renderizar("security/Users", $viewData);
    }
    run();
?>