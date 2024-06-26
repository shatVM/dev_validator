<?php
error_reporting(E_ALL); //debug:
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=utf-8'); //utf8 support:
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); //no cache:
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//aux code:
//Отримуємо процент виконання завдання з бази даних
//$_SESSION["vr_percent"] = 
// $var = 0;
$s_task_page = $_SERVER["REQUEST_URI"];
$_SESSION['s_task_page'] = $s_task_page;
//access wall:
if($b_use_access_wall){
  include($s_v_app_root."access_wall.php");
}
if($cls_Task->s_id === ""){
	//Сторінка теорії з порожнім s_id
	//Приховується кнопку відправки завдання та смуга прогресу
	echo "<script>";
    echo "document.addEventListener('DOMContentLoaded', function() {";
    echo "var btnUploadSquare = document.getElementById('btnUploadSquare');";
    echo "if (btnUploadSquare) {";
    echo "btnUploadSquare.style.display = 'none';";
    echo "}";
	echo "var progressbar = document.getElementById('progress');";
    echo "if (progressbar) {";
    echo "progressbar.style.display = 'none';";
    echo "}";
    echo "});";
    echo "</script>";
}else{
	$_SESSION["s_task_id"] = $cls_Task->s_id;
}

//fix rocket flying too far:
// if(isset($_SESSION["vr_percent"])){
//   if($_SESSION["vr_percent"] >= 90){
// 	$s_rocket_css = "hidden";
//   }
// }

?>
<html>
<head>
  <title><?php echo($cls_Task->s_title); ?></title>
  <?php include_once("head_includes.php"); ?>
