<?php

namespace SoftwareEngineerTest;

final class Database
{
    private static $host   = '192.168.59.128';
    private static $db     = 'test';
    private static $user   = 'test';
    private static $pass   = 'test';

    private static $instance;

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

    private function __construct()
    {
        throw new \RuntimeException('This is a singleton class. Call \SoftwareEngineerTest\Database::getInstance() instead.');
    }
}