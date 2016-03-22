<?php

/**
 * Here would normally be a copyright and license.
 */

namespace SoftwareEngineerTest;

require 'db.php';

try {

    // Fetch the database connection instance
    $sql = Database::get_instance();

	// select all the customers
	$query = "
		SELECT
			cus.customer_id,
			cus.first_name,
			cus.last_name,
			cusocc.occupation_name
		FROM
			customer AS cus
			LEFT JOIN customer_occupation AS cusocc
			    ON cus.customer_occupation_id = cusocc.customer_occupation_id
	";

	// If the occupation_name variable is defined, we want only specific occupations
	if (isset($_GET['occupation_name']) && !empty(trim($_GET['occupation_name']))) {

		// Cut off possible malicious string values
		$occupation_name = substr($_GET['occupation_name'], 0, 255);
		$query .= "
			WHERE
				cus.customer_occupation_id IS NOT NULL
					AND
				cusocc.occupation_name = '{$sql->real_escape_string($occupation_name)}'
		";

		/**
		 * Disclaimer: prepared statements could be do this to ensure relatively safer input filtering of the
		 *  $occupation_name variable, but the costs of creating a prepared statement, binding a parameter and
		 *  then executing just one query seems to be a bit too overhead.
		 *
		 * Not that it would not be possible, but I would personally not do it in the scenarion at hand.
		 */
	}

	$result = $sql->query($query);

} catch(\mysqli_sql_exception $e) {
	die($e->getMessage());
}

echo '<h2>Customer List</h2>';

// If there are no people found, display error
if ($result->num_rows === 0) {
	echo '<p>No customers found.</p>';

// Else list them in a table
} else {
	echo '<table>'
		.	'<thead>'
		.		'<tr>'
		. 			'<th>Customer ID</th>'
		. 			'<th>First Name</th>'
		. 			'<th>Last Name</th>'
		. 			'<th>Occupation</th>'
		.		'</tr>'
		. 	'</thead>'
		. 	'<tbody>';

		while ($data = $result->fetch_object()) {

			// htmlspecialchars() used because of raw output, data gathered from everybody must be considered villain
			echo '<tr>'
				. 	'<td>' . $data->customer_id . '</td>'
				. 	'<td>' . htmlspecialchars($data->first_name) . '</td>'
				. 	'<td>' . htmlspecialchars($data->last_name) . '</td>'
				. 	'<td>' . (null === $data->occupation_name ? 'un-employed' : htmlspecialchars($data->occupation_name)) . '</td>'
				. '</tr>';
		}

	echo 	'<tbody>'
		.'</table>';

}

echo '<hr>';

show_source(__FILE__);
