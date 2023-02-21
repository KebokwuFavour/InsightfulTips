<?php
$servername = "localhost";
$username = "username";
$password = "";

// Create connection
$connect_db = mysqli_connect($servername, $username, $password);
// Check connection
if (!$connect_db) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS HEPInsights";
if (mysqli_query($connect_db, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($connect_db);
}

$servername = "localhost";
$username = "username";
$password = "";
$dbname = "HEPInsights";

// Create connection
$connect_db = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$connect_db) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql1 to create table
$sql1 = "CREATE TABLE IF NOT EXISTS admin_panel (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL
)";

if (mysqli_query($connect_db, $sql1)) {
  echo "Table admin_panel created successfully";
} else {
  echo "Error creating table: " . mysqli_error($connect_db);
}


// sqla to insert into table
$sqla = "INSERT INTO admin_panel (name, password) VALUES
('Admin.', 'Kebokwu@2023')";

if (mysqli_query($connect_db, $sqla)) {
  echo "New Record created successfully";
} else {
  echo "Error: " . $sqla . "<br>" . mysqli_error($connect_db);
}


// sql to create table
$sql2 = "CREATE TABLE IF NOT EXISTS affiliate_marketing (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  product_link VARCHAR(250) NOT NULL,
  product_image VARCHAR(250) NOT NULL,
  product_title VARCHAR(250) NOT NULL,
  price VARCHAR(250) NOT NULL
)";

if (mysqli_query($connect_db, $sql2)) {
  echo "Table affiliate_marketing created successfully";
} else {
  echo "Error creating table: " . mysqli_error($connect_db);
}


// sql to create table
$sql3 = "CREATE TABLE IF NOT EXISTS author (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  names VARCHAR(250) NOT NULL,
  name_link VARCHAR(500) NOT NULL,
  image VARCHAR(250) NOT NULL,
  short_detail VARCHAR(500) NOT NULL,
  mission VARCHAR(1000) NOT NULL,
  mission_img VARCHAR(250) NOT NULL
)";

if (mysqli_query($connect_db, $sql3)) {
  echo "Table author created successfully";
} else {
  echo "Error creating table: " . mysqli_error($connect_db);
}


// sql to create table
$sql4 = "CREATE TABLE IF NOT EXISTS blog_comments (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(250) NOT NULL,
  email VARCHAR(250) NOT NULL,
  website VARCHAR(250) NOT NULL,
  comments VARCHAR(500) NOT NULL,
  blog_id INT(6) NOT NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($connect_db, $sql4)) {
  echo "Table blog_comments created successfully";
} else {
  echo "Error creating table: " . mysqli_error($connect_db);
}


// sql to create table
$sql5 = "CREATE TABLE IF NOT EXISTS comments_reply (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  names VARCHAR(250) NOT NULL,
  emails VARCHAR(250) NOT NULL,
  messages VARCHAR(500) NOT NULL,
  comment_id INT(6) NOT NULL,
  dates TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($connect_db, $sql5)) {
  echo "Table comments_reply created successfully";
} else {
  echo "Error creating table: " . mysqli_error($connect_db);
}


// sql to create table
$sql6 = "CREATE TABLE IF NOT EXISTS comments_reply_reply (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(250) NOT NULL,
  email VARCHAR(250) NOT NULL,
  message VARCHAR(500) NOT NULL,
  comments_reply_id INT(6) NOT NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($connect_db, $sql6)) {
  echo "Table comments_reply_reply created successfully";
} else {
  echo "Error creating table: " . mysqli_error($connect_db);
}


// sql to create table
$sql7 = "CREATE TABLE IF NOT EXISTS contact (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  sender_name VARCHAR(250) NOT NULL,
  sender_email VARCHAR(250) NOT NULL,
  sender_phone VARCHAR(250) NOT NULL,
  reason_for_contacting VARCHAR(250) NOT NULL,
  sender_message VARCHAR(1000) NOT NULL,
  time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($connect_db, $sql7)) {
  echo "Table contact created successfully";
} else {
  echo "Error creating table: " . mysqli_error($connect_db);
}



// sql to create table
$sql8 = "CREATE TABLE IF NOT EXISTS displaying_insights (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  post_category VARCHAR(250) NOT NULL,
  tags VARCHAR(250) NOT NULL,
  post_title VARCHAR(250) NOT NULL,
  post_image VARCHAR(250) NOT NULL,
  post_details VARCHAR(10000) NOT NULL,
  author VARCHAR(250) NOT NULL,
  author_image VARCHAR(250) NOT NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($connect_db, $sql8)) {
  echo "Table displaying_insights created successfully";
} else {
  echo "Error creating table: " . mysqli_error($connect_db);
}



// sql to create table
$sql9 = "CREATE TABLE IF NOT EXISTS socials (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  social_handles VARCHAR(500) NOT NULL,
  social_links VARCHAR(1000) NOT NULL
)";

if (mysqli_query($connect_db, $sql9)) {
  echo "Table socials created successfully";
} else {
  echo "Error creating table: " . mysqli_error($connect_db);
}


// sql to insert into table
$sqlb = "INSERT INTO socials (social_handles, social_links) VALUES
('facebook', 'https://facebook.com/#'),
('instagram', 'https://instagram.com/#'),
('twitter', 'https://twitter.com/#'),
('whatsapp', 'https://whatsapp.com/#'),
('youtube', 'https://www.youtube.com/channel/UCx9qVW8VF0LmTi4OF2F8YdA')";

if (mysqli_query($connect_db, $sqlb)) {
  echo "New Record created successfully";
} else {
  echo "Error: " . $sqlb . "<br>" . mysqli_error($connect_db);
}



// sql to create table
$sql10 = "CREATE TABLE IF NOT EXISTS subscribers (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  emails VARCHAR(250) NOT NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($connect_db, $sql10)) {
  echo "Table subscribers created successfully";
} else {
  echo "Error creating table: " . mysqli_error($connect_db);
}


//mysqli_close($connect_db);

// $connect_db = mysqli_connect("localhost", "root");
// if (!$connect_db) {
//   echo "Failed to connect to Server";
// }
// mysqli_select_db($connect_db, "HEPInsights");
