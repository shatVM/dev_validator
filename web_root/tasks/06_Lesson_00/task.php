<?php
session_start();
require("../../main_config.php");
require($s_v_app_root . "task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Алгоритмічна структура розгалуження";
$cls_Task->s_id = "";//Порожнє значення для теорії
$cls_Task->s_description = "";

$cls_Task->_add_step("<p class='container theory'>Для розв’язання усіх задач, які розглядалися вище, ми складали алгоритми, в яких всі дії виконувалися послідовно одна за одною. Такі алгоритми називаються лінійними. За допомогою лінійних алгоритмів можна розв’язувати, як правило, лише найпростіші задачі. Досить часто при розв’язуванні задач потрібно аналізувати умову, і в залежності від того, виконується вона або ні, виконувати різні дії. Алгоритмічна структура розгалуження – це структура, в якій, в залежності від поставленої умови, виконуються різні команди. В мові програмування C# існує три види алгоритмів розгалуження:

if – else;
switch (оператор вибору);
?: (тернарний оператор).</p>


");

$cls_Task->_add_step("<p class='container'><b>Команда розгалуження if – else</b></p>
<img scr = '0.png'>

");

$cls_Task->_add_step("<div class='container'>
Мовою C# дана структура записується таким чином:

<pre>
    <code class='cs hljs'>
         //Команда розгалуження
         if (умова)
            {
                команда 1;
                команда 2;
                …;
            }
         else
            {
                команда 1;
                команда 2;
                …;
            }
    </code>	
</pre>

В команді розгалуження if – else спочатку аналізується умова, якщо умова істинна (+) – виконуються дії 1, якщо ж умова хибна (–) – виконуються дії 2. <br>

<b>Зауваження 1.</b> Блок else в даній структурі є не обов’язковим. Розгалуження без блоку else називають неповним.

</div>");
$cls_Task->_add_screen("", "1.png");



$cls_Task->_add_step("<p class='container'>В C# неповне розгалуження записується так:
<pre>
    <code class='cs hljs'>
        if (умова)
            {
            команда 1;
            команда 2;
            …;
            }
    </code>	
</pre>

<b>Зауваження 2.</b> Якщо у гілках істинності умови (+) або/i хибності умови (–) потрібно виконати лише одну команду, то фігурні дужки можна не ставити. Таким чином, алгоритм може бути записаний в скороченій формі: 
<pre>
    <code class='cs hljs'>
        if (умова) 
            команда 1; 
        else
            команда 2;</p>
     </code>	
</pre>
     ");



$cls_Task->_add_step("<p class='container'><b>Арифметичні операції</b></p>");
$cls_Task->_add_step("<div class='container'>
<table class='table table-striped table-bordered'>
    <tbody><tr align='center'>
        <th width='120'>Оператор</th>
        <th width='400'>Опис</th>
        <th width='*'>Приклади</th>
    </tr>
    <tr>
        <td>+</td>
        <td>Додавання</td>
        <td>2 + 3 = 5; <br>
        3.6 + 7.3 = 10.9</td>
    </tr>
    <tr>
        <td>-</td>
        <td>Віднімання</td>
        <td>7 - 9 = -1; <br>
        6 - 1.25 = 4.75</td>
    </tr>
    <tr>
        <td>*</td>
        <td>Множення</td>
        <td>7 * 2 = 14; <strike>2а</strike></td>
    </tr>
    <tr>
        <td>/</td>
        <td>Ділення</td>
        <td>5 / 2 = 2; 15 / 4 = 3<br>5.0 / 2 = 2.5; <br>15 / 4.0 = 3.75</td>
    </tr>
    <tr>
        <td>%</td>
        <td>Остача від ділення</td>
        <td>5 % 2 = 1; <br>27 % 4 = 3; <br>8 % 4 = 0</td>
    </tr>
    <tr>
        <td>++</td>
        <td>Інкремент (збільшення значення змінної на 1)</td>
        <td>x++</td>
    </tr>
    <tr>
        <td>--</td>
        <td>Декремент (зменшення значення змінної на 1)</td>
        <td>a--</td>
    </tr>
</tbody></table>

</div>");
$cls_Task->_add_step("<p class='container'><b>Примітка 1</b> Якщо ділене і дільник є цілими числами, то результатом операції ділення буде лише ціла частина частки.<br>

<b>Примітка 2</b>. Знак множення ставиться обов’язково.</p>");

$cls_Task->_add_step("<p class='container'><b>Оголошення змінної. Ініціалізація змінної. Оператор присвоювання</b></p>");
$cls_Task->_add_step("<p class='container'>
Перед першим використанням змінну потрібно оголосити — вказати її ім’я та тип, до якого вона належить. Спроба використати змінну, яка не була оголошена, призведе до помилки компіляції.

<b><i>Приклади оголошення змінних:</b></i><br>

<pre >
    <code class='cs hljs'>
        byte a; <br>
        int s, t; <br>
        double v; <br>
    </code>
</pre>		

Надання змінній початкового значення називається ініціалізацією. Оголошення змінної та її ініціалізацію можна об’єднувати в один запис, наприклад: <br>

<pre >
    <code class='cs hljs'>
        byte a = 7; <br>
        int s = 130, t = 2; <br>
    </code>	
</pre >	

Знак “=” в мові C# називають оператором присвоювання. В загальному, операція присвоювання має такий вигляд: <br>

<pre >
    <code class='cs hljs'>
        ім’я змінної = значення або вираз; <br>
    </code>	
</pre >

Якщо справа від знаку “=” записано вираз, то він спочатку обчислюється, а потім результат присвоюється змінній, ім’я якої записано ліворуч.
</p>");


$cls_Task->_add_step("<p class='container'><b></b></p>");
$cls_Task->_add_step("<p class='container'></p>");

$cls_Task->s_learn_url = "";
$cls_Task->s_youtube_url = "";
$cls_Task->s_discuss_url = "";
//-------------------------------------------------->
//run:
include($s_v_app_root . "t_task.php");
?>