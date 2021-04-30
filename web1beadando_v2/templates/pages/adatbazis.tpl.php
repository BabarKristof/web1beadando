<h1>Adatbázis</h1>
<h2>Itt az eddig írt üzenetek jelennek meg, fordított időrendben</h2>
 
 
 <?php

 
if(!empty($_SESSION['rows'])){
$aktiv_user=$_SESSION['rows'];

 $query_adatok = "SELECT username,targy,msg,datum FROM urlap INNER JOIN felhasznalok
			ON felhasznalok.id=urlap.userid 
			WHERE felhasznalok.id=urlap.userid AND felhasznalok.id='$aktiv_user' ORDER BY datum DESC";

    if($result = mysqli_query($conn, $query_adatok)){
   
   if(mysqli_num_rows($result) > 0){
        echo "<table border='1px solid black' id='t4'>";
            echo "<tr>";
                echo "<th>Felhasználónév</th>";
                echo "<th>Tárgy</th>";
                echo "<th >Üzenet</th>";
                echo "<th>Dátum</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td >" . $row['username'] . "</td>";
                echo "<td>" . $row['targy'] . "</td>";
                echo "<td>" . $row['msg'] . "</td>";
                echo "<td>" . $row['datum'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "Ön még nem küldött üzenetet.";
    }
		
} else echo "<h2>Az üzenetek megtekintéséhez kérjük jelentkezzen be</h2>";
}
?>