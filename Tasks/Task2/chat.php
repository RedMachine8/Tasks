<?php

function connectionDB($login, $password){
    $servername = "localhost";
    $dbname = "myDB";
    $conn = new mysqli($servername, $login, $password, $dbname);
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }
    return $conn;
}
function load($db) {
    $echo = "";
    $result = mysqli_query($db,"SELECT * FROM msg"); //Запрашиваем сообщения из базы
    if($result) {
        if(mysqli_num_rows($result) >= 1) {
            while ($array = mysqli_fetch_array($result)) {
                    $echo .= "<div class='chat__message'><b>$array[user_name]</b> $array[message]</div>";
            }
        }
    } else {
        $echo = "Нет сообщений!";
    }
    return $echo;
}

function send($db,$message, $FIO) {
    $id = rand(1, 1000000);
    $result = mysqli_query($db,"INSERT INTO msg (msg_id, msg_text, user_name) VALUES ('$id','$message', '$FIO')");
    return load($db);
}

$db = connectionDB("root", "12345678");
if(isset($_POST['act'])) {$act = $_POST['act'];}
if(isset($_POST['var1'])) {$var1 = $_POST['var1'];}
if(isset($_POST['var2'])) {$var2 = $_POST['var2'];}

switch($_POST['act']) {
    case 'load':
        $echo = load($db);
        break;

    case 'send':
        if(isset($var1) and isset($var2)) {
            $echo = send($db,$var1, $var2);
        }
        break;
}

echo $echo;
?>
