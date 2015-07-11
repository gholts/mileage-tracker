<?php
    print '<html>';
    print '<head>';
    print '<title>Working With Cart Objects</title>';
    
    
    
    print '</head>';
    print '<body>';
    
    session_start();
    $variable = $_SESSION['cart'];
    
    print '<pre> $variable is ' . print_r($variable, true) . '</pre>';
    
    print '</body>';
    print '</html>';
?>

<?php

function __autoload($sClassName)
{
    require_once("classes/$sClassName.class.php");
}

?>