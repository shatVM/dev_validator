﻿<?php
include("../../task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Form_07";
$cls_Task->s_id = "01_Form_07"; //_exact_ folder name!
$cls_Task->s_description = "Напівпрозоре вікно";

$cls_Task->_add_step("1. Відкрити створене рішення <b>Lesson_01</b>.");
$cls_Task->_add_step("2. Додати у рішення новий проект <b>Form_07</b>.");
$cls_Task->_add_step("3. Створити форму відповідно специфікації.");
$cls_Task->_add_step("4. Завантажити програму у <b>DEV-VALIDATOR</b>.");
$cls_Task->_add_step("5. Добитися повної валідації програми.");
$cls_Task->_add_step("6. Зберегти скріншот <b>[Alt+PrintScreen]</b> результатів у папку <b>Production</b>.");
$cls_Task->_add_step("7. Скопіювати програму у папку <b>Production</b>.");
$cls_Task->_add_step("8. Зберегти проект та закрити рішення.");

$cls_Task->_add_step("<hr>");
$cls_Task->_add_step("Для коректної валідації програми встановіть властивості <b>AutoScaleMode</b> значення <b>None</b>");

$cls_Task->_add_property("Solution name", "Ім'я рішення", "Lesson_01");
$cls_Task->_add_property("Application name", "Ім'я програми", "Form_07.exe");
$cls_Task->_add_property("Form.AutoScaleMode", "Режим перерахунку форми", "None");
$cls_Task->_add_property("Form.Text", "Текст Форми", "Opacity - Напівпрозоре вікно");
$cls_Task->_add_property("Form.BackColor.Name", "Колір Форми", "Sienna");
$cls_Task->_add_property("Form.WindowState", "Стартове положення вікна програми", "Розгорнуте на весь екран");
$cls_Task->_add_property("Form.Opacity", "Прозорість вікна", "50% або 0,5");

$cls_Task->s_learn_url = "https://msdn.microsoft.com/ru-ru/library/system.windows.forms.form.opacity(v=vs.110).aspx";
$cls_Task->s_youtube_url = "";
$cls_Task->s_discuss_url = "https://www.facebook.com/groups/1487277621317029/";
//-------------------------------------------------->
//run:
include("../../t_task.php");
?>