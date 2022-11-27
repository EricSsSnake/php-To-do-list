<?php
$conn = new mysqli('localhost', 'eric', 1234, 'todolist');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
