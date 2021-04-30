<h1>Adatok</h1>

<?php

if(!empty($_SESSION['targy'])){

?>
<table border="1px solid black" cellspacing="5px">
<tr><td>Tárgy:</td><td><?php echo $_SESSION['targy']; ?></td></tr>
<tr><td>Üzenet:</td><td><?php echo $_SESSION['msg']; ?></td></tr>
<tr><td>Dátum:</td><td><?php echo $_SESSION['datum']; ?></td></tr>
</table>

<?php
}
else echo "<h2>Itt csak az űrlapon elküldött adatok jelennek meg.</h2>";

?>