<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Form_08";
$cls_Task->s_id = "1
1_Form_08"; //_exact_ folder name!
$cls_Task->s_description = "Вікно на весь екран";

$cls_Task->_add_step("ідкрити створене рішення <b>WindowsForms</b>.");
$cls_Task->_add_step("Додати у рішення новий проект <b>Form_08</b>.");
$cls_Task->_add_step("Створити форму відповідно специфікації.");
$cls_Task->_add_step("Для закриття вікна використовуйте <b>Alt + F4</b>");
$cls_Task->_add_step("Завантажити програму у <b>DEV-VALIDATOR</b>.");
$cls_Task->_add_step("Добитися повної валідації програми.");
$cls_Task->_add_step("Зберегти проект.");

$cls_Task->_block_start("Добитися валідації головної форми:", "_form.png");
$cls_Task->_add_property("Availability of Form", "Наявність форми", "");
$cls_Task->_add_property("Application name", "Ім'я програми", "Form_08");
$cls_Task->_add_property("AutoScaleMode", "Режим перерахунку форми", "None");
$cls_Task->_add_property("BackColor.Name", "Колір Форми", "MediumAquamarine");
$cls_Task->_add_property("WindowState", "Стартове положення вікна програми", "Розгорнуте на весь екран");
$cls_Task->_add_property("FormBorderStyle", "Пареметри границь вікна", "None");

$cls_Task->_add_screen("Кінцевий вигляд Форми:", "target_form.png");

$cls_Task->s_learn_url = "https://social.msdn.microsoft.com/Forums/ru-RU/cf54d896-3c7b-4f69-8e60-1ab022b0c9bf/-?forum=fordesktopru";
$cls_Task->s_youtube_url = "";
$cls_Task->s_discuss_url = "https://www.facebook.com/groups/1487277621317029/";
//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>