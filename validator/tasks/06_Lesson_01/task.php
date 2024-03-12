<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Менше число";
$cls_Task->s_id = "06_Lesson_01";
$cls_Task->s_description = "Менше число";

$cls_Task->_add_step("<b>Опис:</b> <i>Відомо два різних числа. Визначити менше з них.</i>");
$cls_Task->_add_step("Створити проект <b>Task_1</b> у рішенні <b>Lesson_06</b>");
$cls_Task->_add_step("Завантажити програму у <b>DEV-VALIDATOR</b>.");
$cls_Task->_add_step("Добитися повної валідації програми.");
$cls_Task->_add_step("");

$cls_Task->_add_screen("Вигляд програми","0.png");
$cls_Task->_add_step("<p>

<pre>
    <code class='cs hljs'>
        private void button1_Click(object sender, EventArgs e)
        {
            int a = int.Parse(textBox1.Text);
            int b = int.Parse(textBox2.Text);
            int min;
            if (a < b)
                min = a;
            else min = b;
            label4.Text = min.ToString();
        }
    </code>	
</pre>

У використаному розгалуженні в обох гілках виконується лише по одній команді, а отже, можна використати його скорочену форму запису (без фігурних дужок).

");





// $cls_Task->_add_screen("Вигляд програми","2.png");

 $cls_Task->_block_start("Добитися валідації головної форми:", "_form.png");
 $cls_Task->_add_property("Availability of Form", "Наявність форми", "");
 $cls_Task->_add_property("Application name", "Ім'я програми", "Task_1.exe");
 $cls_Task->_add_property("AutoScaleMode", "Режим перерахунку форми", "None");
 $cls_Task->_add_property("Text", "Текст Форми", "Мінімум");
// $cls_Task->_add_property("Size.Width", "Ширина форми (в пікселях)", "600");
// $cls_Task->_add_property("Size.Height", "Висота форми (в пікселях)", "400");
// $cls_Task->_add_property("StartPosition", "Початкова позиція", "По центру екрана");
// $cls_Task->_add_property("Font.Size", "Розмір шрифту", "20");
// $cls_Task->_block_end();

// $cls_Task->_block_start("Розмістити об'єкти на формі:", "_form.png");
// $cls_Task->_add_screen("","0.png");
// $cls_Task->_block_end();

// $cls_Task->_block_start("Додати компонент: TextBox (текстове поле)", "_add_object.png");
// $cls_Task->_add_property("Exists", "Наявність", "");
// $cls_Task->_add_property("Name", "Ім'я", "tb_Input");
// $cls_Task->_add_property("Text", "Текст", "0");
// $cls_Task->_block_end();

// $cls_Task->_block_start("Додати компонент: Label (напис)", "_add_object.png");
// $cls_Task->_add_property("Exists", "Наявність", "");
// $cls_Task->_add_property("Name", "Ім'я", "lb_Perimeter");
// $cls_Task->_add_property("Text", "Текст", "Периметр = 0");
// $cls_Task->_block_end();

// $cls_Task->_block_start("Додати компонент: Label (напис)", "_add_object.png");
// $cls_Task->_add_property("Exists", "Наявність", "");
// $cls_Task->_add_property("Name", "Ім'я", "lb_Square");
// $cls_Task->_add_property("Text", "Текст", "Площа = 0");
// $cls_Task->_block_end();


// $cls_Task->_block_start("Додати компонент: Button (кнопка)", "_add_object.png");
// $cls_Task->_add_property("Exists", "Наявність", "");
// $cls_Task->_add_property("Name", "Ім'я", "btn_Calculate");
// $cls_Task->_add_property("Text", "Текст", "Обчислити");
// $cls_Task->_block_end();

// $cls_Task->_block_start("Сгенерувати подію <b>Click</b> для кнопки: <b>btn_Calculate</b>", "_add_event.png");
// $cls_Task->_add_code_validated("Код події:", "private void btn_Calculate_Click(object sender, EventArgs e)
// {
    
// }", "");
// $cls_Task->_block_end();

// $cls_Task->_block_start("Написати код обробника події <b>btn_Calculate_Click</b>:", "_add_code.png");
// $cls_Task->_add_code_validated("Вписати код:", "

//  //Ініціалізація сторони та її зчитування
// byte Side;
// Side = byte.Parse(tb_Input.Text);

// //Ініціалізація периметра і площі та їх обрахунок 
// int P, S;
// P = 4 * Side;
// S = Side * Side;

// //Виведення периметра та площі квадрата
// lb_Perimeter.Text = \"Периметр = \" + P.ToString();
// lb_Square.Text = \"Площа = \" + S.ToString();

// ", "");
// $cls_Task->_block_end();


// $cls_Task->_block_start("Виконати тестування програми, здійснивши введення власних даних та проаналізувавши отриманий результат:", "_form.png");

// $cls_Task->_add_screen("Вигляд програми після введення значення та натискання на кнопку <b>Обчислити</b>","2.png");
// $cls_Task->_add_screen("Вигляд програми після введення значення та натискання на кнопку <b>Обчислити</b>","3.png");
// $cls_Task->_block_end();

// $cls_Task->_block_start("Виконати валідацію програми:", "_form.png");
// $cls_Task->_add_property("lb_Perimeter.Text", "Текст ", "<i>Розраховані програмою значення</i>");
// $cls_Task->_add_property("lb_Square.Text", "Текст ", "<i>Розраховані програмою значення</i>");
// $cls_Task->_block_end();


// $cls_Task->s_learn_url = "";
// $cls_Task->s_youtube_url = "";
// $cls_Task->s_discuss_url = "";
//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>