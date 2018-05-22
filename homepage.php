<?php
	session_start();
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body{
			background: linear-gradient(132deg, #9f00c5,#ffff00);
			background-size: 400% 400%;
			animation: BackgroundGradient 10s ease infinite;
		}
		@keyframes BackgroundGradient{
			0%{background-position: 0% 50%;}
			50% {background-position: 100% 50%;}
			100% {background-position: 0% 50%;}
		}

            .button {
                display: block;
                width: 180px;
                height: 60px;
                border: 2px solid #ffffff;
                border-radius: 5px;
                background-color: transparent;
            }
            
            
            .button:active .content {
                bottom: 0;
                box-shadow: 0 0 0 #06c;
            }
	</style>
</head>
<body>

	<center>
			<h1 style="font-family:verdana;color:white;font-size: 50px;">Welcome 
					
		</h1>			<?php echo $_SESSION['username']?>
<br><br><br>

		<form action="homepage.php" method="post"> 
                <h3 style="font-family:verdana;color:white;font-size: 20px";>Write Something here</h3>
                <input name="string" placeholder="Write something" required /><br><br>
                <input name="submit_btn" class="button" type="submit" id="submit_btn" value="Check"/><br><br><br>
          </form>

          <div class="container">
          	<?php include('dbconfig/config.php'); ?>
          	<?php
			if(isset($_POST['uploadBtn'])){
				$fileName=$_FILES['myFile']['name'];
				$fileTmpName=$_FILES['myFile']['tmp_name'];
				$fileExtension=pathinfo($fileName,PATHINFO_EXTENSION);
				$allowedType=array('csv');
				if(!in_array($fileExtension, $allowedType)){
					
					echo'<script type="text/javascript">alert("Invalid file extension")</script>';
				}else{
					$handle=fopen($fileTmpName, 'r');
					while (($myData=fgetcsv($handle,1000,','))!==FALSE) {
						$name=$myData[0];
						$email=$myData[1];
						$phone=$myData[2];
						$query="insert into excel_table values('$name','$email','$phone')";
            			$run=mysqli_query($con,$query);


					}
					if(!$run){
						die("Error in uploading file".mysql_error());
					}else{
						echo'<script type="text/javascript">alert(File uploaded successfully")</script>';
					}
				}
				}				
			?>


          	<form action="" method="post" enctype="multipart/form-data">
          		<hr/><h3 style="font-family:verdana;color:white;font-size: 20px"; class="text-center">
          			Upload your Excel Sheet
          		</h3>
          		<div class="row">
          			<div class="col-md-6">
          			<div class="form-group">
          				<input type="file" name="myFile" class="form-control"><br><br>
          			</div>
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-md-6">
          			<div class="form-group">
          				<input type="submit" name="uploadBtn" class="button"><br><br><br><hr><br><br><br>
          			</div>
          		</div>
          	</div>
          	</form>
          </div>
	
	<form action="index.php" method="post">
			<input name="logout_btn" class="button" type="submit" id="logout_btn" value="Log out"/><br>
			</form>
			</center>


	
	<?php
      if(isset($_POST['submit_btn']))
      {
    	$string=$_POST['string'];
    	$query="insert into stringtable values('$string')";
            $query_run=mysqli_query($con,$query);
    }
    	?>
    	<script type="text/javascript">       
      var string="<?php echo $string; ?>";
      console.log(string);
    </script>

    	


	<?php
			if(isset($_POST['logout_btn']))
			{
			session_destroy();
			header('location:index.php');
			}
		?>
</body>
</html>
