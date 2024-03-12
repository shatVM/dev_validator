<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
//titles:
$cls_Task->s_title = "1_Winter.exe";
$cls_Task->s_id = "00_Seasons_01";
$cls_Task->s_description = "Зміна налаштувань форми";

//steps:
$cls_Task->_add_step("Запустити <b>Visual Studio</b>");
$cls_Task->_add_step("Додати новий проект");
$cls_Task->_add_step("Вибрати шаблон <b>Visual C# - Windows Forms App</b>");
$cls_Task->_add_step("Назвати проект <b>1_Winter</b>");
$cls_Task->_add_step("Вибрати розміщення у власну папку <b>Документи\C#</b>");
$cls_Task->_add_step("Назвати рішення <b>Seasons_v1</b>");
$cls_Task->_block_end();
$cls_Task->_add_step("Встановити значення властивостям згідно специфікації");
$cls_Task->_add_step("<b>Виконати валідацію програми</b>");
$cls_Task->_add_step(" - Завантажити програму у <b>DEV-VALIDATOR</b>");
$cls_Task->_add_step(" - Добитися повної валідації програми");

//validation blocks:
$cls_Task->_block_start("Добитися валідації програми:", "_form.png");
$cls_Task->_add_property("Availability of Form", "Наявність форми", "");
$cls_Task->_add_property("Application name", "Ім'я програми", "1_Winter");
$cls_Task->_add_property("AutoScaleMode", "Режим перерахунку форми", "None");
$cls_Task->_add_property("Text", "Текст Форми", "Winter");
$cls_Task->_add_property("BackColor", "Колір Форми", "White");
$cls_Task->_add_property("Size.Width", "Ширина форми", "800");
$cls_Task->_add_property("Size.Height", "Висота форми", "500");


//f screen:
$cls_Task->_add_screen("Кінцевий вигляд Форми:", "1_Winter.png");

//help:
$cls_Task->s_youtube_url = "https://youtu.be/xh2_WJrzxdY?si=a6U65Q9JsShYxgMJ";
$cls_Task->s_learn_url = "https://learn.ztu.edu.ua/mod/page/view.php?id=9976";
$cls_Task->s_discuss_url = "https://www.facebook.com/groups/1487277621317029/";
//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>