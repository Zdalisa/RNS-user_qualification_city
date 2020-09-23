<?php
/*
 * Список пользователей
 *
 */
// подгрузить необходимые классы
include_once "{$path_model}/common/ticket_list.php";

// описание класса
class UserList extends TicketList {

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// свойства

	// Условия выборки
	private	$sql_where = null;					// Итоговые условия для SQL-запроса			(str)
	private $where_qualification_id		= array();		// Фильтр "ID образования" 				(int)
	private $where_city_id			= array();		// Фильтр "ID Города" 					(int)

	// Присоединение таблиц
	private	$sql_join = '';						// Итоговые присоединения таблиц для SQL-запроса					(str)
	protected $join_tickets_qualificationid_qualification = false;	// Присоединить `qualification` к `ticket`.`qualification_id` - Образование		(bool)

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// методы изменения данных

	// Фильтр "ID образования" 
	public function setWhereQualificationId($value) {
		$this->where_qualification_id = $value;
		return $this;
	}
	// Фильтр "ID Города"
	public function setWhereCityId($value) {
		$this->where_city_id = $value;
		return $this;
	}

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// сформировать итоговые условия для SQL-запроса
	private function makeSqlWhere() {

		// очистить переменные
		$this->sql_where = " TRUE ";

		// Фильтр "ID образования" 
		if( count($this->where_qualification_id) ) {
			$this->sql_where .= ' AND t1.`qualification_id` IN ('. implode( ',', $this->where_qualification_id ) .')';
			$join_tickets_qualificationid_qualification = true;
		}

		// Фильтр "ID Города"
		if( count($this->where_city_id) ) {
			$this->sql_where .= ' AND t1.`id` IN (
				SELECT `user_id` FROM `user_cities` WHERE `city_id` IN ('. implode( ',', $this->where_city_id ) .')
			)';
		}

		return $this->sql_where;
	}

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// сформировать итоговые присоединения таблиц для SQL-запроса
	private function makeSqlJoin() {

		// очистить переменные
		$this->sql_join = '';

		// Присоединить `qualification` к `ticket`.`qualification_id` - Образование
		if( $this->join_tickets_qualificationid_qualification ) {
			$this->sql_join .= ' LEFT JOIN `qualification` AS t2 ON t2.`id` = t1.`qualification_id` ';
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

		return ' 	FROM `user` 	AS t1 
			'. $this->sql_join .'
			WHERE '. $this->sql_where;
	}
}

