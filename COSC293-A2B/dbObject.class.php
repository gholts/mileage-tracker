<?php
    /***************************************
     *Class: dbObject
     *Purpose: Create a connection to a MySQL server. Create
     *and execute a SQL Query statement
     ***************************************/
    
    class dbObject
    {
        public $dbConnect;
        
        /****************************************
         *Constructor
         *Purpose: To Create a connection to a MySQL server and
         *open a database on that server
         *
         *Params: sServer - name of the MySQL server
         *        sUSer - name of the user
         *        sPassword - password associated with the user
         *        sDatabase - name of the database we want to use
         *****************************************/
        //"127.0.0.1","root",""
        function __construct($sServer="127.0.0.1", $sUser="root", $sPassword="",
                             $sDatabase="test")
        {
            //Connect to the MySQL server and open the database
            @$this->dbConnect = new mysqli($sServer, $sUser, $sPassword, $sDatabase);
            
            //Check the connection
            if ($this->dbConnect->connect_error)
            {
                print "Connection Failed: " . $this->dbConnect->connect_error;
                exit();
            }
            
        }//End contructor
        
        
        /**************************************
         *Function: selectQuery
         *Purpose: This method will construct a SELECT
         *query statement and execute it
         *
         *PARAMS:
         *         sColumns - list of columns to be displayed
         *         sTableList - names of the tables(s) used in
         *                      the query and the joins required
         *         sSort - how to order the query results
         *         sCondition - any restrictions on the query
         *Return   qryResult - the result after executing the wuery statement
         **************************************/
        function selectQuery($sColumnList, $sTableList, $sCondition="", $sSort="", $sGroup="")
        {
            $sQryStatement = "SELECT $sColumnList FROM $sTableList";
            
            if ($sCondition != "")
            {
                $sQryStatement .= " WHERE $sCondition";
            }
            
            if ($sSort != "")
            {
                $sQryStatement .= " ORDER BY $sSort";
            }
            
			if($sGroup != "")
			{
				$sQryStatement .= " GROUP BY $sGroup";
			}
            //print $sQryStatement . "<br/>";
           // print_r ($sQryStatement);
            return $this->runQuery($sQryStatement);
            
        }//function select Query
        
        
        function updateQuery($anArray,$sTable,$sCond="")
        {
            $string="";
            foreach($anArray as $key=>$val)
            {
                $string .= "$key = '$val', ";
                
            }
            
            $sLen = strlen($string);
            
            $string = substr($string,0,$sLen -2);            
			
            $updateCommand = "Update $sTable set $string $sCond";
        
            return $this->runQuery($updateCommand);
            
        }
        
        
        /*********************************************
         *Function: runQuery
         *Purpose: This method will execute the query
         *statement and return a query result set
         *
         *PARAMS: sQryStatement - query statement as a string
         *
         *Returns: qryResult - the query result
         *          TRUE if the query statement executed successfully else FALSE For
         *          SELECT, SHOW DESCRIBE or EXPLAIN mysqli_query()
         *          will return a result Object.
         *
         ********************************************/
        function runQuery($sQryStatement)
        {
            //Excute the query
            $qryResult = @$this->dbConnect->query($sQryStatement);
            
            //Check to see if it executed with errors
            if(!$qryResult)
            {
                print "<h2>Query could not execute - " . $this->dbConnect->error . "</h2>\n";
                exit();
            }
            
            return $qryResult;
            
        }//function runQuery
        
        
        /***********************************************
         *Function: displayRecords
         *Purpose: This is a helper method to display the records returned by a query
         *
         *Params: qryResult - query results set
         *********************************************/
        function displayRecords($qryResult)
        {
            print "<table border='2'>\n";
            $nRows = $qryResult->num_rows;
            $nFields = $qryResult->field_count;
            
            //create the header row by looking up the field names
            print "<tr>\n";
            
            for ($i=0;$i< $nFields; $i++)
            {
                $fieldInfo = $qryResult->fetch_field();
                print "<th>$fieldInfo->name</th>\n";
            }
            print "</tr>\n";
            
            //$aRow is an associative array that will store the query results
            //$sFieldValue is used to print the contents of each field in each record
            
            for ($i=0;$i<$nRows;$i++)
            {
                print "<tr>\n";
                $aRow = $qryResult->fetch_assoc();
                foreach($aRow as $sFieldValue)
                {
                    print "<td>$sFieldValue</td>\n";
                }
                print "</tr>\n";
                
            }
            
            print "</table><br/>\n";
            
            
            
            
            
            
        }//function displayRecords
        
        
        /******
         *Function: createArray
         *Purpose:  Creates an associative array to be used with the
         *          cstTabForm class methods that populate lists
         *Params:   qryResults: the query result record set
         *Returns:  an associative array constructed fomr the rows
         *          and columns of the query result set
         *******/
        function createArray ($qryResult)
        {
            $nRows = $qryResult->num_rows;
           
            $aResult = array();
           
            for ($i = 0; $i < $nRows; $i++)
            {
                $aRow = $qryResult->fetch_array(MYSQLI_NUM);
               
                //Put your code here!
                $aResult[$aRow[0]] = $aRow[1];
               
                //Debugging: to help fugure this out what an aRow look like
                //print "<pre>";
                //print_r ($aRow);
                //print "</pre>\n";
               
            }
           
            return $aResult;
           
        }
        
        /********
         *Function findPrimaryKey
         *Purpose Find the name of the primary key field from a given query
         *Params qryResult: the query result set to find the primary key in
         *  Returns: the name of the primary key field. If the key is a
         *  composite, return the first one found
         ********/
        function findPrimaryKey($qryResults)
        {
            $retVal = FALSE;
            
            //get the fields from the query
            $aFields = $qryResults->fetch_fields();
            
            //loop all fields
            foreach($aFields as $obFieldInfo)
            {
                if($obFieldInfo->flags & MYSQLI_PRI_KEY_FLAG)
                {
                    $retVal = $obFieldInfo->orgname;
                    
                    break;
                }
                
            }
            
            return $retVal;
            
        }
        
        
        
        /********************************************
             *Destructor:
             *Purpose: To close the MySQL Connection
             *******************************************/
            function __destruct()
            {
              //  $this->dbConnect->close();
            }
        
        
       
        
        
        
    }//end class dbObject
?>