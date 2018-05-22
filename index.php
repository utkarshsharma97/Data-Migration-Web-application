<?php
  require 'dbconfig/config.php';
  session_start();
?>
<html>
    <head>
        <link href="Main.css" rel="stylesheet"/>
        <script src="jquery-1.10.2.min.js"></script>
        <script src="JQUERY%20Main.js"></script>
    </head>
    <body  background="ongcimg.jpg">
        <br><br>
        <h2>ONGC</h2>
        <div id="box">
            <div id="main"></div>
           
           <form action="index.php" method="post"> 
            <div id="loginform" method="post">
                <h1>LOGIN</h1>
                <input name="username" type="email" placeholder="Email" required /><br>
                <input name="password" type="password" placeholder="Password" required/><br><br>
                <input name="submit_btn2" type="submit" id="submit_btn2" value="Log in"/>
            </div>
          </form>
        

            <form action="index.php" method="post">
            <div id="signupform"method="post">
                <h1>SIGN UP</h1>
                <input name="fullname" type="text" placeholder="Full Name" required/><br>
                <input name="username" type="email" placeholder="Email" required/><br>
                <input name="password" type="password" placeholder="Password" required/><br><br>
                <input name="submit_btn1" type="submit" id="submit_btn1" value="Sign up"/>
                </div>
            </form>

            
            
            <div id="login_msg">Have an account?</div>
            <div id="signup_msg">Don't have an account?</div>
            
            <button id="login_btn">LOGIN</button>
            <button id="signup_btn">SIGN UP</button>
            <script>
for(var x=0;x<=16;x++){
document.write("<br>")
}
</script>       
            <center><img src="ongclogo.jpg" alt="logo" style="width:128px;height:128px;"></center>
            <script>document.addEventListener('DOMContentLoaded',function(event){
  // array with texts to type in typewriter
  var dataText = [ "ongc summer internship 2018", "Vidushi","Manisha","Utkarsh","Data Migration"];
  
  // type one text in the typwriter
  // keeps calling itself until the text is finished
  function typeWriter(text, i, fnCallback) {
    // chekc if text isn't finished yet
    if (i < (text.length)) {
      // add next character to h2
     document.querySelector("h2").innerHTML = text.substring(0, i+1) +'<span aria-hidden="true"></span>';

      // wait for a while and call this function again for next character
      setTimeout(function() {
        typeWriter(text, i + 1, fnCallback)
      }, 100);
    }
    // text finished, call callback if there is a callback function
    else if (typeof fnCallback == 'function') {
      // call callback after timeout
      setTimeout(fnCallback, 700);
    }
  }
  // start a typewriter animation for a text in the dataText array
   function StartTextAnimation(i) {
     if (typeof dataText[i] == 'undefined'){
        setTimeout(function() {
          StartTextAnimation(0);
        }, 20000);
     }
     // check if dataText[i] exists
    if (i < dataText[i].length) {
      // text exists! start typewriter animation
     typeWriter(dataText[i], 0, function(){
       // after callback (and whole text has been animated), start next text
       StartTextAnimation(i + 1);
     });
    }
  }
  // start the text animation
  StartTextAnimation(0);
});</script>


    <?php
      if(isset($_POST['submit_btn1']))
      {
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query="select * from userinfotable WHERE username='$username'";
    $query_run=mysqli_query($con,$query);
    if(mysqli_num_rows($query_run)>0)
          {
            
            echo '<script type="text/javascript">alert("User already exists. Try another username")</script>';
          }
          else
          {
            $query="insert into userinfotable values('$fullname','$username','$password')";
            $query_run=mysqli_query($con,$query);
            
            if($query_run)
            {
              echo '<script type="text/javascript">alert("User registered. Go to login page to login")</script>';
            }
            else
            {
              echo '<script type="text/javascript">alert("Error!")</script>';
            }
          }
        }
    ?>
<?php
    if(isset($_POST['submit_btn2']))
    {
      $username=$_POST['username']; 
      $password=$_POST['password'];
      
      $query="select * from userinfotable WHERE username='$username' AND password='$password'";
      
      $query_run=mysqli_query($con,$query);
      if(mysqli_num_rows($query_run)>0)
      {
        //valid
        $_SESSION['username']=$username;
        
        header('location:homepage.php');
      }
      else
      {
        //invalid
        echo '<script type="text/javascript">alert("Invalid credentials")</script>';
      }
    }
    
    ?>

     
        </div>
    </body>
</html>
