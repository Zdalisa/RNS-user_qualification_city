<?php
/*
 * Список "Города пользователей"
 *
 */
include_once "{$path_model}/model2/user_cities_list.php";

class UserCitiesListMainTable extends UserCitiesList {


	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// свойства

	// список в виде строки
	private $list_to_string = '0';
	
	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// методы получения данных

	// список в виде строки
	public function getListToString() {
		return $this->list_to_string;
	}

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// конструктор
	public function __construct() {

		$this->join_tickets_cityid_city = true;
	}

	// загрузка данных из БД с применением фильтров
	public function loadDataFromDB() {
		
		// очистка переменной
		$list_to_string = '';

		// сформировать SQL-запрос (без полей)
		$this->makeSql();

		$this->list = array();

		$sql = 'SELECT 
				t2.`name`	AS ROW_0
				'. $this->getSql();
		$res = mysqlQuery($sql);
		while( $row = mysqlFetchArray($res) ) {

			$list_to_string .= ', '. $row[0];
		}

		$this->list_to_string = strstr($list_to_string, ' ');
		return $res;
	}


}