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
}

// Write your code below

/**
 * Class DepositableBalanceTrait
 *
 * Adding this functionality into the abstract class makes much more sense, but but the instruciton says "Write your
 *  code below" so I did not want to interfere with the original abstract class.
 *
 * Adding a trait makes a bit more sense than adding second abstract class in this case.
 *
 * @package SoftwareEngineerTest
 */
trait DepositableBalanceTrait {

	/**
	 * @param $amount
	 * @return $this
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
		// If the $bonusCoeficient is not set, return to make no change to the deposited amount
		return isset($this->bonusCoeficient) ? $this->bonusCoeficient : 1;
	}
}

/**
 * Class Bronze_Customer
 * @package SoftwareEngineerTest
 */
class Bronze_Customer extends Customer {
	use DepositableBalanceTrait;

	/**
	 * Coeficient added the current user level deposits
	 * @var int
     */
	protected $bonusCoeficient = 1;
}

/**
 * Class Silver_Customer
 * @package SoftwareEngineerTest
 */
class Silver_Customer extends Customer {
	use DepositableBalanceTrait;

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
	use DepositableBalanceTrait;

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
