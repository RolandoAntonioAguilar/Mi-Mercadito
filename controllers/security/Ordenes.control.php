<?php 
    require_once 'models/orders.model.php';
    require_once 'models/security/status.model.php';
    function run(){
        $limit = 10;
        $bottom = 0;
        $top = $limit;
        $viewData = array();
        $viewData["show"]=true;
        $pagination = 1;

        if(isset($_GET["n"])){
            $pagination = $_GET["n"];
        }

        if(isset($_GET["page"])){
            $viewData["page"]= $_GET["page"];
        }
    
        $viewData["cod"] = "";
        $viewData["statuses"] = getStatuses();
        $viewData["orderBy"] = array(array("cod"=>'ASC',"Dsc"=>"Pasadas"),array("cod"=>'DESC',"Dsc"=>"Mas Recientes"));
        
        if(!empty($viewData["orders"])){
            $totalOrders = count($viewData["orders"]);
            $totalOrders = ceil($totalOrders/$limit);
            if($totalOrders>0){
                if(isset($_GET["recentCMB"])){
                    for($x = 0; $x<$totalOrders; $x++)
                        $viewData["pagination"][] = array("cod"=>$x+1, "recentCMB"=>$viewData["recentCMB"],"statusesCMB"=>$viewData["statusesCMB"],"txtFiltar"=>$viewData["txtFiltar"]);                        
                }else{
                    for($x = 0; $x<$totalOrders; $x++)
                        $viewData["pagination"][] = array("cod"=>$x+1);
                }
            }
        }
        $top = $limit*$pagination;
        if($pagination!=1){
            for($x = 1 ; $x<$pagination; $x++){
                $bottom += $limit;
            }
        }
        $viewData["pagination"] = addSelectedCmbArray($viewData["pagination"],"cod",$pagination);

        $viewData["orders"]=getOrders();
        if(!empty($viewData["orders"])){
            foreach($viewData["orders"] as $key => $value){
                $viewData["orders"][$key]["orderDeliverTime"] = date('d/m/y h:i A',$viewData["orders"][$key]["orderDeliverTime"]);
                $viewData["orders"][$key]["orderMade"] = date('d/m/y h:i A',$viewData["orders"][$key]["orderMade"]);
                $viewData["orders"][$key]["color"] = stateColor($viewData["orders"][$key]["statusCod"]);
                $viewData["orders"][$key]["subtotal"] = sprintf('%0.2f',$viewData["orders"][$key]["orderTotal"] -($viewData["orders"][$key]["orderIsv"] + $viewData["orders"][$key]["orderShippingFee"]));
                $viewData["orders"][$key]["orderDetail"] = getDetailOrder($viewData["orders"][$key]["orderCod"]);
            }
        }
        renderizar('security/Ordenes', $viewData);
    }
    function stateColor($state){
        switch($state){
            case 'DNY':
                return "orange";
                break;
            case 'PRP':
                return "blue";
                break;
            case 'OMW':
                return "green";
                break;
             case 'DLV':
                return "";
                break;
            default:
                return 'yellow';
                break;
        }
    }
    run();
?>