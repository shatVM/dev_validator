<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Form_12";
$cls_Task->s_id = "11_Form_12"; //_exact_ folder name!
$cls_Task->s_description = "Вікно з повторюваною текстурою на весь екран";

$cls_Task->_add_step("Відкрити створене рішення <b>WindowsForms</b>.");
$cls_Task->_add_step("Додати у рішення новий проект <b>Form_12</b>.");
$cls_Task->_add_step("Знайти та зберегти у папку з проектом зображення <b>Безшовні текстури каменю</b>.");
$cls_Task->_add_step("Фоновий малюнок імпортувати в <b>Resourses</b>.");
$cls_Task->_add_step("Створити форму відповідно специфікації.");
$cls_Task->_add_step("Для закриття вікна використовуйте <b>Alt + F4</b>");
$cls_Task->_add_step("Завантажити програму у <b>DEV-VALIDATOR</b>.");
$cls_Task->_add_step("Добитися повної валідації програми.");
$cls_Task->_add_step("Зберегти проект.");

$cls_Task->_block_start("Добитися валідації головної форми:", "_form.png");
$cls_Task->_add_property("Availability of Form", "Наявність форми", "");
$cls_Task->_add_property("Application name", "Ім'я програми", "Form_12");
$cls_Task->_add_property("AutoScaleMode", "Режим перерахунку форми", "None");
$cls_Task->_add_property("WindowState", "Стартове положення вікна програми", "Розгорнуте на весь екран");
$cls_Task->_add_property("FormBorderStyle", "Пареметри границь вікна", "Без границь");
$cls_Task->_add_property("BackgroundImage", "Фонове зображення", "завантижити в Resourses Безшовні текстури каменю");
$cls_Task->_add_property("BackgroundImageLayout", "Спосіб відображення фонового малюнку", "Tile");

$cls_Task->_add_screen("Кінцевий вигляд Форми:", "target_form.png");

$cls_Task->s_learn_url = "https://msdn.microsoft.com/ru-ru/library/system.windows.forms.imagelayout(v=vs.110).aspx";
$cls_Task->s_youtube_url = "";
$cls_Task->s_discuss_url = "https://www.facebook.com/groups/1487277621317029/";
//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>