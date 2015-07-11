<?php
session_start();
if(ISSET($_REQUEST["customerName"]))
{

	 @$dbNWindUpdate = new mysqli("","","");
     @$dbNWindUpdate->select_db("test");
        
     //criteria for selecting the makeID and description
     $columnList = "*";
     $table = "a2_order";
     $opt = "makeID";
        //initialized the dbObject
	$customerName = $_REQUEST["customerName"];
	$phoneNum = $_REQUEST["phoneNumber"];
	$email = $_REQUEST["emailAddress"];
	$shipAddress = $_REQUEST["shippingAddress"];
	$cardType = $_REQUEST["creditCardType"];
	print_r($cardType);
	$pst = $_REQUEST["pst"];
	$gst = $_REQUEST["gst"];
	$orderVal = $_REQUEST["totalValue"];
	$sqlStatement = 'insert into a2_order (orderID, customerName, phoneNumber, emailAddress, shippingAddress, creditCardType)values ("NULL",\''.
		$customerName.'\', \''.$phoneNum.'\',\''.$email.'\',\''.$shipAddress.'\',\''.$cardType.'\')';
	
    $dbNWind = new dbObject();
	
	$dbNWind->runQuery($sqlStatement);
	
	$time = time()+60*60*24*180;
	setcookie("customerName", $customerName, $time);
	setCookie("phoneNum", $phoneNum, $time);
	setCookie("emailAddress", $email, $time);
	setCookie("shippingAddress", $shipAddress, $time);
	setCookie("creditCardType", $cardType, $time);
	//setCookie("orderID", $orderID);
	
	$table = "a2_chairmodel";
	$columnList = "numberOnHand, reorderEmailSent";
	
	foreach($_SESSION as $key=>$value)
	{		
		$sqlStatement = "Update $table set numberOnHand = numberOnHand - $value WHERE name = '$key'";
			
			$condition = "name = '$key'";
			$selectPrice = $dbNWind->selectQuery($columnList, $table, $condition,"");
			$row = $selectPrice->fetch_array();
		
		if($row[0] < 5 && $row[1] == false)
		{
			//send email
		}
	}
	//$anArray,$sTable,$sCond=""
	$dbNWind->updateQuery
}
else
{
	//header
}

?>
<?php
   function __autoload($sClassName)
    {
        require_once("$sClassName.class.php");
    
    }
?>
