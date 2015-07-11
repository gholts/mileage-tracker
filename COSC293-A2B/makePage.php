
<?php

    print '<html>';
    print '<head>';
         print '<title>Embattled Furniture Company</title>';
         print '<link href="http://kelcstu05/~bryce/css/cst.css" type="text/css" rel="stylesheet" />';
    print '</head>';
    
    print '<body>';
    
        @$dbNWindUpdate = new mysqli("kelcstu03","CST239","UVHILS");
        @$dbNWindUpdate->select_db("CST239");
        
        //criteria for selecting the makeID and description
        $columnList = "*";
        $table = "A2_Make";
        $opt = "makeID";
        //initialized the dbObject
        $dbNWind = new dbObject();
        
        //selects the makeID and desctiption
        $selectMake = $dbNWind->selectQuery($columnList, $table,"","");        
        $makesList = $dbNWind->createArray($selectMake);
        
        //prints the make list array
        //print_r($makesList);        
    
        print '<h3>Select a Product</h3>';
            
        //makes the form
        $makeForm = new cstTabForm("makeForm","modelPage.php","GET");
        //adds the make select box
        $makeForm->addSelect("makeListBox","Make",$makesList,"");
        
        //gets the value selected in the make select box
        
        
        $makeForm->endForm();
        
        print $makeForm->toString();
        
        
    
    print '</body>';
    
    print'</html>';



?>

<?php
   function __autoload($sClassName)
    {
        require_once("$sClassName.class.php");
    
    }
?>