<?php
session_start();
require("../../main_config.php");
require($s_v_app_root . "task_core.php");
$cls_Task = new cls_Task();
//-------------------------------------------------->
$cls_Task->s_title = "Алгоритмічна структура розгалуження";
$cls_Task->s_id = "";//Порожнє значення для теорії
$cls_Task->s_description = "";

$cls_Task->_add_step("<p class='container '>Для розв’язання усіх задач, які розглядалися вище, ми складали алгоритми, в яких всі дії виконувалися послідовно одна за одною. Такі алгоритми називаються лінійними. За допомогою лінійних алгоритмів можна розв’язувати, як правило, лише найпростіші задачі. Досить часто при розв’язуванні задач потрібно аналізувати умову, і в залежності від того, виконується вона або ні, виконувати різні дії. Алгоритмічна структура розгалуження – це структура, в якій, в залежності від поставленої умови, виконуються різні команди. <br>
В мові програмування C# існує три види алгоритмів розгалуження:

<table>

<ol >
    <li>if – else;</li> 
    <li> switch (оператор вибору); </li>
    <li> ?: (тернарний оператор). </li>
</ol>

</table>


</p>


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



$cls_Task->_add_step("<p class='container'><bОперації порівняння</b></p>");
$cls_Task->_add_step("<div class='container'> До складу умови можуть входити числа, змінні, математичні вирази, які поєднуються операціями
порівняння. Розглянемо, як записуються операції порівняння в C#.
<table class='table table-striped table-bordered'>
    <tbody><tr align='center'>
					<th width='100'>C#</th>
					<th width='*'>Операція порівняння</th>
				</tr>
				<tr>
					<td>&gt;</td>
					<td>Більше</td>
				</tr>
				<tr>
					<td>&lt;</td>
					<td>Менше</td>
				</tr>
				<tr>
					<td>&gt;=</td>
					<td>Більше або дорівнює</td>
				</tr>
				<tr>
					<td>&lt;=</td>
					<td>Менше або дорівнює</td>
				</tr>
				<tr>
					<td>==</td>
					<td>Дорівнює</td>
				</tr>
				<tr>
					<td>!=</td>
					<td>Не дорівнює</td>
				</tr>
			</tbody>

</table>

</div>");

$cls_Task->_add_step("<p class='container'><b>Логічні операції</b></p>");
$cls_Task->_add_step("<p class='container'>Логічні умови виду x>5 або a<=0 називають простими умовами. Складені умови поєднують в собі
декілька простих умов. Для поєднання декількох простих умов використовують логічні операції
кон’юнкції та диз’юнкції:</p>");
$cls_Task->_add_step("<div class='container'> До складу умови можуть входити числа, змінні, математичні вирази, які поєднуються операціями
порівняння. Розглянемо, як записуються операції порівняння в C#.
<table class='table table-striped table-bordered'>
    <tbody><tr align='center'>
					<th width='60'>C#</th>
					<th width='380'>Логічна операція</th>
					<th width='*'>Приклад запису</th>
				</tr>
				<tr>
					<td>&amp;&amp;</td>
					<td>Логічне «І» - кон’юнкція. Логічний вираз буде істинним, якщо кожна з простих умов буде істинна. Хибним – якщо хоча б одна з простих умов є хибною.</td>
					<td>x&gt;0 &amp;&amp; x&lt;100</td>
				</tr>
				<tr>
					<td>||</td>
					<td>Логічне «АБО» - диз’юнкція. Логічний вираз буде істинним, якщо хоча б одна з простих умов буде істинна. Хибним – якщо кожна з простих умов є хибна.</td>
					<td>a==b || b==c || a==c</td>
				</tr>
			</tbody>

</table>

</div>");

$cls_Task->_add_step("<p class='container'><b>Оператор вибору switch</b></p>");
$cls_Task->_add_step("<p class='container'>В мові C# існує оператор вибору, який дозволяє реалізувати розгалуження обчислювального процесу в багато напрямків. В загальному оператор вибору має такий вигляд:</p>");
$cls_Task->_add_step("<div class='container'> До складу умови можуть входити числа, змінні, математичні вирази, які поєднуються операціями
порівняння. Розглянемо, як записуються операції порівняння в C#.
<pre>
    <code class='cs hljs'>
        switch (змінна)
        {
            case значення1: 
                блок1;
                break;
            case значення2: 
                блок2; 
                break;
            ... 
            case значення N: 
                блокN; 
                break; 
            default: 
                блок;
                break;
        }
   </code>	
</pre>
</div>");

$cls_Task->_add_step("<div class='container'> Програмний код з використанням оператору вибору може мати такий вигляд:
<pre>
    <code class='cs hljs'>
    private void button1_Click(object sender, EventArgs e)
    {
        int n = int.Parse(textBox1.Text);
        switch (n)
        {
            case 1:
                label2.Text = \"Понеділок\";
                break;
            case 2:
                label2.Text = \"Вівторок\";
                break;
            case 3:
                label2.Text = \"Середа\";
                break;
            case 4:
                label2.Text = \"Четвер\";
                break;
            case 5:
                label2.Text = \"П’ятниця\";
                break;
            case 6:
                label2.Text = \"Субота\";
                break;
            case 7:
                label2.Text = \"Неділя\";
                break;
            default:
                label2.Text = \"Помилка введення!\";
                break;
        }
    }
   </code>	
</pre>
Блок default в даній структурі є не обов’язковим.
</div>");

$cls_Task->_add_step("<p class='container'><b>Тернарний оператор ? :</b></p>");
$cls_Task->_add_step("<div class='container'> Для більш короткого запису команди if – else в мові C# можна використовувати тернарний оператор, який має такий вигляд:
<pre>
    <code class='cs hljs'>
        Умова ? дія1 : дія2;
        int max = a > b ? a : b;
   </code>	
</pre>
</div>");






$cls_Task->_add_step("<p class='container'><b></b></p>");
$cls_Task->_add_step("<p class='container'></p>");

$cls_Task->s_learn_url = "";
$cls_Task->s_youtube_url = "";
$cls_Task->s_discuss_url = "";
//-------------------------------------------------->
//run:
include($s_v_app_root . "t_task.php");
?>