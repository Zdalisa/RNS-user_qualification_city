<?php
/*
 * Список городов
 *
 */
// подгрузить необходимые классы
include_once "{$path_model}/common/ticket_list.php";

// описание класса
class CityList extends TicketList {

	// загрузка данных из БД
	public function loadDataFromDB() {

		$this->list = array();
		$sql = '
			SELECT
				`id`,
				`name`
			FROM
				`city`
			ORDER BY
				`name`
			LIMIT 0 , 50
		';

		$res = mysqlQuery($sql);
		while( $row = mysqlFetchArray($res) ) {
			$this->list[ $row[0] ] = $row[1];
		}
		return $res;
	}
}

