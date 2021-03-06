<?php
/* 
 * Класс образования
 */

// подгрузить необходимые классы
include_once $GLOBALS['path_model'] .'/common/item_for_simple_ticket_list.php';

// Описание класса
class Qualification extends ItemForSimpleTicketList {

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// загрузка данных из БД
	public function loadDataFromDB() {
		list(
			$this->id,
			$this->name
		) = mysqlGetValues('
			SELECT
				`id`,
				`name`
			FROM
				`qualification`
			WHERE
				`id` = '. $this->id .'
		');
		return $this->id;
	}

}
