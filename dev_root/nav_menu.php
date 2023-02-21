<?php
$cur_dir_fp = explode('\\', getcwd());
$cur_dir_title = $cur_dir_fp[count($cur_dir_fp)-1];
$countUp ='';
//вихід на певну кількість кроків з директорії для доступу до зображення логотипа
for ($i = 0; $i < count($cur_dir_fp)-4; $i++ ){
  $countUp = '../'. $countUp;
}
$s_rip =$countUp."_img/c-sharp-logo4.png";

//$s_rip = $s_domain."/validator/_img/c-sharp-logo4.png";
?>


<div class="navbar navbar-default " role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Відкрити навігатор</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">С# Валідатор</a> -->
    </div>
	
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
	    <img class='nav-logo' alt="C#" src='<?php echo($s_rip); ?>' />
        <li><a href="/">Головна</a></li>
        <li><a href="/validator/index.php">Всі завдання</a>
        <li><a href="#" id="rank" class="btn-info" type="button" data-toggle="modal" data-target="#myModalRank">Рейтинг </a></li>
        <li><a href="#" id="userName" data-toggle="modal" data-target="#myModal">Невідомий користувач</a>
        </li>
        <li><a href="#" id="loginBtn" class=" btn-info" type="button">Увійти </a></li>
        <li>
          <a href="#" id="btnReg" type="button" class="btn-info" data-toggle="modal" data-target="#myModalReg">Зареєструватися</a>  
          <!-- <a href="#"  class=" btn-info" style="margin-left: 100px" type="button" data-target="#myModalReg">Зареєструватися</a> -->
        </li>
        
        


		<!-- <li><a href="/validator/progress_chart.php">Графік успіху</a></li> -->
		
        
      </ul>
	  <!-- test trigger  для відображення модального вікна-->
    <!-- за потрібне вікно відповідає data-target="#myModalReg" -->
    <!-- <a href="#" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalReg" style="margin-left: 150px">Зареєструватися</a>  -->

<!-- modal USERRESULT msg start ------------------------------------>
<div class="container">
  <div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog">
        
      <!-- content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="userNameModal">Користувач:</h4>
        </div>
        <div class="modal-body modal-task-complete">
        <div class="user-result " id="userResult">
        
        </div>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-info" data-dismiss="modal" onclick="location.href='../../index.php';">Всі завдання</button>
		  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick='history.go(1);'>Закрити</button>
        </div>
      </div>
   
    </div>
  </div>
  
</div>
<!-- modal USERRESULTmsg end -------------------------------------->

<!-- modal REGISTRATION msg start ------------------------------------>
<div class="container">
  <div class="modal fade" id="myModalReg" role="dialog">

    <div class="modal-dialog">
        
      <!-- content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="">Реєстрації:</h4>
        </div>
        <div class="modal-body modal-task-complete">
        <div class="user-result " id="userReg">
        
          <select id="regClass" style="block">
            <option value="11-А">11-А</option>
            <option value="11-Б">11-Б</option>
            <option value="11-В">11-В</option>
            <option value="11-Г">11-Г</option>
          </select>
        <p>Після реєстрації увійдіть на сайт!</p>
        </div>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-info" data-dismiss="modal" id="signUpBtn">OK</button>
		  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick='history.go(1);'>Закрити</button>
        </div>
      </div>
   
    </div>
  </div>
  
</div>
<!-- modal REGISTRATION msg end -------------------------------------->

<!-- modal SUCCESS msg start ------------------------------------>
<div class="container">
  <div class="modal fade" id="myModalSuccess" role="dialog">
    <div class="modal-dialog">
    
      <!-- content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Вітаємо із маленькою перемогою!</h4>
        </div>
        <div class="modal-body modal-task-complete">
		  <div class='task-completed-img'><img src='../../_img/task-completed.png' /></div>
          <div>Завдання виконано на 100%!</div>
		  <div>Програмуй наступне!</div>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-info" data-dismiss="modal" onclick="location.href='../../index.php';">Всі завдання</button>
		  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick='history.go(1);'>Закрити</button>
        </div>
      </div>
   
    </div>
  </div>
  
</div>
<!-- modal SUCCESS msg end -------------------------------------->

<!-- modal RANK msg start ------------------------------------>
<div class="container">
  <div class="modal fade" id="myModalRank" role="dialog">
    <div class="modal-dialog">
    
      <!-- content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Рейтинг</h4>
        </div>
        <div class="modal-body modal-task-complete">
		  <div class='task-completed-img'><img src='../../_img/task-completed.png' /></div>
          <div>Завдання виконано на 100%!</div>
		  <div>Програмуй наступне!</div>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-info" data-dismiss="modal" onclick="location.href='../../index.php';">Всі завдання</button>
		  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick='history.go(1);'>Закрити</button>
        </div>
      </div>
   
    </div>
  </div>
  
</div>
<!-- modal RANK msg end -------------------------------------->

	  <!--
	  <?php if(isset($_SESSION["s_user_email"])) : ?>
      <ul class="nav navbar-nav navbar-right">
	    <li><a href="<?php echo($s_domain."/validator/logout.php"); ?>">
	      Вийти
	    </a></li>
      </ul>
	  
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">
		<?php 
		  echo("Вітаємо, ".$_SESSION["s_user_name"]."!");
		?>
		</a></li>
      </ul>
	  <?php endif; ?>
	  -->
	  
    </div>

  </div>
</div>