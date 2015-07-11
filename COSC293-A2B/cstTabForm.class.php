<?php
require_once("cstForm.class.php");

class cstTabForm extends cstForm
{
    //This class is designed to output forms in a tabular fashion
    //We will be working with an Nx2 table output (two columns of outputs)
    
    /***************************
     *Function: Constructor
     *Purpose: Starts the process of building the tab form up
     *Params: frmName
     *        frmAction - where the form is to be submitted
     *        frmMethod - how the form is to be submitted
     *        tabOptions - any additional actions
     *
     */
    
    public function __construct($sFrmName, $sFrmAction, $sForMethod="GET",$sTableOpts="")
    {
        parent::__construct($sFrmName,$sFrmAction,$sForMethod);
        
        $this->sForm .= "<table $sTableOpts \n";
        
    }
    
    /********************************
     *Function endForm()
     *Purpose: Finish off the elements for the string
     *that is to be represented out form tab output
     Params: sSubmit - any test that is to be associated with
                       the submit button
             sReset - any text that is to be associated with the
                      reset button
                      
     */
    
    public function endForm($sSubmit = "Submit",$sReset = "Reset")
    {
        $this->addTableRow("<input type='submit' value='$sSubmit'/>\n","<input type='reset' value='$sReset'/>\n");
        $this->sForm .= "</table></form>";
        
    }
    
    /***************
     *Function: addTableRow
     *Purpose: Obvious to add a new row to the table
     *Params: sLabel - label for the new row
     *        sValue - what will be put into the
     *                 second column of the row
     */
    
    public function addTableRow($sLabel,$sValue)
    {
        $this->sForm .= "<tr><td>$sLabel</td><td>$sValue</td></tr>";
        
    }
    
    /***********************
     *Function: addTextBox
     *Purpose: Add a simple text box entry into form
     *Params: sLabel - label associated with the textbox
     *        sTxtName - name of the text box
     *        sOpts - any additional options
     */
    
    public function addTextBox($sLabel,$sTxtName,$sOpts="")
    {
        $this->addTableRow($sLabel,"<input type='text' name='$sTxtName' id='$sTxtName' $sOpts />");
        
    }
    
    public function addHidden($sValue,$sTxtName,$sOpts="")
    {
        $this->addTableRow("","<input type='hidden' name='$sTxtName' id='$sTxtName' value='' $sOpts />");
        
    }
    
    public function addPassBox($sLabel,$sName,$sOpts)
    {
        $this->addTableRow($sLabel,"<input type='password, name='$sName' id='$sName' $sOpts");
        
    }
    
    public function addRadio($sLabel,$sName,$sOpts)
    {
        $this->addTableRow($sLabel,"<input type='radio' name='$sName' id='$sName' value='$sValue'");
        
    }
    
    public function addHeader($sHeadertext)
    {
        $this->sForm .= "<tr><td colspan='2'><h3>$sHeadertext</h3></td>";
    }
    
    public function addSelect($sName,$sText,$aOptList,$sOpts="")
    {
        $this->sForm .= "<tr><td>$sText</td><td><select name='$sName' id='$sName' $sOpts>\n";
        
        $this->addOptList($aOptList);
        $this->sForm .="</select></td></tr>\n";
    }
    
    public function addTextArea($sName,$sLabel,$nRows=3,$nCols=40,$sText="")
    {
        $this->addTableRow($sLabel,"<textarea id='$sName' name='$sName' rows='$nRows' cols='$nCols'>" . $sText . "</textArea>");
    }
}


?>