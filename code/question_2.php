<?php
namespace SoftwareEngineerTest;

// Question 2 & 3 & 4

/**
 * Class Customer
 */
abstract class Customer {
	protected $id;
	protected $balance = 0;

	public function __construct($id) {
		$this->id = $id;
	}

	public function get_balance() {
		return $this->balance;
	}
}


// Write your code below
