<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Form_03";
$cls_Task->s_id = "11_Form_03"; //_exact_ folder name!
$cls_Task->s_description = "Зміна розмірів вікна";


$cls_Task->_add_step("Додати у рішення <b>WindowsForms</b> новий проект <b>Form_03</b>.");
$cls_Task->_add_step("Створити форму відповідно специфікації.");
$cls_Task->_add_step("Завантажити програму у <b>DEV-VALIDATOR</b>.");
$cls_Task->_add_step("Добитися повної валідації програми.");

$cls_Task->_add_step("Спробувати встановити інші розміри вікна.");
$cls_Task->_add_step("Зберегти проект та закрити рішення.");

$cls_Task->_block_start("Добитися валідації головної форми:", "_form.png");
$cls_Task->_add_property("Availability of Form", "Наявність форми", "");
$cls_Task->_add_property("Application name", "Ім'я програми", "Form_03");
$cls_Task->_add_property("AutoScaleMode", "Режим перерахунку форми", "None");
$cls_Task->_add_property("Text", "Текст Форми", "Зміна розмірів вікна");
$cls_Task->_add_property("BackColor", "Колір Форми", "IndianRed");
$cls_Task->_add_property("Size.Width", "Довжина Форми (в пікселях)", "700");
$cls_Task->_add_property("Size.Height", "Висота Форми (в пікселях)", "300");

//f screen:
$cls_Task->_add_screen("Кінцевий вигляд Форми:", "target_form.png");

$cls_Task->s_learn_url = "https://learn.ztu.edu.ua/mod/lesson/view.php?id=9977&pageid=8";
$cls_Task->s_youtube_url = "https://youtu.be/hP0UsFULLuU?t=5m55s";
$cls_Task->s_discuss_url = "https://www.facebook.com/groups/1487277621317029/";
//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>