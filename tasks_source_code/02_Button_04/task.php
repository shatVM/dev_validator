﻿<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Button_04";
$cls_Task->s_id = "02_Button_04";
$cls_Task->s_description = "Розміщення кнопки на формі";

$cls_Task->_add_step("1. Створити проект <b>Button_04</b> відповідно специфікації у рішенні <b>Button</b>.");
$cls_Task->_add_step("2. Завантажити програму у <b>DEV-VALIDATOR</b>.");
$cls_Task->_add_step("3. Добитися повної валідації програми.");
$cls_Task->_add_step("4. Зберегти скріншот [Alt+PrintScreen] результатів у папку <b>Production</b>.");
$cls_Task->_add_step("5. Зберегти програму у папку <b>Production</b>.");

$cls_Task->_add_property("Availability of Form", "Наявність форми", "");
$cls_Task->_add_property("Application name", "Ім'я програми", "Button_04.exe");
$cls_Task->_add_property("AutoScaleMode", "Режим перерахунку форми", "None");
$cls_Task->_add_property("Text", "Текст Форми", "Подія на кнопці");
$cls_Task->_add_property("Width", "Ширина форми (в пікселях)", "700");
$cls_Task->_add_property("Height", "Висота форми (в пікселях)", "500");
$cls_Task->_add_property("StartPosition", "Початкова позиція", "По центру екрана");

$cls_Task->_add_object_creator("Додати об'єкт: ", "Button");
$cls_Task->_add_property("Name", "Ім'я кнопки", "btn_ChangeText");
$cls_Task->_add_property("Text", "Текст кнопки", "Змінити напис кнопки");
$cls_Task->_add_property("Size.Width", "Ширина кнопки", "500");
$cls_Task->_add_property("Size.Height", "Висота кнопки", "100");
$cls_Task->_add_property("Location.X", "Ордината кнопки", "100");
$cls_Task->_add_property("Location.Y", "Абсциса кнопки", "200");
$cls_Task->_add_property("ForeColor", "Колір тексту", "Crimson");
$cls_Task->_add_property("Font.Bold", "Жирний текст", "True");
$cls_Task->_add_property("Font.Size", "Розмір шрифту", "22");

$cls_Task->_add_object_creator("Створити подію для: ","btn_ChangeText");
$cls_Task->_add_code("Написати код:", "private void btn_ChangeText_Click(object sender, EventArgs e)
{
       btn_ChangeText.Text = \"Напис на кнопці змінено!!!\";
}", "");

$cls_Task->_add_property("btn_ChangeText.Text", "Текст кнопки", "Напис на кнопці змінено!!!");

$cls_Task->s_learn_url = "https://learn.ztu.edu.ua/mod/page/view.php?id=10041";
$cls_Task->s_youtube_url = "https://youtu.be/hP0UsFULLuU";
$cls_Task->s_discuss_url = "https://www.facebook.com/groups/1487277621317029/";
//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>