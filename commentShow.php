<?php
require_once './config.php';

$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection->connect_error) {
    die($connection->connect_error);
}
$query = "SELECT id, idParent, userName, userEmail, userHost, text, DATE_FORMAT(date_add, '%d %M %Y %H:%i') as date_add
        FROM comments";
$result = $connection->query($query);
if (!$result) {
    die($connection->error);
}

while($row = $result->fetch_assoc()){
    $data[$row[id]] = $row; 
}

/* Функция создания дерева комментариев из массива */
function mapTree($dataset){
	$tree = array();
	foreach ($dataset as $id=>&$node) {    
		if (!$node['idParent']) {
                    $tree[$id] = &$node;
		}else{ 
                    $dataset[$node['idParent']]['childs'][$id] = &$node; //
		}
	}
	return $tree;
}
function commentsToTemplate($comment){
    ob_start();  
    include './templateForm.php';   
    return ob_get_clean();
} 

 function commentsString($data){
    foreach($data as $w) {
        $string .= commentsToTemplate($w);
        }
        return $string; 
     }
$data = mapTree($data);
$comments = commentsString($data);
$data = null;
$result->close();
$connection->close();
?>
