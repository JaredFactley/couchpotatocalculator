<?php

class dropdown 
{
	public $indexType, $listHTML;

	public function __construct()
	{
		$this->listHTML = "<option value=\"{$this->indexType}\">{$this->indexType}</option>";
	}
}

?>