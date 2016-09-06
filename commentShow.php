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

/* Функция создания дерева комментариев из массива $data */
function mapTree($dataset){
	$tree = array();
        /*
         * Проходим в цикле по массиву $dataset,
         * в $id будет попадать уникальный id комментария
         */
	foreach ($dataset as $id=>&$node) {    
		if (!$node['idParent']) { //если корневой элемент
                    $tree[$id] = &$node;
		}else{ 
                    /*
                     * Иначе это чей-то потомок, 
                     * этого потомка переносим в родительский элемент,
                     * и создаем у родителя массив childs, в котором и будут вложены его потомки
                     */

                    $dataset[$node['idParent']]['childs'][$id] = &$node; //
		}
	}
	return $tree;
}
function commentsToTemplate($comment){
    /* 
     * $comment - массив комментария - имя, дата, коммент, потомки 
     * включаем буферизацию вывода, чтобы шаблон не вывелся в месте вызова функции (ob_start)
     */
    ob_start();  
    include './templateForm.php';   
    //возвращем значения буфера и очищаем его
    return ob_get_clean();
} 
//Функция для перевода всех комментариев в единую HTML-строку */
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