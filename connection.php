<?php
// Database configuration
$host = 'localhost';    
$user = 'root';         
$pass = '';             
$dbname = 'blog_web';       
// Create connection
$con = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "";
}
?>