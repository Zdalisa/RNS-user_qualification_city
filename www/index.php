<?php
/*
 * Главный скрипт
 */

// путь к корню сайта
$path_root = dirname(__DIR__);

// подключение глобальных настроек сервера
require_once $path_root.'/php/config/system.php';

// do - главная переменная, указывает на действия в контроллере
$do = '';
if( isset($_POST['do']) ) {
	$do = $_POST['do'];
}
if( isset($_GET['do']) ) {
	$do = $_GET['do'];
}

// открытие соединения с БД
$mysql_ind = mysql_connect( $mysql_host, $mysql_user, $mysql_password );

// проверка соединения
if( $mysql_ind == false ) {
	// если нету соединения, то остановка
	include("{$path_view}/login/error_connecttoserver.php");
	return;
}

// соединение с БД
$res = mysql_select_db( $mysql_base, $mysql_ind );

// проверка соедниенения с БД
if( $res==false ) {
	// если нету соединения, то остановка
	include("{$path_view}/login/error_connecttoserver.php");
	return;
}

// установка кодировки
mysqlQuery('set names utf8');

mysql_close( $mysql_ind );

//--------------------------------------------------------------------------------------------------------------------------------------------------------------
// общие функции работы с БД
//--------------------------------------------------------------------------------------------------------------------------------------------------------------

// вернуть первую строку ответа по SQL запросу
function mysqlGetValues( $sql ) {

	$res = mysql_query( $sql, $GLOBALS['mysql_ind'] );
	if( $res == false ) {
		return false;
	} else {
		return mysql_fetch_array( $res, MYSQL_NUM );
	}
}

// выполнить SQL запрос и веруть идентификатор ответа
function mysqlQuery( $sql ) {

	return mysql_query( $sql, $GLOBALS['mysql_ind'] );
}

// выбрать следующую строку по идентификатору ответа
function mysqlFetchArray( $res ) {

	return mysql_fetch_array( $res, MYSQL_NUM );
}

// получить id последней записи
function mysqlGetInsertId() {

	return mysql_insert_id( $GLOBALS['mysql_ind'] );
}

