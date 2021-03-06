<?php
/*
 * Список "Города пользователей"
 *
 */
// подгрузить необходимые классы
include_once "{$path_model}/common/ticket_list.php";

// описание класса
class UserCitiesList extends TicketList {

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// свойства

	// Условия выборки
	private	$sql_where = null;				// Итоговые условия для SQL-запроса			(str)
	private $where_user_id		= null;			// Фильтр "ID пользователя" 				(int)		
	
	// Присоединение таблиц
	private	$sql_join = '';					// Итоговые присоединения таблиц для SQL-запроса	(str)
	protected $join_tickets_cityid_city = false;		// Присоединить `city` к `ticket`.`city_id` - Город	(bool)


	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// методы изменения данных

	// Фильтр "ID пользователя"
	public function setWhereUserId($value) {
		$this->where_user_id = $value;
		return $this;
	}

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// сформировать итоговые условия для SQL-запроса
	private function makeSqlWhere() {

		// очистить переменные
		$this->sql_where = " TRUE ";

		// Фильтр "ID пользователя"
		if( $this->where_user_id ) {
			$this->sql_where .= ' AND t1.`user_id` = \''. $this->where_user_id .'\' ';
		}
		
		return $this->sql_where;
	}


	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// сформировать итоговые присоединения таблиц для SQL-запроса
	private function makeSqlJoin() {

		// очистить переменные
		$this->sql_join = '';

		// Присоединить `city` к `ticket`.`city_id` - Город
		if( $this->join_tickets_cityid_city ) {
			$this->sql_join .= ' LEFT JOIN `city` t2 ON t2.`id` = t1.`city_id`';
		}
	}

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// сформировать SQL-запрос (без полей)
	protected function makeSql() {

		// сформировать итоговые условия для SQL-запроса
		$this->makeSqlWhere();

		// сформировать итоговые присоединения таблиц для SQL-запроса
		$this->makeSqlJoin();
	}

	// получить SQL-запрос (без полей)
	protected function getSql() {

		return ' 	FROM 		`user_cities` 	AS t1 
			'. $this->sql_join .'
			WHERE '. $this->sql_where;
	}
}

