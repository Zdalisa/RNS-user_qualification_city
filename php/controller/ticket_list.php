<?php
// "Список пользователей" (формирование страницы)
// выход:
//	(view = ticket_list.php)
//	city_list		- список городов			(class CityList)
//	qualification_list	- список образования			(class QualificationList)
//	user_list		- список пользователей			(class UserListMainTable)

// подгрузить необходимые классы
include_once "{$path_model}/city_list.php";
include_once "{$path_model}/qualification_list.php";
include_once "{$path_model}/user_list_main_table.php";

$view_main_title = 'Список пользователей';

// проверка прав доступа
if( true ) {

	// список городов
	$city_list = new CityList();
	$city_list->loadDataFromDB();

	// список образования
	$qualification_list = new QualificationList();
	$qualification_list->loadDataFromDB();

	// список пользователей
	$user_list = new UserListMainTable();
	$user_list->loadDataFromDB();

	// передача управления VIEW
	include("{$path_view}/ticket_list.php");
}
?>
