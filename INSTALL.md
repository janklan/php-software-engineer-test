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
CREATE TABLE `customer_occupation` (
  `customer_occupation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `occupation_name` varchar(255) NOT NULL DEFAULT '',
  `salary` int(6) unsigned NOT NULL,
  PRIMARY KEY (`customer_occupation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
```

## Contact

In case of questions feel free to get in touch via jan@beatee.org.