</head>
<body>
  <div class="container" id="section1">
    <div class="starter-template">
      <div class="jumbotron task_jumbotron_height_fix">
	    <?php include("../../nav_menu.php"); ?>
		<!-- task display code start ---------------------------------------->
		
		<!-- square btn - main uploader --> 
		<div id='btnUploadSquare' class='upload_square_btn' >
			<a href="#section1"><img class='hvr-pulse-grow' src='../../_img/up-arrow.png' onclick=""></a>		
		  <div class='upload_square_btn_upper'></div>
		  <img class='hvr-pulse-grow' src='../../_img/upload-square.png' onclick="$('#fileToUpload').trigger('click');">
		  </img>
		  <div class='upload_square_btn_lower'>Завантажити <br> програму:</div>
		</div>
		<!-- square btn - main uploader --> 

		<!-- square btn - up --> 
		<div class='up_square_btn'>		  
		    
		</div>
		<!-- square btn - up --> 		


		<!-- headers -------------------------------------------------------->
        <h2 class="centered"><?php echo($cls_Task->s_title) . ": " . $cls_Task->s_description; ?></h2>
		
		<!-- progress ----------------------------------------------------->
        <div class="progress">
		  <span class='rocket <?php echo($s_rocket_css); ?>'>
		    <img src='../../_img/rocket.png'>
		    </img>
		  </span>
		  <div class="progress-bar progress-bar-success progress-bar-striped pb-v-progress" role="progressbar" 
		  	aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
			<div class='pb-v-text' id="progress">
			  Твій прогрес:
			  <script type="module">
					import {testGet} from "../../_js/firebaseAuth.js";

					const taskPath = window.location.href;
					// розділяє стрічку по "/" на масив стрічок
					// розділяє стрічку (третій елемент в попередньому масиві) по "_" на масив даних завдання (
					// 0: номер теми завдання
					// 1: названня теми завдання
					// 2: номер конкретного завдання)
					// посилання має зпочатку символ "/", тому першим значеням в масиві буде пуста стрічка
					//console.log(taskPath);
					const tasklets = (taskPath.split('/'))[5].split('_');
					//console.log(tasklets);
					// з'єднує номер та назву теми завдання
					const lessonName = tasklets[0] + "_" + tasklets[1];
					// номер конкретного завдання
					const taskNumber = tasklets[2];
					// назва загального об'єкту в якому вкладені теми завдань 
					const taskedDefaultPath = "tasks"

					//console.log(await testGet(taskedDefaultPath, lessonName, taskNumber))
	  				var percentFromBD = await testGet(taskedDefaultPath, lessonName, taskNumber);
					// this.innerHTML = percentFromBD;
					document.getElementById("progress").innerText += " " + percentFromBD + "%";
					if(percentFromBD < 90){
						document.getElementById("progress").parentElement.style.width = percentFromBD + "%";
					}else{
						document.getElementById("progress").parentElement.style.width = percentFromBD + "%";
						document.querySelector(".rocket").remove();
					}
					


			  </script>
			   
			  <!-- ?php 
			    // if(isset($_SESSION["vr_percent"])){
				// 	//************************** */
				// 	// Створюємо зміну для передачі в JS та виклику функції testSend
				// 	$var = $_SESSION["vr_percent"];
				// 	//************************** */
			    //   echo($_SESSION["vr_percent"]); 
				// }
			    // else{
				//   echo(0);
				// }
			  ?>% -->

			</div>
		  </div>
		</div>
		<!-- validation upload -------------------------------------------->

		<hr>
        <h2 class="centered">Теоретична частина:</h2>
		<br>
		
		<!-- steps ---------------------------------------------------------->
	    <?php
	      foreach ($cls_Task->oa_steps as $s_step){
			if(strpos($s_step, 'youtu.be') !== false){
			  echo("<p class='lead lead-top-fix'>
			          <a href='$s_step' target='_blank'>
			            <img src='../../_img/_watch_on_youtube.png'> Відеодопомога
			            </img>
					  </a>
			       </p>");
			}else{
			  echo("<p class='lead lead-top-fix'>$s_step</p>");
			}
		  }
	    ?>
		<br>
		<!-- help links --------------------------------------------------->
        <div style="text-align: center;"> 
		   <a class="btn btn-info regular_button btn_img1 btn_img_watch btn_help hvr-pulse-shrink" href="<?php echo($cls_Task->s_youtube_url); ?>" role="button" target="_blank"><div class='help_btn_text'>Відеоурок YouTube</div></a>
           <a class="btn btn-info regular_button btn_img1 btn_img_read btn_help hvr-pulse-shrink" href="<?php echo($cls_Task->s_learn_url); ?>" role="button" target="_blank"><div class='help_btn_text'>Читати підручник</div></a>
           
           <a class="btn btn-info regular_button btn_img1 btn_img_discuss btn_help hvr-pulse-shrink" href="<?php echo($cls_Task->s_discuss_url) ?>" role="button" target="_blank"><div class='help_btn_text'>Обговорити</div></a>
        </div>
		<hr>
        <h2 class="centered">Практичне завдання:</h2>
		
		<!-- properties ----------------------------------------------------->
		<?php
		  $i_ctr = 0;
		  foreach ($cls_Task->oa_properties as $cls_property){
		    echo("<tr>");
			//--------------------------------------------------------->
		    // [!main validation feedback from V-Core!] patch with session vars:
			$s_checked = "";
			if(isset($_SESSION["vr_percent"])){
				
				
			  $s_s_title="vr".$i_ctr."_reslt";
			  if(isset($_SESSION[$s_s_title])){
				if($_SESSION[$s_s_title] == true){
				  if($cls_property->b_must_validate == true){
					$cls_property->b_validated = true;
					$s_checked = "checked";
				    $i_ctr++;	    
					$_SESSION[$s_s_title] = "";
				  }
				}
			  }
			}
			//_dbg($cls_property->s_type.":".addslashes($cls_property->s_title).":".addslashes($cls_property->s_master_value).":".$cls_property->b_validated);
			_dbg($cls_property->s_type.":".$cls_property->s_title.":".$cls_property->b_validated);
			//--------------------------------------------------------->
				  
			  switch($cls_property->s_type){
                //--------------------------------------------------------->
			    case "property": //default
                 
			      echo("<td><div class='td_va'>".$cls_property->s_name."</div></td>");
			      echo("<td>".$cls_property->s_title."</td>");
			      echo("<td>".$cls_property->s_master_value."</td>");
                  

	              echo("<td>
				          <div class='chkbox-v-value'>
						    <input type='checkbox' $s_checked data-off-icon-cls='gluphicon-thumbs-down' data-on-icon-cls='gluphicon-thumbs-up'>
							</input>
						  </div>
						</td>");
				  break;
				  //--------------------------------------------------------->
			    case "code_non_validated":
				  echo("<td>$cls_property->s_name</td>");
				  echo("<td colspan='3'>
				          <div onselectstart='return false'>
						    <pre>
							  <code class='cs hljs'>$cls_property->s_master_value
							  </code>
							</pre>
					      </div>
						</td>");
				  break;
				  //--------------------------------------------------------->
			    case "code_validated":
				  echo("<td>$cls_property->s_name</td>");
				  echo("<td colspan='2'>
				          <div onselectstart='return false'>
						    <pre>
							  <code class='cs hljs'>$cls_property->s_master_value
							  </code>
							</pre>
					      </div>
						</td>");
	              echo("<td>
				          <div class='chkbox-v-value'>
						    <input type='checkbox' $s_checked data-off-icon-cls='gluphicon-thumbs-down' data-on-icon-cls='gluphicon-thumbs-up'>
							</input>
						  </div>
						</td>");
				  break;
				  //--------------------------------------------------------->
			    case "youtube":
				  echo("<td>$cls_property->s_name</td>");
				  echo("<td colspan='3'>
				          <div class='youtube'>
						    <a href='$cls_property->s_master_value'>
						      <img src='../../_img/'>
							  </img>
							  $cls_property->s_name
							</a>
					      </div>
						</td>");
                  break;
				  //--------------------------------------------------------->
			    case "screen":
				  echo("<td>$cls_property->s_title</td>");
				  echo("<td colspan='3'>
				          <div class='screen'>
						    <img class='f_img' src='$cls_property->s_master_value'>
							</img>
					      </div>
						</td>");
                  break;
				  //--------------------------------------------------------->
				case "obj_creator":
				  echo("<td>$cls_property->s_name</td>");
				  echo("<td colspan='3'>$cls_property->s_title</td>");
				  break;
				  //--------------------------------------------------------->
				case "block_start":
				  _table_start("<span>
				                  <img class='property_type_img' src='../../_img/$cls_property->s_title'>
								   </img>
								   <span class='app_specs_text'>$cls_property->s_master_value
								   </span>
							    </span>");
				  break;
				  //--------------------------------------------------------->
				case "block_end":
				  _table_end();
				  break;
				  //--------------------------------------------------------->
			  }
			  //zero:
			  $cls_property->s_master_value = "";
			  $cls_property->b_validated = false;
			  
			echo("</tr>");
          }
		  _table_end();
		  echo("</div>")
		?>
		
		<div class="container hidden">
		  <div class="row">
			<div class="col-md-2">
			  <div class='check_btn_label'>Перевірка:</div>
			</div>
			<div class="col-md-8">
			<form id='upload_file' class='upload_file' action="..\..\validator_fe.php" method="post" enctype="multipart/form-data">
			  <label class="btn btn-success btn-block btn-lg">
				Вибрати файл програми для валідації<input type="file" hidden id="fileToUpload" accept=".exe" name="fileToUpload">
			  </label>
			  <input type="hidden" name="codefile" value="<?php echo($cls_Task->s_id) ?>"/><!-- task id -->
			</form>
			</div>
			<div class="col-md-4">
			  
			</div>
		  </div>
		</div>
		
		<!--
		  <div class='footer_spacer'></div>
		-->

    </div>
  </div>
</div>
	




<!-- js ------------------------------------------------->
<script type="module">
  $('#fileToUpload').change(function(){
    $('#upload_file').submit();
	exit;
  });
  //<!-- Initialize checkboxpicker -->
  $(':checkbox').checkboxpicker();
  //<!-- Initialize highlight -->
  hljs.initHighlightingOnLoad();
	//---------------------------------------------------------------
  	import {testSend, testGet} from "../../_js/firebaseAuth.js";
  	//Зчитування проценту з бази даних

 //Визначення назви уроку та номеру завдання 	
  //---------------------------------------------------------------
  	const taskPath = window.location.href;
	const percent =
	<?php if(isset($_SESSION["vr_percent"])){
		echo $_SESSION["vr_percent"];
	}else{
		echo("undefined");
	} ?>;
	// розділяє стрічку по "/" на масив стрічок
	// розділяє стрічку (третій елемент в попередньому масиві) по "_" на масив даних завдання (
	// 0: номер теми завдання
	// 1: названня теми завдання
	// 2: номер конкретного завдання)
	// посилання має зпочатку символ "/", тому першим значеням в масиві буде пуста стрічка
	const tasklets = (taskPath.split('/'))[5].split('_');
	// // з'єднує номер та назву теми завдання
	const lessonName = tasklets[0] + "_" + tasklets[1];
	// // номер конкретного завдання
	const taskNumber = tasklets[2];
	// // назва загального об'єкту в якому вкладені теми завдань 
	const taskedDefaultPath = "tasks"

	// var percentFromBD = await testGet(taskedDefaultPath, lessonName, taskNumber)
  	// console.log(percentFromBD);
	// // для того, щоб оновити конкретне значення в вкладеному об'єкті,
	// // потрібно вказати шлях до значення через крапку ("tasks.01_Form.00")
	// // для того щоб, посилати змінні в назву значення в цьому об'єкті,
	// // усю назву потрібно закрити в "[]" (приклад:
	// // ["theObjectName" + "theNestedObject" + "propertyName")
	//console.log(percent);
	const taskedPath = { [`${taskedDefaultPath}.${lessonName}.${taskNumber}`]: percent }
	// const omegaTaskedPath = theTaskToUpdate(taskPath, 3, "tasks", percent);
	if(percent !== undefined && percent !== 0){
		testSend(taskedPath);
	}
  	
	
	// function theTaskToUpdate(thePath, thePlaceInPath, theTaskOutObj, result){
	// 	// thePath - стрічка шляху до завдання
	// 	// thePlaceInPath - місце назви завдання в шляху (число для масиву)
	// 	// theTaskOuObj - Об'єкт, якому вкладені усі теми завданнь
	// 	// result - результат завдання

	// 	// розділяє стрічку по "/" на масив стрічок
	// 	// розділяє стрічку (третій елемент в попередньому масиві) по "_" на масив даних завдання (
	// 	// 0: номер теми завдання
	// 	// 1: названня теми завдання
	// 	// 2: номер конкретного завдання)
	// 	// посилання має зпочатку символ "/", тому першим значеням в масиві буде пуста стрічка
	// 	const tasklets = (thePath.split('/'))[thePlaceInPath].split('_');

	// 	// з'єднує номер та назву теми завдання
	// 	const lessonName = tasklets[0] + "_" + tasklets[1];

	// 	// номер конкретного завдання
	// 	const taskNumber = tasklets[2];

	// 	// для того, щоб оновити конкретне значення в вкладеному об'єкті,
	// 	// потрібно вказати шлях до значення через крапку ("tasks.01_Form.00")
	// 	// для того щоб, посилати змінні в назву значення в цьому об'єкті,
	// 	// усю назву потрібно закрити в "[]" (приклад:
	// 	// ["theObjectName" + "theNestedObject" + "propertyName")
		
	// 	// повертає результат
	// 	return  { [`${theTaskOutObj}.${lessonName}.${taskNumber}`]: result }
	// }
	//   console.log(taskPath);
	  
	//---------------------------------------------------------------

  	// ***************************************************************
	// виклик функції для зміни в базі даних
  	// var percent = '';
  	// ***************************************************************

<?php
//show completed window on 100%:
if(isset($_SESSION["vr_percent"])){
  if($_SESSION["vr_percent"] == 100){
    //destory session vars with validation results:
    //show completed screen:
    //echo("$('#myModalSuccess').modal('show');");
    echo("$('#myModal').modal('show');");
  }
  //zero the score to prevent new modal screen:
  $_SESSION["vr_percent"] = "0";
}
?>
  
</script>

<!-- js ------------------------------------------------->

<?php
if($_SESSION["b_debug"] == true){
  echo("<pre>");
  var_dump($_SESSION);
  echo("</pre>");
}
?>

</body>

	<!--Google auth-->
	<script type="module" src="../../_js/firebaseAuth.js"></script>
	


<?php
function _table_start($tbl_title){
  $s_data = "<table class='table table-striped table-bordered'>
        <caption class='app_specs' align='top'>$tbl_title</caption>
          <thead >
            <tr >
              <th>Properties:</th>
              <th>Властивість:</th>
              <th>Значення:</th>
              <th>Валідація:</th>
            </tr>
          </thead>
          <colgroup>
            <col style='width:20%'>
            <col style='width:30%'>
            <col style='width:30%'>
            <col style='width:10%'>
         </colgroup>";
  echo($s_data);
}
function _table_end(){
  $s_data = "</table>";
  echo("$s_data");
}

?>

</html>