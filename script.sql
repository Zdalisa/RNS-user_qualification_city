-- Создание таблицы "Образование" -- 
CREATE TABLE `qualification` (
 `id`		int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `name`		varchar(64) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='Образование';

INSERT INTO `qualification` (`id`, `name`) VALUES (NULL, 'среднее'), (NULL, 'магистр'), (NULL, 'бакалавр');

-- Создание таблицы "Города" --
CREATE TABLE `city` (
 `id`		int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `name`		varchar(64) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='Города';

INSERT INTO `city` (`id`, `name`) VALUES (NULL, 'Астрахань'), (NULL, 'Волгоград'), (NULL, 'Москва'), (NULL, 'Санкт-Петербург'), (NULL, 'Саратов'), (NULL, 'Орёл'), (NULL, 'Сочи');

-- Создание таблицы "Пользователи" --
CREATE TABLE `user` (
 `id`			int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `name`			varchar(64) NOT NULL COMMENT 'ФИО',
 `qualification_id`	int(11) NOT NULL COMMENT 'id Образование (связь с табл. qualification.qualification_id)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='Пользователи';

INSERT INTO `user` (`id`, `name`, `qualification_id`) VALUES (NULL, 'Иванов Иван Иванович', '1'), (NULL, 'Петров Петр Петрович', '2'), (NULL, 'Смирнов Игорь Валентинович', '3'), (NULL, 'Козлов Игорь Степанович', '2');

-- Создание таблицы "Города пользователей" --
CREATE TABLE `user_cities` (
 `id`			int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `user_id`		int(11) NOT NULL COMMENT 'id пользователя (связь с табл. user.user_id)',
 `city_id`		int(11) NOT NULL COMMENT 'id города (связь с табл. city.city_id)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='Города пользователей';

INSERT INTO `user_cities` (`id`, `user_id`, `city_id`) VALUES (NULL, '1', '1'), (NULL, '1', '2'), (NULL, '1', '7');
INSERT INTO `user_cities` (`id`, `user_id`, `city_id`) VALUES (NULL, '2', '3'), (NULL, '2', '5');
INSERT INTO `user_cities` (`id`, `user_id`, `city_id`) VALUES (NULL, '4', '6');