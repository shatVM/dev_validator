<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Form_02";
$cls_Task->s_id = "11_Form_02";
$cls_Task->s_description = "Розфарбуйте свою Windows форму";

$cls_Task->_add_step("Відкрити створене рішення <b>WindowsForms</b>");
$cls_Task->_add_step("https://youtu.be/hP0UsFULLuU?t=6m58s");
$cls_Task->_add_step("Додати у рішення новий проект <b>Form_02</b>");
$cls_Task->_add_step("Створити форму відповідно специфікації");
$cls_Task->_add_step("Завантажити програму у <b>DEV-VALIDATOR</b>");
$cls_Task->_add_step("Добитися повної валідації програми");

$cls_Task->_add_step("Спробувати інші кольори на закладках");
$cls_Task->_add_step("Зберегти проект");

$cls_Task->_block_start("Добитися валідації головної форми:", "_form.png");
$cls_Task->_add_property("Availability of Form", "Наявність форми", "");
$cls_Task->_add_property("Application name", "Ім'я програми", "Form_02");
$cls_Task->_add_property("AutoScaleMode", "Режим перерахунку форми", "None");
$cls_Task->_add_property("Text", "Текст Форми", "Розфарбуйте свою Windows форму");
$cls_Task->_add_property("BackColor", "Колір Форми", "CadetBlue");

//f screen:
$cls_Task->_add_screen("Кінцевий вигляд Форми:", "target_form.png");

$cls_Task->s_learn_url = "https://learn.ztu.edu.ua/mod/page/view.php?id=9978";
$cls_Task->s_youtube_url = "https://youtu.be/hP0UsFULLuU?t=4m51s";
$cls_Task->s_discuss_url = "https://www.facebook.com/groups/1487277621317029/";
//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>