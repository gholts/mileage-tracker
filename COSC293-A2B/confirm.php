
<?php

session_start();
	@$dbNWindUpdate = new mysqli("kelcstu03","CST239","UVHILS");
        @$dbNWindUpdate->select_db("CST239");
        //initialized the dbObject
        $dbNWind = new dbObject();
    print '<html>';
    print '<head>';
         print '<title>Confirmation</title>';
    print '</head>';
    
    print '<body>';
    print '<div>The following items have been added to your cart: </div>';
    
    print '</body>';
    
    print'</html>';
    
    if(ISSET($_REQUEST["hiddenName"]))
    {
	$model = $_REQUEST["hiddenName"];
	$quantityPurchased = $_REQUEST["orderQuantity"] + 1;
    }
   
    //$price = $_REQUEST["price"];
    
    if(ISSET($_SESSION[$model]))
    {
	$quantity = $_SESSION[$model] + $quantityPurchased;

	$_SESSION[$model] = $quantity;
    }
    else
    {
	$_SESSION[$model] = $quantityPurchased;
    }
    
    print "<div>'$quantityPurchased' of the item '$model'</div>";
    
    print "<br /><a href='cart.php'>Go to Cart</a><br />";
    print "<a href='makePage.php'>Keep Shopping</a>";

?>
<?php
function __autoload($sClassName)
    {
        require_once("$sClassName.class.php");
    }
?>