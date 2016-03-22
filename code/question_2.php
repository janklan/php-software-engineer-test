<?php
namespace SoftwareEngineerTest;

// Question 2 & 3 & 4

/**
 * Class Customer
 * @package SoftwareEngineerTest
 */
/**
 * Class Customer
 * @package SoftwareEngineerTest
 */
abstract class Customer {

    /**
     * Bronze level identifier (Customer ID must begin with this letter to indicate a bronze level)
     */
    const LEVEL_BRONZE  = 'B';

    /**
     * Silver level identifier (Customer ID must begin with this letter to indicate a silver level)
     */
    const LEVEL_SILVER  = 'S';

    /**
     * Gold level identifier (Customer ID must begin with this letter to indicate a gold level)
     */
    const LEVEL_GOLD    = 'G';

    /**
     * List of known customer levels and their respective user classes
     * @var array
     */
    private static $allowedLevels = array(
        self::LEVEL_BRONZE  => '\SoftwareEngineerTest\Bronze_Customer',
        self::LEVEL_SILVER  => '\SoftwareEngineerTest\Silver_Customer',
        self::LEVEL_GOLD    => '\SoftwareEngineerTest\Gold_Customer',
    );

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
     * Factory method returns the correct customer instance based on the ID specified.
     *
     * @see $allowedLevels
     * @param $id ID in format [A-Z]\d{,9}
     * @return Descendants of the Customer class
     * @throws \InvalidArgumentException
     */
    public static function get_instance($id) {

        // The first character of the ID should be one of our customer levels
        $customerLevel = strtoupper($id[0]);

        if (isset(self::$allowedLevels[$customerLevel])) {
            $customerId = (int)preg_replace('/[^\d]/', '', $id);
            // Spec says ID and number has maxlength(10), so the (int)$id must be <= 999 999 999
            //  and > 0, as 0 would mean invalid ID specified
            if ($customerId > 0 && $customerId <= 999999999) {
                return new self::$allowedLevels[$customerLevel]($customerId);
            } else {
                throw new \InvalidArgumentException('Invalid customer ID specified.');
            }
        } else {
            throw new \InvalidArgumentException('Invalid customer level specified.');
        }
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
echo Customer::get_instance('G1')->deposit(100)->get_balance();
echo '<br>';

echo Customer::get_instance('S2')->deposit(100)->get_balance();
echo '<br>';

echo Customer::get_instance('B3')->deposit(100)->get_balance();
echo '<br>';
