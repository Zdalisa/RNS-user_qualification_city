<?php
/*
 * Список образования
 *
 */
// подгрузить необходимые классы
include_once "{$path_model}/common/ticket_list.php";

// описание класса
class QualificationList extends TicketList {

	// загрузка данных из БД
	public function loadDataFromDB() {

		$this->list = array();
		$sql = '
			SELECT
				`id`,
				`name`
			FROM
				`qualification`
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

