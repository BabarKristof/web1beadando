<script>
function validateForm() {
  var a = document.forms["regForm"]["fname"].value;
  var b = document.forms["regForm"]["secname"].value;
  var c = document.forms["regForm"]["username"].value;
  var d = document.forms["regForm"]["password"].value;
  var e = document.forms["regForm"]["email"].value;
  if (a == "" || b == "" || c == "" || d == "" || e == "") {
    var err="Töltse ki az összes mezőt!(javascript error)";
	document.getElementById("jserror").innerHTML = err;
    return false;
  }
}
</script>

<table border="0" align="center" cellpadding="0" cellspacing="0" width="300" onsubmit="return validateForm()">
<tr>
    <td>
		<?php

		?>
        <form method="post" action="login_page.php" name="regForm">
            <table width="100%" cellpadding="7" cellspacing="0" border="0">
                <tr>
                    <td colspan="3"><center><strong>Regisztráció</strong></center><br /></td><br />
                </tr>
                <tr>
                <td width="30%">Családnév</td>
                <td width="10%">:</td>
                <td width="60%"><input type="text" name="fname" minlength="2" maxlength="10"/></td>
                </tr>
				<tr>
                <td width="30%">Utónév</td>
                <td width="10%">:</td>
                <td width="60%"><input type="text" name="secname" minlength="2" maxlength="10"/></td>
                </tr>
				<tr>
                <td width="30%">Felhasználónév</td>
                <td width="10%">:</td>
                <td width="60%"><input type="text" name="username" /></td>
                </tr>
                <tr>
                <td width="30%">Jelszó</td>
                <td width="10%">:</td>
                <td width="60%"><input type="password" name="password" /></td>
                </tr>
                <tr>
                <td width="30%">Email</td>
                <td width="10%">:</td>
                <td width="60%"><input type="email" name="email" /></td>
                </tr>
                <tr>
                <td colspan="3"><center><button name="submit">Regisztráció</button></center><br /></td>
                </tr>
            </table>
        </form>
    </td>
</tr>
</table>



<table border="0" align="center" cellpadding="0" cellspacing="0" width="300">
<tr>
    <td>
        <form method="post" action="login_page.php">
            <table width="100%" cellpadding="7" cellspacing="0" border="0">
                <tr>
                    <td colspan="3"><center><strong>Belépés</strong></center><br /></td><br />
                </tr>
                <tr>
                <td width="30%">Felhasználónév</td>
                <td width="10%">:</td>
                <td width="60%"><input type="text" name="l_username" /></td>
                </tr>
                <tr>
                <td width="30%">Jelszó</td>
                <td width="10%">:</td>
                <td width="60%"><input type="password" name="l_password" /></td>
                </tr>
                <tr>
                <td colspan="3"><center><button name="login">Belépés</button></center><br /></td>
                </tr>
				<tr>
				  <td colspan="3"><center><button name="abort">Mégsem</button></center><br /></td>
				</tr>
            </table>
        </form>
    </td>
</tr>
</table>

<div id="jserror"/>	



<?php
session_start();
include('./includes/dbConn.tpl.php');
$errors = array(); 



///////////Register//////////////////
if(isset($_POST['submit'])){
	
	$fname=$_POST['fname'];
	$secname=$_POST['secname'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	
$password = md5($password);

$hibak = array();

$conn = mysqli_connect($servername, $db_username, $db_passwd, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$query_test="SELECT username FROM felhasznalok WHERE username='$username'";
        $result_test = mysqli_query($conn, $query_test);
        if (mysqli_num_rows($result_test) == 1) {
			echo "Ez a felhasználónév már foglalt";
		}else{
	
///karakterhiba	
$re = '/[^Á-Űá-űA-Za-z0-9]/m';	
	if(preg_match_all($re, $fname, $kar_hiba, PREG_SET_ORDER, 0) 
		|| 	preg_match_all($re, $secname, $kar_hiba, PREG_SET_ORDER, 0) 
		|| preg_match_all($re, $username, $kar_hiba, PREG_SET_ORDER, 0) 
		|| preg_match_all($re, $password, $kar_hiba, PREG_SET_ORDER, 0)
		){      
			$hibak[] = "Karakter hiba:regisztráció";  
      }


if (empty($fname)|| empty($secname) || empty($username) || empty($password) || empty($email)){
		 $hibak[] = "Töltse ki az összes mezőt";		

}
	
	if(strlen($username) < 8 || strlen($username) > 20 ){
		$hibak[] = "A név legyen minumum 8, maximum 30 karakter!";
	} 
	if(strlen($password) < 8 || strlen($password) > 60 ){
		$hibak[] = "A jelszó legyen minumum 8, maximum 30 karakter!";
	} 
	



foreach ($hibak as $key => $values){	
		echo "".$values."<br>";
    }

if(count($hibak)==0){
$sql = "INSERT INTO felhasznalok (fname,secname,username, password, email) VALUES ('$fname','$secname','$username','$password','$email')";

if (mysqli_query($conn, $sql) ) {
  echo "Sikres regisztráció. Köszöntünk oldalunkon ".$username.". Jelentkezz be!";
}
} else echo "Sikertelen regisztráció";

mysqli_close($conn);
		}
}
////////////////Login////////////////////

if(isset($_POST['login'])){
	

	
	$lusername=$_POST['l_username'];
	$lpassword=$_POST['l_password'];



$conn = mysqli_connect($servername, $db_username, $db_passwd, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}	
  //SQL injection ellen
    $lusername = mysqli_real_escape_string($conn, $_POST['l_username']);
    $lpassword = mysqli_real_escape_string($conn, $_POST['l_password']);
   
    // Üres mezők
    if (empty($lusername)) {
        array_push($errors, "Felhasználónév megadása kötelező");
    }
    if (empty($lpassword)) {
        array_push($errors, "Jelszó megadása kötelező");
    }
   
    // Hibák ellenőrzése sql utasítás előtt
    if (count($errors) == 0) {
          
		$lpassword = md5($lpassword);
          
        $query = "SELECT * FROM felhasznalok WHERE username=
                '".$lusername."' AND password='".$lpassword."'";
        $results = mysqli_query($conn, $query);
   

        if (mysqli_num_rows($results) == 1) {
              
            $_SESSION['lusername'] = $lusername;
              
			 $row = mysqli_fetch_row($results);

			 
			$mssg=" ".$row[1]." ".$row[2]." (".$row[3].")";
			$msg_id=$row[0];

            $_SESSION['success'] = $mssg;
			$_SESSION['rows']=$msg_id;  
			header("Location:index.php");
	}
	
	
	
	else echo "Hibás belépési adatok";
	}

}

if(isset($_POST['abort'])){
	header("Location:index.php");
	
}





?>