<?php
session_start();
require("../../main_config.php");
require($s_v_app_root."task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Квадрат";
$cls_Task->s_id = "04_Lesson_01";
$cls_Task->s_description = "робота з цілими числами";

$cls_Task->_add_step("<b>Опис:</b> <i>даний додаток дозволяє при введені сторони квадрату обрахувати та вивести його периметр та площу.</i>");
$cls_Task->_add_step("Створити проект <b>task_1</b> у рішенні <b>lesson_4</b>");
$cls_Task->_add_step("Завантажити програму у <b>DEV-VALIDATOR</b>.");
$cls_Task->_add_step("Добитися повної валідації програми.");
$cls_Task->_add_step("Перейдемо до практики. Напишемо програму для знаходження периметра і площі квадрату, якщо відомо його сторону (ціле число).

В переважній більшості програм на обчислення можна виділити три етапи: <br>
<table>

<ol >
    <li> зчитування вхідних даних;</li> 
    <li> проведення обчислень; </li>
    <li> виведення результатів. </li>
</ol>

</table>

Для реалізації першого етапу потрібно передбачити елемент програми, в який користувач зможе ввести число (сторону квадрату). Таким елементом в Visual C# є текстове поле <b>TextBox</b>. Розглянемо деякі властивості елемента TextBox.");

$cls_Task->_add_step("<b>Об’єкт Текстове поле (TextBox)</b> ");
$cls_Task->_add_step("
<table class='container table table-striped table-bordered'>
    <tbody><tr >
        <th width='220'>Властивість</th>
        <th width='*'>Пояснення</th>
    </tr>
    <tr>
        <td>Text</td>
        <td>Текст в полі</td>
    </tr>
    <tr>
        <td>Size
            <ul >
                <li>Width</li>
                <li>Height</li>
            </ul>
        </td>
        <td>Розмір компонента (ширина; висота)</td>
    </tr>
    <tr>
        <td>BackColor</td>
        <td>Колір фону поля</td>
    </tr>
    <tr>
        <td>BackgroundImage</td>
        <td>Фоновий малюнок поля</td>
    </tr>
    <tr>
        <td>ReadOnly</td>
        <td>
            <ul >
                <li>True – поле доступне лише для читання;</li>
                <li>False – текстове поле доступне для внесення змін</li>
            </ul>
        </td>
    </tr>
    <tr>
        <td>Font</td>
        <td>Параметри шрифту напису (гарнітура шрифту, накреслення, розмір)</td>
    </tr>
    <tr>
        <td>ForeColor</td>
        <td>Колір тексту</td>
    </tr>
    <tr>
        <td>Visible</td>
        <td>Видимість:
            <ul >
                <li>True – компонент видимий;</li>
                <li>False – компонент невидимий</li>
            </ul></td>
    </tr>
    <tr>
        <td>TextAlign</td>
        <td>Вирівнювання тексту в компоненті.</td>
    </tr>
</tbody></table>

");


$cls_Task->_add_step("<p>
Домовимося в текстове поле записувати за замовчуванням число 0. Окрім текстового поля вікно програми повинно містити кнопку, яка запускає обчислювальний процес, а також, написи для виведення відповідей. Перейдемо у конструктор форм і створимо інтерфейс майбутньої програми згідно зразка.


Тепер потрібно написати обробник події “натиснута кнопка”. Для цього знайдемо в списку подій об’єкта кнопки подію Click та виконаємо подвійний клік напроти неї. Ми перейшли в програмний код із заготовленим шаблоном обробника події button1_Click. Цього самого можна досягти, виконавши подвійний клік на кнопці в конструкторі форм.

Розпочнемо реалізацію першого етапу — зчитування вхідних даних. Оголосимо змінні, яка знадобляться в даній програмі:

<pre>
    <code class='cs hljs'>
        byte Side;
        int p, s;
    </code>	
</pre>

Тепер потрібно зчитати число з текстового поля textBox1 і присвоїти це число змінній Side. Для цього потрібно записати такий рядок:

<pre>
    <code class='cs hljs'>
        Side = byte.Parse(textBox1.Text);
    </code>	
</pre>

Даний рядок виконується справа наліво в такий послідовності:

зчитується текст з поля textBox1;
зчитаний текст перетворюється в число типу byte;
отримане число присвоюється змінній Side.
Другий етап – проведення обчислень – реалізується двома наступними рядками:

<pre>
    <code class='cs hljs'>
        p = 4 * Side;
        s = Side * Side;
    </code>	
</pre>

Третій етап – Виведення результатів на екран. В елемент Напис можна виводити лише дані текстового типу. Тому, при потребі вивести в Напис числове значення, його потрібно попередньо перетворити в текст:

<pre>
    <code class='cs hljs'>
        label1.Text = p.ToString();
        label2.Text = s.ToString();
    </code>	
</pre>

Виконавши всі три етапи отримаємо метод button1_Click – обробник події “натиснута кнопка”:
<pre>
    <code class='cs hljs'>
        private void button1_Click(object sender, EventArgs e)
        {
            byte Side; 
            int p, s; 
            Side = byte.Parse(textBox1.Text);
            p = 4 * Side;
            s = Side * Side;
            label1.Text = p.ToString();
            label2.Text = s.ToString();
        }
    </code>	
</pre>
</p>");



$cls_Task->_add_screen("Вигляд програми","2.png");

$cls_Task->_block_start("Добитися валідації головної форми:", "_form.png");
$cls_Task->_add_property("Availability of Form", "Наявність форми", "");
$cls_Task->_add_property("Application name", "Ім'я програми", "task_1.exe");
$cls_Task->_add_property("AutoScaleMode", "Режим перерахунку форми", "None");
$cls_Task->_add_property("Text", "Текст Форми", "Квадрат");
$cls_Task->_add_property("Size.Width", "Ширина форми (в пікселях)", "600");
$cls_Task->_add_property("Size.Height", "Висота форми (в пікселях)", "400");
$cls_Task->_add_property("StartPosition", "Початкова позиція", "По центру екрана");
$cls_Task->_add_property("Font.Size", "Розмір шрифту", "20");
$cls_Task->_block_end();

$cls_Task->_block_start("Розмістити об'єкти на формі:", "_form.png");
$cls_Task->_add_screen("","1.png");
$cls_Task->_block_end();

$cls_Task->_block_start("Додати компонент: TextBox (текстове поле)", "_add_object.png");
$cls_Task->_add_property("Exists", "Наявність", "");
$cls_Task->_add_property("Name", "Ім'я", "tb_Input");
$cls_Task->_add_property("Text", "Текст", "0");
$cls_Task->_block_end();

$cls_Task->_block_start("Додати компонент: Label (напис)", "_add_object.png");
$cls_Task->_add_property("Exists", "Наявність", "");
$cls_Task->_add_property("Name", "Ім'я", "lb_Perimeter");
$cls_Task->_add_property("Text", "Текст", "Периметр = 0");
$cls_Task->_block_end();

$cls_Task->_block_start("Додати компонент: Label (напис)", "_add_object.png");
$cls_Task->_add_property("Exists", "Наявність", "");
$cls_Task->_add_property("Name", "Ім'я", "lb_Square");
$cls_Task->_add_property("Text", "Текст", "Площа = 0");
$cls_Task->_block_end();


$cls_Task->_block_start("Додати компонент: Button (кнопка)", "_add_object.png");
$cls_Task->_add_property("Exists", "Наявність", "");
$cls_Task->_add_property("Name", "Ім'я", "btn_Calculate");
$cls_Task->_add_property("Text", "Текст", "Обчислити");
$cls_Task->_block_end();

$cls_Task->_block_start("Сгенерувати подію <b>Click</b> для кнопки: <b>btn_Calculate</b>", "_add_event.png");
$cls_Task->_add_code_validated("Код події:", "private void btn_Calculate_Click(object sender, EventArgs e)
{
    
}", "");
$cls_Task->_block_end();

$cls_Task->_block_start("Написати код обробника події <b>btn_Calculate_Click</b>:", "_add_code.png");
$cls_Task->_add_code_validated("Вписати код:", "

 //Ініціалізація сторони та її зчитування
byte Side;
Side = byte.Parse(tb_Input.Text);

//Ініціалізація периметра і площі та їх обрахунок 
int P, S;
P = 4 * Side;
S = Side * Side;

//Виведення периметра та площі квадрата
lb_Perimeter.Text = \"Периметр = \" + P.ToString(\"#.##\");
lb_Square.Text = \"Площа = \" + S.ToString(\"#.##\");

", "");
$cls_Task->_block_end();


$cls_Task->_block_start("Виконати тестування програми, здійснивши введення власних даних та проаналізувавши отриманий результат:", "_form.png");

$cls_Task->_add_screen("Вигляд програми після введення значення та натискання на кнопку <b>Обчислити</b>","2.png");
$cls_Task->_add_screen("Вигляд програми після введення значення та натискання на кнопку <b>Обчислити</b>","3.png");
$cls_Task->_block_end();

$cls_Task->_block_start("Виконати валідацію програми:", "_form.png");
$cls_Task->_add_property("lb_Perimeter.Text", "Текст ", "<i>Розраховані програмою значення</i>");
$cls_Task->_add_property("lb_Square.Text", "Текст ", "<i>Розраховані програмою значення</i>");
$cls_Task->_block_end();


$cls_Task->s_learn_url = "";
$cls_Task->s_youtube_url = "";
$cls_Task->s_discuss_url = "";
//-------------------------------------------------->
//run:
include($s_v_app_root."t_task.php");
?>