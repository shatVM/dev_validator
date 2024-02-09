<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
//titles:
$cls_Task->s_title = "Task_1.exe";
$cls_Task->s_id = "00_Lesson_01";
$cls_Task->s_description = "Task_1: Натискання на кнопку";

//steps:
$cls_Task->_add_step("Створити проект <b>Lesson_02.sln</b> у власній папці <b>Документи\C#</b>");
$cls_Task->_add_step("Вибрати шаблон <b>Windows Forms App (.Net Framework)</b>");
$cls_Task->_add_step("Назвати проект <b>Task_1</b>");
$cls_Task->_add_step("Цей проект буде дочірнім до <b>Lesson_00</b>");
$cls_Task->_add_step("https://youtu.be/8uyRd-aKlSI");
$cls_Task->_block_end();


$cls_Task->_add_step("Скомпілювати Windows форму, натиснувши зелений трикутник.");
$cls_Task->_add_step("<b>Знайти та запустити створену програму.</b>");
$cls_Task->_add_step(" - Відкрити власну папку.");
$cls_Task->_add_step(" - Знайти в ній створену програму <b>Документи\C#\Lesson_00\Task_01\bin\Debug\</b>");
$cls_Task->_add_step(" - Запустити  файл <b>Task_01.exe</b>");
$cls_Task->_add_step(" - Закрити Windows форму.");
$cls_Task->_block_end();

$cls_Task->_add_step("<b>Виконати валідацію програми</b>");
$cls_Task->_add_step(" - Завантажити програму у <b>DEV-VALIDATOR</b>");
$cls_Task->_add_step(" - Добитися повної валідації програми, змінюючи потрібні властивості");
$cls_Task->_add_step("https://youtu.be/pmEmg_AU4Lw?si=6HZN688PwYChB1Vx");


//validation blocks:
$cls_Task->_block_start("Добитися валідації головної форми:", "_form.png");
$cls_Task->_add_property("Availability of Form", "Наявність форми", "");
$cls_Task->_add_property("Application name", "Ім'я програми", "Task_01");
$cls_Task->_add_property("AutoScaleMode", "Режим перерахунку форми", "None");

//f screen:
$cls_Task->_add_screen("Кінцевий вигляд Форми:", "target_form.png");

//help:
$cls_Task->s_youtube_url = "https://youtu.be/xh2_WJrzxdY?si=a6U65Q9JsShYxgMJ";
$cls_Task->s_learn_url = "https://learn.ztu.edu.ua/mod/page/view.php?id=9976";
$cls_Task->s_discuss_url = "https://www.facebook.com/groups/1487277621317029/";
//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>