<?php
namespace SoftwareEngineerTest;

// Question 2 & 3 & 4

/**
 * Class Customer
 * @package SoftwareEngineerTest
 */
abstract class Customer {

	/**
	 * @var int Customer ID
     */
	protected $id;

	/**
	 * @var int Current balance
     */
	protected $balance = 0;

    /**
     * @var float Coeficient added the current user level deposits
     */
    protected $bonusCoeficient = 1.0;

	/**
	 * Customer constructor.
	 * @param $id
     */
	public function __construct($id) {
		$this->id = $id;
	}

	/**
	 * Returns the current balance
	 * @return int
     */
	public function get_balance() {
		return $this->balance;
	}

    /**
     * Adds specified $amount to the {@see balance}
     * @param $amount
     * @return Customer
     */
    public function deposit($amount) {
        $this->balance += (float)$amount * $this->getBonusCoeficient();
        return $this;
    }

    /**
     * Returns current bonus coeficient.
     *
     * If none is set, returns "1".
     *
     * @return int
     */
    protected function getBonusCoeficient()
    {
        return $this->bonusCoeficient;
    }
}

/**
 * Class Bronze_Customer
 * @package SoftwareEngineerTest
 */
class Bronze_Customer extends Customer {
    // Void
}

/**
 * Class Silver_Customer
 * @package SoftwareEngineerTest
 */
class Silver_Customer extends Customer {
	/**
	 * Coeficient added the current user level deposits
	 * @var float
     */
	protected $bonusCoeficient = 1.05;
}

/**
 * Class Gold_Customer
 * @package SoftwareEngineerTest
 */
class Gold_Customer extends Customer {
	/**
	 * Coeficient added the current user level deposits
	 * @var float
     */
	protected $bonusCoeficient = 1.1;
}

$gc = new Gold_Customer(1);
echo $gc->deposit(100)->get_balance();
echo '<br>';

$gc = new Silver_Customer(2);
echo $gc->deposit(100)->get_balance();
echo '<br>';

$gc = new Bronze_Customer(3);
echo $gc->deposit(100)->get_balance();
echo '<br>';
