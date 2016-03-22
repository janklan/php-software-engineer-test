<?php

namespace SoftwareEngineerTest;

/**
 * Class Database
 * @package SoftwareEngineerTest
 */
final class Database
{
    /**
     * @var string Mysql server
     */
    private static $host   = '192.168.59.128';
    /**
     * @var string Mysql db name
     */
    private static $db     = 'test';
    /**
     * @var string Mysql user name
     */
    private static $user   = 'test';
    /**
     * @var string Mysql password
     */
    private static $pass   = 'test';

    /**
     * @var \mysqli Database connection instance
     */
    private static $instance;

    /**
     * Creates database connection when called the first time. Returns the existing connection everytime.
     * @return \mysqli
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            // Make sure mysqli throws exceptions and not warning
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            // Open the connection
            self::$instance = new \mysqli(self::$host, self::$user, self::$pass, self::$db);
            // Make sure charset is right (can be moved to my.cnf and removed from the runtime)
            self::$instance->query("SET NAMES utf8");
        }

        return self::$instance;
    }

    /**
     * Database constructor. Should not be called, this is a singleton pattern class.
     *
     * @see getInstance()
     */
    public function __construct()
    {
        throw new \RuntimeException('This is a singleton class. Call \SoftwareEngineerTest\Database::getInstance() instead.');
    }
}