<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "sys";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$sql = "CREATE TABLE msg (
msg_id INT(6) NOT NULL PRIMARY KEY,
msg_text VARCHAR(30) NOT NULL,
user_name VARCHAR(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Таблица msg создана успешно";
} else {
    echo "Ошибка создания таблицы: " . $conn->error;
}
$conn->close();
?>