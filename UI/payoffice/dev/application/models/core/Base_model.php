<?php
/**
* Class:  Base Model for Services 
* Author: Eranga
* Date:   14/10/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends CI_Model
{
	public function get_current_datetime()
	{
		$now = new DateTime();
		return $now->format('Y-m-d H:i:s');
	}

	public function get_current_username()
	{
		return $_SESSION['username'];
	}
}