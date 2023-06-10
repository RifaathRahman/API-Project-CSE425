<?php

// Establish a database connection
$host = "localhost";
$username = "root";
$password = "";
$dbName = "pigeon_db";

$connection = new mysqli($host, $username, $password, $dbName);

if ($connection->connect_error) {
    die('Database connection failed: ' . $connection->connect_error);
}

// Step 2: Handle the incoming API request
$data = $_POST; // Assuming the API request sends data via POST

// Step 3: Validate and sanitize the input data
// ... Perform validation and sanitization as per your requirements ...

// Step 4: Prepare the SQL query
$sql = "INSERT INTO users (userid,first_name,last_name,email) VALUES (?, ?, ?,?)";

$stmt = $connection->prepare($sql);
$stmt->bind_param('ssss', $data['value1'], $data['value2'], $data['value3'],$data['value4']);

// Step 5: Execute the SQL query
$result = $stmt->execute();

// Step 6: Handle the query result
if ($result) {
    // Insertion successful
    $insertedId = $stmt->insert_id;
    // ... Perform any additional actions or return a success response ...
} else {
    // Insertion failed
    $error = $stmt->error;
    // ... Handle the error or return an error response ...
}

$stmt->close();
$connection->close();



$pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);

// Create a new post
function createPost($userId, $post, $image, $comments)
{
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO posts (userid, post, image, comments) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, $post, $image, $comments]);

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

// Get all posts
function getAllPosts()
{
    global $pdo;

    $stmt = $pdo->query("SELECT * FROM posts");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get a specific post by ID
function getPostById($postId)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$postId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Create a new user
function createUser($userId, $firstName, $lastName, $gender, $email, $password, $urlAddress, $date, $profileImage, $coverImage)
{
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO users (userid, first_name, last_name, gender, email, password, url_address, date, profile_image, cover_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$userId, $firstName, $lastName, $gender, $email, $password, $urlAddress, $date, $profileImage, $coverImage]);

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

// Get user by ID
function getUserById($userId)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE userid = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Usage examples:

// Create a new post

?>