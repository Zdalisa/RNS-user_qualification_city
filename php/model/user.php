<?php
/* 
 * Класс пользователя
 */

// подгрузить необходимые классы
include_once $GLOBALS['path_model'] .'/common/item_for_simple_ticket_list.php';

// Описание класса
class User extends ItemForSimpleTicketList {

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// свойства

	// базовые данные
	private $qualification_id = null;		// id Образование		(id->Qualification)

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// загрузка данных из БД
	public function loadDataFromDB() {
		list(
			$this->id,
			$this->name,
			$this->qualification_id,
		) = mysqlGetValues('
			SELECT
				`id`,
				`name`,
				`qualification_id`
			FROM
				`user`
			WHERE
				`id` = '. $this->id .'
		');
		return $this->id;
	}

}
