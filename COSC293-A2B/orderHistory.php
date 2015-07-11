
<?php

    print '<html>';
    print '<head>';
         print '<title>Order History</title>';
    print '</head>';
    
    print '<body>';
	if(!ISSET($_REQUEST["orderHistory"]))
	{
		
		$orderForm = new cstTabForm("orderForm","orderHistory.php","POST");
        //adds the make select box
		
		@$dbNWindUpdate = new mysqli("kelcstu03","CST239","UVHILS");
        @$dbNWindUpdate->select_db("CST239");
        //initialized the dbObject
        $dbNWind = new dbObject();
		
		$columnList = "DISTINCT *";
        $table = "a2_order";
        $group = "customerName";
        //initialized the dbObject
        $dbNWind = new dbObject();
        
        //selects the makeID and desctiption
        $selectOrders = $dbNWind->selectQuery($columnList, $table,"","",$group);        
		$orders = $dbNWind->createArray($selectOrders);
		//print_r($orders);
        $orderForm->addSelect("orderHistory","Order History",$orders,"");
        
        //gets the value selected in the make select box
		
        $orderForm->endForm();
        
        print $orderForm->toString();
	}
	else
	{
	
		$orderHistory = $_REQUEST["orderHistory"];
		
		$orderForm = new cstTabForm("orderForm","orderHistory.php","POST");
        //adds the make select box
		
		@$dbNWindUpdate = new mysqli("kelcstu03","CST239","UVHILS");
        @$dbNWindUpdate->select_db("CST239");
        //initialized the dbObject
        $dbNWind = new dbObject();
		
		$columnList = "*";
        $table = "a2_order";
        $group = "customerName";
        //initialized the dbObject
        $dbNWind = new dbObject();
        
        //selects the makeID and desctiption
        $selectOrders = $dbNWind->selectQuery($columnList, $table,"","",$group);        
		$orders = $dbNWind->createArray($selectOrders);
		//print_r($orders);
        $orderForm->addSelect("orderHistory","Order History",$orders,"");
        
        //gets the value selected in the make select box
		
        $orderForm->endForm();
        
        print $orderForm->toString();
	}
	print '</body>';
	
	print '</html>';
?>
<?php
   function __autoload($sClassName)
    {
        require_once("$sClassName.class.php");
    
    }
?>
