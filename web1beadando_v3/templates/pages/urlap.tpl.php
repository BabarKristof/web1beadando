<script>
	/// SPACE ÉS ENTER CSERE KARAKTEREKRE
	function SpacesAndEnters()
	{
		text = document.getElementById('msgSend').value;
		text = text.replace(/  /g, "[sp][sp]");
		text = text.replace(/\n/g, "[nl]");
		document.getElementById('mesg'). value = text;
		return false;
	}
</script>


<h1>Űrlap</h1>
<?php

if(isset($_SESSION['lusername']) && !empty($_SESSION['lusername']) )
	{
						
?>
<h2>Küldjön üzenetet az oldal tulajdonosa számára</h2>

<form action="" method="post" onsubmit="SpacesAndEnters();">
 <table id="t3">
	<tr><td>Tárgy: </td><td><input type="text" name="targy" placeholder="Tárgy" maxlength="50" minlength="3" maxlength="30" required> </td></tr>
	<tr><textarea id ="mesg" name="msg" style="display:none;"></textarea></tr>	
	<tr><td>Üzenet: </td><td><textarea placeholder="Üzenet" id ="msgSend" maxlength="250" class="btn_tight" placeholder="Írja ide hirdetését" minlength="5" maxlength="30" required><?php if(isset($msg)){echo $msg;}?></textarea></td></tr>
    <tr><td colspan="2" align="center"> <input type="submit" value="Küldés" name="urlap_gomb"></td></tr>
  </table>
</form>


<?php

if(isset($_POST['urlap_gomb'])){

	$targy=$_POST['targy'];
	$msg=$_POST['msg'];
	$userid=$_SESSION['rows'];
	$datum=date("y-m-d H:i:s ");
	
	$msg = preg_replace("#\[sp\]#" , "&nbsp;", $msg);
	$msg = preg_replace("#\[nl\]#" , "<br>\n", $msg);
	
$conn = mysqli_connect($servername, $db_username, $db_passwd, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
		

$sql_msg = "INSERT INTO urlap (userid,targy,msg,datum)
VALUES ('$userid','$targy','$msg','$datum')";

if (mysqli_query($conn, $sql_msg)) {
  echo "A levelet elküldtük!";
} 

$_SESSION['targy']=$targy;
$_SESSION['msg']=$msg;
$_SESSION['datum']=$datum;
	

}

}else{
?>
<h2>Az űrlap kitöltéséhez kérem jelentkezzen be</h2>
<?php
	}
?>

