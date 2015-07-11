<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <title>Embattled Furniture</title>
    
    <!--<link href="http://kelcstu05/~bryce/css/cst.css" type="text/css" rel="stylesheet"/>-->
    <link href="embattled.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="http://kelcstu05/~Bryce/libs/jquery-1.6.4.min.js"></script>

    
    </script>
    
</head>
<body>
    <script type="text/javascript">
    
    </script>
    
    <div id="leftNav">
        
        <a href="makePage.php">Make Page</a>
        <br /><br />
        <a href="makePage">Someting Else</a>
        <br /><br />
        <a href="makePage">Administrative Page</a>
        
                
        
        
    </div>
    
    
    <div id="topNav">
        
        <h1 id="topTitle">Embattled Furniture</h1>
        <h3 id="subTitle">Where dreams begin</h3>
        
        <a id="cart" href="cart.php"><img src="cartLogo.png" height="30px" width="50px" /> Shopping Cart</a>
        
    </div>
    
    <div id="mainPage">
        
        <?php
		if(ISSET($_REQUEST["total"])
		{
			if(ISSET($_COOKIE["customerName"]))
			{
				print "<div id='test'>";
				$total = $_REQUEST['total'];
				$CCArray = array(0=>"Visa",1=>"Master Card",2=>"American Express");
				
				print "<h2>Enter Order Information</h2>";
					   
				$orderForm = new cstTabForm("orderForm","confirmOrder.php","GET");
			   
				//$orderForm->addTextBox("OrderID","orderID");
				$orderForm->addTextBox("Name","customerName", "value='" . $_COOKIE["customerName"] . "'");
				$orderForm->addTextBox("Phone Number","phoneNumber",  "value='" . $_COOKIE["phoneNumber"] . "'");
				$orderForm->addTextBox("Email Address","emailAddress", "value='" . $_COOKIE["emailAddress"] . "'");
				$orderForm->addTextBox("Address","shippingAddress", "value='" . $_COOKIE["shippingAddress"] . "'");
				$orderForm->addSelect("creditCardType","Credit Card Type",$CCArray, "value='" . $_COOKIE["creditCardType"] . "'");
				$orderForm->addTextBox("PST","pst", "value=0.5 readonly='readonly' ");
				$orderForm->addTextBox("GST","gst", "value=0.5 readonly='readonly' ");
				$orderForm->addTextBox("Total Order Value","totalValue","readonly='readonly' value=" . $total ."  ");
			   
				$orderForm->endForm();
				print $orderForm->toString();
				
				 print "</div>";
			}
			else
			{
			
				print "<div id='test'>";
				$total = $_REQUEST['total'];
				$CCArray = array(0=>"Visa",1=>"Master Card",2=>"American Express");
				
				print "<h2>Enter Order Information</h2>";
					   
				$orderForm = new cstTabForm("orderForm","confirmOrder.php","GET");
			   
				//$orderForm->addTextBox("OrderID","orderID");
				$orderForm->addTextBox("Name","customerName");
				$orderForm->addTextBox("Phone Number","phoneNumber");
				$orderForm->addTextBox("Email Address","emailAddress");
				$orderForm->addTextBox("Address","shippingAddress");
				$orderForm->addSelect("creditCardType","Credit Card Type",$CCArray,"");
				$orderForm->addTextBox("PST","pst", "value=0.5 readonly='readonly' ");
				$orderForm->addTextBox("GST","gst", "value=0.5 readonly='readonly' ");
				$orderForm->addTextBox("Total Order Value","totalValue","readonly='readonly' value=" . $total ."  ");
			   
				$orderForm->endForm();
				print $orderForm->toString();
				
				 print "</div>";
        }
		}
		else
		{
		//header
		}
        ?>
        
        
    </div>
</body>
</html>


<?php
   function __autoload($sClassName)
    {
        require_once("$sClassName.class.php");
    
    }
?>
