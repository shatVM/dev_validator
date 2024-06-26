﻿﻿<?php
session_start();
//utf8 support:
header('Content-Type: text/html; charset=utf-8');
include_once("main_config.php");
?>
<html>

<head>
  <!-- title -->
  <title>Завдання:</title>
  <!-- utf8 support: -->
  <?php
  include_once("head_includes.php");
  ?>
  <!-- external CSS: -->
  <!-- <link rel="stylesheet" type="text/css" href="_css/global.css"> -->
</head>

<body>
  <div class="container">
    <div class="starter-template">
      <div class="jumbotron task_jumbotron_height_fix">

        <!-- menu stat: -->
        <?php
        include("nav_menu.php");
        ?>
        <!-- menu end: -->

        <!-- header info block start: -->
        <?php
        include("header.php");
        ?>
        <!-- header info block end: -->

        <hr>
        <h2>Доступні завдання:</h2>

        <div class="panel-group" id="collapse-group">

          <!-- task Lesson_00 block start -->
          <?php
          include("tasks_list/00_Lesson.php");
          ?>

          <!-- task 01_Lesson block start -->
          <?php
          include("tasks_list/01_Lesson.php");
          ?>

          <!-- task 02_Lesson block start -->
          <?php
          include("tasks_list/02_Lesson.php");
          ?>

          <!-- task 03_Lesson block start -->
          <?php
          include("tasks_list/03_Lesson.php");
          ?>

           <!-- task 04_Lesson block start -->
           <?php
          include("tasks_list/04_Lesson.php");
          ?>

          <!-- task 05_Lesson block start -->
          <?php
          include("tasks_list/05_Lesson.php");
          ?>

          <!-- task 06_Lesson block start -->
          <?php
          include("tasks_list/06_Lesson.php");
          ?>

          <!-- task 07_Lesson block start -->
          <?php
          include("tasks_list/07_Lesson.php");
          ?>

          <!-- task 08_Lesson block start -->
          <?php
          include("tasks_list/08_Lesson.php");
          ?>

          <!-- task 09_Lesson block start -->
          <?php
          include("tasks_list/09_Lesson.php");
          ?>

          <!-- task Season_01 block start -->
          <?php
          include("tasks_list/00_Seasons.php");
          ?>

          <!-- task Forms block start -->
          <?php
          include("tasks_list/11_Form.php");
          ?>

          <!-- task Event block start -->
          <!-- <?php
          include("tasks_list/12_Event.php");
          ?> -->

          
          <!-- task 03_Button block start -->
          <?php
          include("tasks_list/13_Button.php");
          ?>

         

          <!-- task Label block start -->
          <?php
          include("tasks_list/14_Label.php");
          ?>

          <!-- task TextBox block start -->
          <?php
          include("tasks_list/15_TextBox.php");
          ?>

          <!-- task PictureBox block start -->
          <?php
          include("tasks_list/17_PictureBox.php");
          ?>

          <!-- task Graphics block start -->
          <?php
          include("tasks_list/29_Graphics.php");
          ?>

          <!-- task Math block start -->
          <?php
          include("tasks_list/26_Math.php");
          ?>

          <!-- task Phisics block start -->
          <?php
          include("tasks_list/27_Physics.php");
          ?>

        </div>

        <!-- help block start -->

        <a class="btn btn-info btn-lg btn-block"
          href="https://docs.google.com/document/d/1T8I-HevkhMQY_aLrZXjiMH2FOfuQ-tVGnf5RUuqdLq0/edit?usp=sharing"
          role="button" target="_blank">Читати навчальний матеріал</a>
        <a class="btn btn-info btn-lg btn-block"
          href="https://www.youtube.com/playlist?list=PLgNmtqlNFVjpYzErepZF2E8Mc4R27yXYf" role="button"
          target="_blank">Переглянути відеоуроки</a>
        <a class="btn btn-info btn-lg btn-block" href="http://informatics.in.ua/" role="button" target="_blank">Сайт
          Інформатика в школі</a>
        <!-- help block end -->

      </div>
    </div>
  </div>
</body>

<!--Google auth-->
<script type="module" src="_js/firebaseAuth.js"></script>
<!--Google Firestore-->
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-firestore.js"></script>


</html>