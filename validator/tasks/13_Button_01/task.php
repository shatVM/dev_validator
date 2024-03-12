<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Button_01";
$cls_Task->s_id = "13_Button_01";
$cls_Task->s_description = "Зміна напису кнопки";

$cls_Task->_add_step("Створити проект <b>Button_01</b> у рішенні <b>WindowsForms</b>.");

$cls_Task->_add_step("Добитися повної валідації програми.");


$cls_Task->_add_screen("Вигляд програми:", "0.png");

$cls_Task->_block_start("Добитися валідації головної форми:", "_form.png");
$cls_Task->_add_property("Availability of Form", "Наявність форми", "");
$cls_Task->_add_property("Application name", "Ім'я програми", "Button_01.exe");
$cls_Task->_add_property("AutoScaleMode", "Режим перерахунку форми", "None");
$cls_Task->_add_property("Text", "Текст Форми", "Зміна напису кнопки");
$cls_Task->_add_property("StartPosition", "Початкова позиція", "CenterScreen");
$cls_Task->_block_end();

$cls_Task->_block_start("Додати об'єкт: Button", "_add_object.png");
$cls_Task->_add_property("Exists", "Наявність", "");
$cls_Task->_add_property("Name", "Ім'я кнопки", "button1");
$cls_Task->_add_property("Text", "Текст кнопки", "NewButton");
$cls_Task->_block_end();

$cls_Task->_add_screen("Вигляд програми:", "0.png");

$cls_Task->s_learn_url = "https://web.archive.org/web/20220709194753/https://informatics.in.ua/programming_csharp/part_02.php";
$cls_Task->s_youtube_url = "https://web.archive.org/web/20220709194753/https://informatics.in.ua/programming_csharp/part_02.php";


//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>