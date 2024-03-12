<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Середовище розробки Microsoft Visual Studio";
$cls_Task->s_id = "";//Порожнє значення для теорії
$cls_Task->s_description = "";

$cls_Task->_add_step("<p class='container '>Visual Studio – інтегроване середовище розробки програмного забезпечення від фірми
Microsoft. Дане середовище дозволяє створювати різноманітні програмні продукти: консольні
програми, програми з графічним інтерфейсом, наприклад віконні додатки Windows Forms, а
також Web-додатки тощо. Середовище Visual Studio дозволяє розробляти додатки, використовуючи різні мови програмування: Visual C#, Visual Basic, Visual F#, Visual C++, Python і т.д. (рис. 1.1). Також існує
можливість розробляти додатки не тільки під Windows, а і під інші популярні платформи: Android, iOS. Версія Visual Studio Community є абсолютно безкоштовною для учнів, студентів та розробників програм з відкритим
програмним кодом.<br>
▶️ Для установки на ПК Visual Studio Community за допомогою Web Installer потрібно перейти за посиланням: <a href = 'https://go.microsoft.com/fwlink/?LinkId=691978&clcid;=0x419' target='_blank'>https://go.microsoft.com/fwlink/?LinkId=691978&clcid;=0x419</a><br>
▶️ Для завантаження іso-образу Visual Studio Community 2015 (7,1Гб) перейдіть за наступним посиланням: <a href = 'https://go.microsoft.com/fwlink/?LinkId=615448&clcid;=0x409' target='_blank'>https://go.microsoft.com/fwlink/?LinkId=615448&clcid;=0x409</a><br>
▶️ За даним посиланням можна завантажити та встановити попередні версії програмного забезпечення Visual Studio <a href = 'https://visualstudio.microsoft.com/ru/vs/older-downloads/' target='_blank'>https://visualstudio.microsoft.com/ru/vs/older-downloads/</a></p>
");

$cls_Task->_add_step("<p class='container'><b>Властивості Форми</b></p>");
$cls_Task->_add_step("<div class='container'>
<table class='table table-striped table-bordered'>
    <tbody><tr align='center'>
					<th width='180'>Властивість</th>
					<th width='*'>Пояснення</th>
				</tr>
				<tr>
					<td>Text</td>
					<td>Заголовок вікна</td>
				</tr>
				<tr>
					<td>Size
						<ul class='property'>
							<li>Width</li>
							<li>Height</li>
						</ul>
					</td>
					<td>Розмір форми (ширина; висота)*</td>
				</tr>
				<tr>
					<td>BackColor</td>
					<td>Колір фону форми</td>
				</tr>
				<tr>
					<td>BackgroundImage</td>
					<td>Фоновий малюнок форми</td>
				</tr>
				<tr>
					<td>BackgroundImageLayout</td>
					<td>Спосіб відображення фонового малюнку форми:
						<ul class='property'>
							<li>Zoom (зображення приймає розміри форми, зберігаючи пропорції);</li>
							<li>Stretch (зображення заповнює всю форму, при цьому пропорції не зберігаються)</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>StartPosition</td>
					<td>Позиція форми на екрані після запуску:
						<ul class='property'>
							<li>Manual (лівий верхній кут форми знаходиться в координатах, заданих у властивості Location);</li>
							<li>CenterScreen (форма з’являється в центрі екрана)</li>
						</ul></td>
				</tr>
				<tr>
					<td>Location
						<ul class='property'>
							<li>X</li>
							<li>Y</li>
						</ul></td>
					<td>Координати лівого верхнього кута форми по відношенню до лівого верхнього кута екрану. Дана властивість працює, якщо значення властивості StartPosition= Manual</td>
				</tr>
				<tr>
					<td>Opacity</td>
					<td>Відсоток непрозорості форми</td>
				</tr>
			</tbody>
</table>
</div>");


$cls_Task->_add_step("<p class='container'><b></b></p>");
$cls_Task->_add_step("<p class='container'></p>");

$cls_Task->s_learn_url = "";
$cls_Task->s_youtube_url = "";
$cls_Task->s_discuss_url = "";
//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>