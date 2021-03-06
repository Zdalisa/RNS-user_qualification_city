<?php
/*
 * Список (базовый класс для любого списка)
 *
 */

// описание класса
class TicketList {

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// свойства

	protected	$list = array();		// Список		(array -> зависит от реализиции в последующих классах)

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// конструктор
	public function __construct() {
	}

	//------------------------------------------------------------------------------------------------------------------------------------------------------
	// методы получения данных

	// Список
	public function getList() {
		return $this->list;
	}

	// Размер списка
	public function getCountList() {
		return count( $this->list );
	}

	// Проверить на существование элемент списка по его ключу
	public function checkItemById( $key ) {
		return isset( $this->list[ $key ] );
	}

	// Один элемент списка по его ключу
	public function getItemById( $key ) {
		return $this->list[ $key ];
	}

}

