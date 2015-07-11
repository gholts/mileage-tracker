<?php

    class cstForm
    {
        protected $sForm; // String Attribute for building up a form
        
        /*************************************************
         *Function  Constructor
         *Purpose   This will start the process by which we are going to
         *          build up our text representation for our form object.
         *          Remember that forms have a number of attributes associated
         *          with them that should be set - these shall be passed in
         *          
         *************************************************/
        
        public function __construct($sName, $sAction, $sMethod='GET')
        {
            $this->sForm = "<form name='$sName' id='$sName' action='$sAction' " .
                            "method='$sMethod'>";
        }
        
        /*********************************************************
         *Function  endForm()
         *Purpose   This routine just completes out form by outputting
         *          a submit button and a reset button
         *          
         *********************************************************/
        public function endForm($sSubmit="Submit Form", $sReset="Reset")
        {
            $this->sForm .= "<br/><input type='submit' value='$sSubmit' />" .
                            "<input type='reset' value='$sReset' />";
            $this->sForm .= '</form>';
        }
        
        /***********************************************************
         *Function  toString()
         *Purpose   With this method we assume that the programmer
         *          has finished with the form. Just going to return the
         *          string  we are building up
         *          
         ***********************************************************/
        public function toString()
        {
            return $this->sForm;
        }
        
        /***********************************************************
         *Function  addTextBox
         *Purpose   This routine will just add a label and a text box
         *          to our for, the label and text box names must be
         *          passed in.
         *
         *Params    $sLabel - Obviously the label for the text box
         *          $sTxtName - Name of the text box
         *          $sOpts - Additional options
         ***********************************************************/
        public function addTextBox($sLabel, $sTxtName, $sOpt='')
        {
            $this->sForm .= "<br/>$sLabel " .
                            "<input type='text' name='$sTxtName' id='$sTxtName' " .
                            "$sOpt />\n";
        }
        
         /***********************************************************
          *Function addHiddenTextBox
          *Purpose  This routine will just add a hidden text box
          *to our form. The text box will name and value must be
          *passed in
          *Params   sTxtName: The name of the hidden box
          *         sValue The value to be returned for this text box
          *         sOpts additional options
          ***********************************************************/
         public function addHiddenTextBox($sTxtName,$sValue,$sOpts="")
         {
            $this->Form .= "<br />
            <input type='hidden' name='$sTxtName' id='$sTxtName' value='$sValue' $sOpts />\n";
        
            
         }
         
         public function addPassBox($sLabel,$sName,$sOpts="")
         {
            $this->addTableRow($sLabel, "<input type='password' name='$sName' id='$sName' />\n");
            
         }
        
        /***********************************************************
         *Function  addTextGroup
         *Purpose   This routine shall add to our form string, values
         *          taken from an associative array of text box names
         *          and their associated label values
         *
         *Params    $aTxtList - assoc array of text box names and assoc labels
         *          $sOpts - string of assoc options
         ***********************************************************/
        public function addTextGroup($aTxtList, $sOpts="")
        {
            foreach($aTxtList as $sTxtName=>$sLabel)
            {
                $this->addTextBox($sLabel, $sTxtName, $sOpts);
            }
        }
        
        /***********************************************************
         *Function  addRadioButton
         *Purpose   We want to go ahead and add a radio button with
         *          assoc labels to our form that we are creating.
         *
         *Params    $sLabel - Name the radio button is to be known by
         *          $sName - Name of the radio button
         *          $sValue - the value that the radio selection has
         *          $sOpts - Any additional options
         *          
         ***********************************************************/
        public function addRadioButton($sLabel, $sName, $sValue, $sOpts="")
        {
            $this->sForm .="<br/>$sLabel<input type='radio' name='$sName' " .
                            "id='$sName' value='$sValue' $sOpts />\n";
        }
        
        /***********************************************************
         *Function  addRadioGroup
         *Purpose   Create a radio group
         *
         *Params    $aRadVals - Assoc array of values and their assoc labels
         *          $sName - Common name for the radio grou
         *          $sOpts - Additional options
         ***********************************************************/
        public function addRadioGroup($aRadVals, $sName, $sOpts="")
        {
            foreach($aRadVals as $sValue=>$sLabel)
            {
                $this->addRadioButton($sLabel, $sName, $sValue, $sOpts);
            }
        }
        
        /***********************************************************
         *Function  addHeader
         *Purpose   Just to add a header to the form
         *
         *Params    $sHeaderText - The text you want to display as a header
         *
         ***********************************************************/
        public function addHeader($sHeaderText)
        {
            $this->sForm .= "<h3> $sHeaderText </h3>";
        }
        
        /***********************************************************
         *Function  addSelect
         *Purpose   This routine shall add a select box of some
         *          type to our form
         *
         *Params    $sName - Name of the select box
         *          $aOptList - Assoc array of values and labels for the different options
         *          $sOpts - Additional options
         *          $aPreSelected - The default selected value (optional)
         ***********************************************************/
        public function addSelect($sName, $sLabel, $aOptList, $aPreSelected="", $sOpts="")
        {
            $this->sForm .= "<br/><select name='$sName' id='$sName' " .
                            "$sOpts>\n";
            
            $this->addOptList($aOptList, $aPreSelected);
            
            $this->sForm .= "</select>";
        }
        
        protected function addOptList($aOptList, $aPreSelected="")
        {
            foreach($aOptList as $sValue=>$sLabel)
            {
                if ($sValue == $aPreSelected)
                {
                    $this->sForm .="<option value='$sValue' selected='true'>" .
                    "$sLabel </option>\n";
                }
                else
                {
                    $this->sForm .="<option value='$sValue'>" .
                    "$sLabel </option>\n";
                }

            }
        }
        
        public function addAnchor($sLocation, $sLabel)
        {
            $this->sForm .= "<a href='$sLocation'>$sLabel</a>\n";
        }
        
        public function addText($sText)
        {
            $this->sForm .= "$sText ";
        }
    }
?>