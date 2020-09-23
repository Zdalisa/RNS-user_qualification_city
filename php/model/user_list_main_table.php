<?php
/*
 * Список пользователей
 *
 */
// подгрузить необходимые классы
include_once "{$path_model}/common/ticket_list.php";
include_once "{$path_model}/user_list.php";
include_once "{$path_model}/qualification.php";
include_once "{$path_model}/user.php";
include_once "{$path_model}/user_cities_list_main_table.php";

// описание класса
class UserListMainTable extends UserList {

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// конструктор
	public function __construct() {

		$this->join_tickets_qualificationid_qualification = true;
	}

	// загрузка данных из БД
	public function loadDataFromDB() {

		// сформировать SQL-запрос (без полей)
		$this->makeSql();

		$f = 0;
		$this->list = array();
		$sql = '
			SELECT
				t1.`id` 		AS ROW_0,
				t1.`name` 		AS ROW_1,
				t2.`name`		AS ROW_2
			'. $this->getSql();
		;
		$res = mysqlQuery($sql);
		while( $row = mysqlFetchArray($res) ) {
			$this->list[$f]  = array(
				'user' => new User(),				// пользователь
				'qualification' => new Qualification(),		// образование
			);

			$this->list[$f]['user']
				->setId( $row[0] )
				->setName( $row[1] )
			;

			$this->list[$f]['qualification']
				->setName( $row[2] )
			;

			$city_list = new UserCitiesListMainTable();
			$city_list	
				->setWhereUserId( $row[0] )
				->loadDataFromDB();

			// список городов
			$this->list[$f]['user_cities'] = $city_list->getListToString();
			
			// наростить счётчик цикла
			$f++;
		}
		return $res;
	}
}

