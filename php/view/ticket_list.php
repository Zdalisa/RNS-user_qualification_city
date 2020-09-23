<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="/css/common.css?v=<?=STYLE_VERSION?>">
		<script type="text/javascript" src="/js/jquery/core/jquery-1.10.2.min.js?v=<?=STYLE_VERSION?>"></script>
		<script type="text/javascript" src="/js/ticket_list.js?v=<?=STYLE_VERSION?>"></script>
	
		<title>Тестовое задание</title>
 	</head>
	<body>
		<section class="old_content">
		
		<!-- заголовок -->
		<div class="head"><h1><?= $view_main_title; ?></h1></div>
		<!-- начало контента -->
		<div class="phones">
			<!-- фильтр -->
			<form name="form" method="post">
				<div>
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								Образование:
								<?php foreach($qualification_list->getList() as $key => $value) : ?>
									<label style="padding-right: 10px;">
										<input type="checkbox" id="<?=$key?>" name="qualification" onclick="reloadUserList()">
										<span><?=$value?></span>
									</label>
								<?php endforeach; ?>
							</td>
						</tr>
						<tr>
							<td>
								Города:
								<?php foreach($city_list->getList() as $key => $value) : ?>
									<label style="padding-right: 10px;">
										<input type="checkbox" id="<?=$key?>" name="city" onclick="reloadUserList()">
										<span><?=$value?></span>
									</label>
								<?php endforeach; ?>
							</td>
						</tr>
						
					</table>
				</div>
			</form>
			<!-- таблица результата -->
			<div>Пользователи:</div>
			<div class="table">
			<table cellpadding="0" cellspacing="0" width="100%" id="result">
				<tr class="h">
					<td><nobr>ФИО</td>
					<td><nobr>Образование</td>
					<td><nobr>Города</td>
				</tr>
				<!-- вывод выборки -->
				<?php foreach($user_list->getList() as $value) : ?>
					<tr class="content">
						<td><?=$value['user']->getName() ?></td>
						<td><?=$value['qualification']->getName() ?></td>
						<td><?=$value['user_cities'] ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
			</div>

		<!-- завершение контента -->
		</div>
		</section>
 	</body>
</html>