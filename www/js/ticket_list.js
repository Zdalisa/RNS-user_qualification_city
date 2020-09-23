// заставляем не кофликтовать jquery
// $j - когда используем 1.10.2
// $ - когда 1.2.6
var $j = $.noConflict(true);
$j.fn.select2.defaults.set('language', 'ru');

// по ajax обновляет список пользователей
function reloadUserList() {

	// массив образования
	var arr_qualification = checkbox_checked('qualification');
	// массив выбранных городов
	var arr_city = checkbox_checked('city');

	// по ajax запросить данные и сделать обновление
	$j.ajax({
		type		: 'post',
		url		: '/?do=dealers_ticket_list_ajax',
		dataType	: 'json',
		data	: {
			qualification 	: arr_qualification,
			city 		: arr_city
		},
		// ответ будет в json формате, который сразу будет распарсен в объект
		success	: function (data) {

			// проверка объекта
			if ( typeof(data) == 'object' ) {
				// генерим html
				var table = '';
				var tr = '';

				table += '<table cellpadding="0" cellspacing="0" width="100%" id="result">';
				tr += '<tr class="h">';
				tr += '<td><nobr>ФИО</td>';
				tr += '<td><nobr>Образование</td>';
				tr += '<td><nobr>Города</td>';
				tr += '</tr>';
				$j.each( data, function(index, value) {
					tr += '<tr class="content">';
					tr +=	'<td>'+ value['user'] +'</td>';
					tr +=	'<td>'+ value['qualification'] +'</td>';
					tr +=	'<td>'+value['user_cities']+ '</td>';
					tr += '</tr>';
				});

				table += tr;
				table += '</table>';

				// отображаем
				$j('#result').html( table );
			}
			else {
				// сообщить
				alert('К сожалению произошла ошибка на сервере.');
			}
		},
		error:	function () {
			alert('Произошла ошибка при передаче данных!');
		}
	});

}

/*
 *	определяет какие элементы чекбокса выбраны
 * 	@param 		- name 		- название чекбокса
 *	@return 	- arr 		- массив выбранных элементов
 *
 */
function checkbox_checked(name) {

	var checkbox = document.getElementsByName(name);
	var arr = [];
	for(var i=0; i<checkbox.length; i++) {
		// если выбран чекбокс
    		if (checkbox[i].checked) {
    			// заносим id в массив
    			arr.push(checkbox[i].id);
  	 	}
	}

	return arr;
}