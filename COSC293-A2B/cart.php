<?php
    session_start();
    print '<html>';
    print '<head>';
        print '<title>Furniture Cart</title>';
    
    print '</head>';
    
    print '<body>';
	print "<h1> YOUR CART! </h1>";
	
		@$dbNWindUpdate = new mysqli("kelcstu03","CST239","UVHILS");
		@$dbNWindUpdate->select_db("CST239");
		
		$columnList = "DISTINCT SellingPrice";
		$table = "A2_ChairModel";
		
		$total = 0;
		
		$tax = 0.10;
		
		$dbNWind = new dbObject();
		//$selectMake = $dbNWind->selectQuery($columnList, $table,"","");
		$cartForm = new cstTabForm("cartForm","orderInfo.php","POST");
        //adds the make select box
       
		foreach($_SESSION as $key=>$value)
		{
			$condition = "name = '$key'";
			$selectPrice = $dbNWind->selectQuery($columnList, $table,$condition,"");
			$row = $selectPrice->fetch_array();

			//Select SellingPrice FROM A2_ChairModel Where Name =
			print "<tr><td>" .$key . "</td><td>..........." . $value . "</td><td>x</td><td>$".$row[0];
			print "</td></tr>";
			
			$total .= $row[0];
		}
	   //print '<br/><a href="session2.php">Go to next Page</a>';
		print "<h2>Your total comes to...</h2>";
		if ($total > 0)
		{
			$totalAfterTax = ($total * $tax) + $total;
			$cartForm->addTextBox("$", "total", "readonly='readonly' size=6 value=" . $totalAfterTax);
		}
		else
		{
			$cartForm->addTextBox("$", "total", "readonly='readonly' size=6 value=" . $total);
		}
		print $cartForm->toString();
		
		print"</table>";

		print "<input type='submit' value='Finalize Cart'/>";
		print"</form>";
		//print "<h3><input type='text' id='total' name='total' value=$" . $total. "></h3>";
	
    print '</body>';
    
    print '</html>';
?>
<?php
function __autoload($sClassName)
    {
        require_once("$sClassName.class.php");
    }
?>