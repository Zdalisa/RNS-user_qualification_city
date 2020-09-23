<?php
// Обновление списка пользователей
//
// вход:
//		$_POST['qualification']		- Фильтр "Образование" 
//		$_POST['city']			- Фильтр "Город" 
//
// выход:
//	(view = нет)

// подгрузить необходимые классы
include_once "{$path_model}/user_list_main_table.php";

// проверка на иниц. данных
$post_qualification = ( isset($_POST['qualification']) ) ? $_POST['qualification'] : false;
$post_city = ( isset($_POST['city']) ) ? $_POST['city'] : false;

// класс списка пользователей
$user_list = new UserListMainTable();

// Фильтр "Образование" 
if ( $post_qualification ) {
	
	$user_list->setWhereQualificationId($post_qualification);
}

// Фильтр "Город" 
if ( $post_city ) {

	$user_list->setWhereCityId($post_city);
}
	
$user_list->loadDataFromDB();

$users = array();
$f=0;
foreach($user_list->getList() as $value) {
	$users[$f]['user'] = $value['user']->getName();
	$users[$f]['qualification'] = $value['qualification']->getName();
	$users[$f]['user_cities'] = ($value['user_cities']) ? $value['user_cities'] : '';
	$f++;
}
// отдаем "все ок" и данные
header('Content-type: text/plain; charset=utf-8');
header('Cache-Control: no-cache');
echo json_encode($users);