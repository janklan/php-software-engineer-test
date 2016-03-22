# Install #

## Usage with Docker

1. If you have docker and docker-composer environment ready, just fire `docker-compose up` and everything will be ready in no time at your docker-machine's address

## Usage without Docker

1. In all other cases just take contents of the `/code` directory and put it in existing (and working) PHP 5.5+ directory 

## MySQL

1. Make sure you have correct credentials set in `question_1.php`
2. Make sure you have either imported the default SQL structure located in `README.md` or you did import the Suggested MySQL tables structure

### Suggested MySQL tables structure

Following schema definition introduces certain performance and robstuness fixes to the default task structure. Both structures are compatible, but this one will
 
1. allow faster occupation lookup,
2. prevent errors in case of special characters in the first and last name,
3. make sure there are no broken relations between customers and occupations in case of changes in the occupations table
4. be more efficient when storing integers, which will never ever be negative, thus unsigned data columns make sense 

I would also suggest to remove the NULL proerty from customer.customer_occupation_id for performance reasons, but I think I already exceeded the scope of the testing tast :-)

```mysql
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `customer_occupation_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `username` (`username`),
  KEY `customer_occupation_id` (`customer_occupation_id`),
  CONSTRAINT `customer_occupation` FOREIGN KEY (`customer_occupation_id`) REFERENCES `customer_occupation` (`customer_occupation_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;

INSERT INTO `customer` (`customer_id`, `username`, `first_name`, `last_name`, `customer_occupation_id`)
VALUES
	(1,'B001','John','Manager',1),
	(2,'B002','John','Worker',2);

/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customer_occupation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_occupation`;

CREATE TABLE `customer_occupation` (
  `customer_occupation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `occupation_name` varchar(255) NOT NULL DEFAULT '',
  `salary` int(6) unsigned NOT NULL,
  PRIMARY KEY (`customer_occupation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `customer_occupation` WRITE;
/*!40000 ALTER TABLE `customer_occupation` DISABLE KEYS */;

INSERT INTO `customer_occupation` (`customer_occupation_id`, `occupation_name`, `salary`)
VALUES
	(1,'Manager',100),
	(2,'Worker',50);

/*!40000 ALTER TABLE `customer_occupation` ENABLE KEYS */;
UNLOCK TABLES;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

```

## Contact

In case of questions feel free to get in touch via jan@beatee.org.