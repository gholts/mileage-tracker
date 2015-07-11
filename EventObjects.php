<?php

class Event
{
	public $ndate;
	public $eventName;
	public $description;
	public $routeDescription;
	public $routeID;
	
	public function __construct($eDate, $eName, $edescription, $routeDescription=false,$routeID=false)
	{
		$this->ndate = $eDate;
		
		$this->description = $edescription;
		
		$this->eventName = $eName;
		
		$this->routeDescription = $routeDescription;
		
		$this->routeID = $routeID;
	}
	public function getDate()
	{
		return $this->ndate;
	}
	public function getEventName()
	{
		return "$this->eventName";
	}
	public function getDescription()
	{
		return "$this->eventName";
	}
	public function getRouteDescription()
	{
		return "$this->routeDescription";
	}
	
}
?>