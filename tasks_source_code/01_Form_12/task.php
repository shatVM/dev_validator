<?php
include("../../task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Form_12";
$cls_Task->s_id = "01_Form_12"; //_exact_ folder name!
$cls_Task->s_description = "Вікно з повторюваною текстурою на весь екран";

$cls_Task->_add_step("1. Відкрити створене рішення <b>Lesson_01</b>.");
$cls_Task->_add_step("2. Додати у рішення новий проект <b>Form_12</b>.");
$cls_Task->_add_step("3. Знайти та зберегти у папку з проектом зображення <b>Бесшовные текстуры камня</b>.");
$cls_Task->_add_step("4. Фоновий малюнок імпортувати в <b>Resourses</b>.");
$cls_Task->_add_step("5. Створити форму відповідно специфікації.");
$cls_Task->_add_step("6. Для закриття вікна використовуйте <b>Alt + F4</b>");
$cls_Task->_add_step("7. Завантажити програму у <b>DEV-VALIDATOR</b>.");
$cls_Task->_add_step("8. Добитися повної валідації програми.");
$cls_Task->_add_step("9. Зберегти скріншот результатів у папку <b>Production</b>.");
$cls_Task->_add_step("10. Скопіювати програму у папку <b>Production</b>.");
$cls_Task->_add_step("11. Зберегти проект та закрити рішення.");

$cls_Task->_add_step("<hr>");
$cls_Task->_add_step("Для коректної валідації програми встановіть властивості <b>AutoScaleMode</b> значення <b>None</b>");

$cls_Task->_add_property("Solution name", "Ім'я рішення", "Lesson_01");
$cls_Task->_add_property("Application name", "Ім'я програми", "Form_12.exe");
$cls_Task->_add_property("Form.AutoScaleMode", "Режим перерахунку форми", "None");
$cls_Task->_add_property("Form.WindowState", "Стартове положення вікна програми", "Розгорнуте на весь екран");
$cls_Task->_add_property("Form.FormBorderStyle", "Пареметри границь вікна", "Без границь");
$cls_Task->_add_property("Form.BackgroundImage", "Фонове зображення", "Бесшовные текстуры камня");
$cls_Task->_add_property("Form.BackgroundImageLayout", "Спосіб відображення фонового малюнку", "Tile");

$cls_Task->s_learn_url = "https://msdn.microsoft.com/ru-ru/library/system.windows.forms.imagelayout(v=vs.110).aspx";
$cls_Task->s_youtube_url = "";
$cls_Task->s_discuss_url = "https://www.facebook.com/groups/1487277621317029/";
//-------------------------------------------------->
//run:
include("../../t_task.php");
?>