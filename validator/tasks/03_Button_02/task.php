<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Button_02";
$cls_Task->s_id = "03_Button_02";
$cls_Task->s_description = "Зміна імені кнопки";

$cls_Task->_add_step("Створити проект <b>Button_02</b> у рішенні <b>WindowsForms</b> .");
$cls_Task->_add_step("Завантажити програму у <b>С-VALIDATOR</b>.");
$cls_Task->_add_step("Добитися повної валідації програми.");
$cls_Task->_add_step("Зберегти програму у папку <b>Production</b>.");

$cls_Task->_add_screen("Вигляд програми:", "0.png");

$cls_Task->_block_start("Добитися валідації головної форми:", "_form.png");
$cls_Task->_add_property("Availability of Form", "Наявність форми", "");
$cls_Task->_add_property("Project name", "Ім'я програми", "Button_02");
$cls_Task->_add_property("AutoScaleMode", "Режим перерахунку форми", "None");
$cls_Task->_block_end();

$cls_Task->_block_start("Додати об'єкт: Button", "_add_object.png");
$cls_Task->_add_property("Exists", "Наявність", "");
$cls_Task->_add_property("Name", "Ім'я кнопки", "btn_Close");
$cls_Task->_add_property("Text", "Текст кнопки", "Close");
$cls_Task->_block_end();

$cls_Task->_add_screen("Вигляд програми:", "0.png");

$cls_Task->s_learn_url = "https://web.archive.org/web/20220709194753/https://informatics.in.ua/programming_csharp/part_02.php";
$cls_Task->s_youtube_url = "https://web.archive.org/web/20220709194753/https://informatics.in.ua/programming_csharp/part_02.php";
//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>