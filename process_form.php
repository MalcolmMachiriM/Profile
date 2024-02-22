<?php
// Database connection parameters
$host = 'your_database_host';
$port = 'your_database_port';
$database = 'MaliProfile';
$user = '';
$password = '';

// Form data received via AJAX
$formData = json_decode(file_get_contents('php://input'), true);

// Extract form fields
$name = $formData['name'];
$email = $formData['email'];
$message = $formData['message'];

// Connect to PostgreSQL database
$db_connection = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

// Check if the connection was successful
if (!$db_connection) {
    die("Connection failed");
}

// Prepare the SQL statement to insert data into a table
$sql = "INSERT INTO your_table_name (name, email, message) VALUES ($1, $2, $3)";

// Execute the SQL statement with parameters
$result = pg_query_params($db_connection, $sql, array($name, $email, $message));

// Check if the query was successful
if ($result) {
    // Return a success message
    echo json_encode(array('success' => true));
} else {
    // Return an error message
    echo json_encode(array('error' => 'Database error'));
}

// Close the database connection
pg_close($db_connection);
?>
