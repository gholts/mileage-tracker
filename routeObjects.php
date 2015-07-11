<?php

class route
{
	public $routeName;
	public $description;
	public $routeID;
	
	public function __construct($eName, $edescription, $eID)
	{
		
		$this->description = $edescription;
		
		$this->routeName = $eName;
		
		$this->routeID = $eID;
	}
	
}
?>