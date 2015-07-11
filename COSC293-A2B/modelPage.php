
<?php

    print '<html>';
    print '<head>';
         print '<title>Working with Variables</title>';
    print '</head>';
    
    print '<body>';
    
?>

<script type="text/javascript">

var getQuantity = function()
{
    var selected = document.getElementById("modelListBox");
    var selectedOption = selected.options[selected.selectedIndex].value;
    
    document.getElementById("txtQOH").value = arrayModels[selectedOption];
    document.getElementById("hiddenName").value =  selected.options[selected.selectedIndex].text;
	
	if(arrayModels[selectedOption] < 6)
	{
		document.getElementById("orderQuantity").options.length = arrayModels[selectedOption];
	}
}
</script>


<?php
        @$dbNWindUpdate = new mysqli("kelcstu03","CST239","UVHILS");
        @$dbNWindUpdate->select_db("CST239");
        //initialized the dbObject
        $dbNWind = new dbObject();
        if(!ISSET($_GET['makeListBox']))
        {
           print "Redirecting to 'Make' Page";
           print "<br /><br />";
           print "<a href='makePage.php'>Click Here</a> to Redirect Now";
            header("Refresh:4; url= makePage.php");
           exit();
        }
        else
        {
            $makeListPos = $_GET["makeListBox"];
            if(!isset($_REQUEST['modelListBox']))
            {
                
                 //get the modelID and name where makeID=value pulled from make selectBox
                $selectModel = $dbNWind->selectQuery("chairModelID,name","A2_ChairModel","makeID=$makeListPos","");
                $modelList = $dbNWind->createArray($selectModel);
                $quantityList = array(1, 2, 3, 4, 5);
                
                $modelForm = new cstTabForm("modelForm","confirm.php","POST");
               // $modelForm->addHiddenTextBox("test", "test");
                //adds the model select box
                fillArray($dbNWind);
                $modelForm->addSelect("modelListBox","Model",$modelList,"onchange='getQuantity()'");       
                
                //prints the quantity of the selected model
                //$modelForm->addTableRow("Quantity on Hand", "<label id=label></label>");
                
                $modelForm->addTextBox("Quantity on Hand","txtQOH","readonly='readonly' size=5");
                $modelForm->addSelect("orderQuantity","OrderQuantity",$quantityList,"");       
                
                $modelForm->addHidden("empty","hiddenName");
                
                
                $modelForm->endForm("Add to Cart");
                
                print $modelForm->toString();
            }
        }
         //gets the value of the model list select box
        $modelListPos = $_REQUEST['modelListBox'];
        
        //$supEmail = $_REQUEST[''];
        $selectEmail = $dbNWind->selectQuery("supplierEmail","A2_ChairModel","makeID=$makeListPos","");
        $emailList = $dbNWind->createArray($selectEmail);
        $emailAddress = $selectEmail[$makeListPos];
        $model = $modelList[$modelListPos];
        
        mail("$emailAddress","Low Stock","$model has less than 5 units in stock","From:'yourSystem@derp.com'");
    
    print '</body>';
    
    print'</html>';
    
?>


<?php
function fillArray($dbNWind)
    {
        
        $selectQOH = $dbNWind->selectQuery("chairModelID,numberOnHand,sellingPrice","A2_ChairModel","","");
	echo "<script type='text/javascript'>";
	echo "var arrayModels = new Array();\n";
	while($row = $selectQOH->fetch_assoc())
	{
		echo "arrayModels[".$row['chairModelID']."] = \"".$row['numberOnHand']."\";\n";
	}
	echo "</script>";
    }
function __autoload($sClassName)
    {
        require_once("$sClassName.class.php");
    }
?>