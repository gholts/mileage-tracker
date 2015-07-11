<?php

require_once("lineItem.class.php");

//Class for storing items for sale

class cart
{
    private $aItems;
    
    public function __construct()
    {
        $this->aItems = array();
    }
    
    /******************
     *Function: add
     *Purpose:  Add an item to cart.
     *Note:     Don't add duplicates. Increment increases.
     *****************/
    public function add($obItem)
    {
        if(!is_a($obItem, "lineItem"))
        {
            //print 'Wrong object type';
            //exit(1);
            throw new Exception("Must add a line item.");
        }
        
        if(!isset($this->aItems[$obItem->getKey()]))
        {
            //item doesn't exist
            $this->aItems[$obItem->getKey()] = $obItem;
        }
        else
        {
            //Item already exists - add to existing qty
            $cartItem = $this->aItems[$obItem->getKey()];
            print "Got here";

            $cartItem->setQty($obItem->getQty() + $cartItem->getQty());

        }
    }
    
    public function remove($obItem)
    {
        $nKey = $obItem->getKey();
        $obCartItem = $this->aItems[$nKey];
        
        $obCartItem->setQty($obCartItem->getQty() - 1);
        
        if($obCartItem->getQty() == 0)
        {
            unset($this->aItems[$nKey]);
        }
    }
    
    public function listContents()
    {
        foreach($this->aItems as $nKey=>$obLineItem)
        {
            print "<br/>$nKey......" . $obLineItem->getQty();
        }
    }
    
}

?>