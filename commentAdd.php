<?php
    require_once './config.php';

    $connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
    if ($connection->connect_error) {
        die($connection->connect_error);
    }
    
    if($_POST[parent_id]) { 
        $parent_id = preg_replace('/\D+/i','', $_POST[parent_id]);
    }
    else{
        $parent_id = 0;
    }  
    if($_POST[userName]){
        $author = clearString($_POST[userName]);
    }
    if($_POST[userEmail]){
        $email = clearString($_POST[userEmail]);
    }
    if($_POST[userHost]){
        $host = clearString($_POST[uesrHost]);
    }
    if($_POST[text]){
        $comment = clearString($_POST[text]);
    }
    
    $query = "INSERT INTO comments (idParent, userName, userEmail, userHost, text, date_add) "
                 . "VALUES ('$parent_id', '$author', '$email', '$host', '$comment', NOW())";
    $result = $connection->query($query);
    if (!$result) {
        die($connection->error);
    }
    $result->close();
    $connection->close();
    
    function clearString($str){
        if(get_magic_quotes_gpc()) $str = stripslashes ($str);
        $var = stripcslashes($var);
        $var = strip_tags($var);
        return $str;
    }
?>