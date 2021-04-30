

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title><?= $ablakcim['cim'] . ( (isset($ablakcim['mottó'])) ? ('|' . $ablakcim['mottó']) : '' ) ?></title>
	<link rel="stylesheet" href="./stylus/stilus.css" type="text/css"/>
	<?php if(file_exists('./styles/'.$keres['fajl'].'.css')) { ?><link rel="stylesheet" href="./stylus/<?= $keres['fajl']?>.css" type="text/css"><?php } ?>
</head>
<body>

    <div id="menu">
        <aside id="nav">
            <nav>
                <ul>
					<?php foreach ($oldalak as $url => $oldal) { ?>
						<li<?= (($oldal == $keres) ? ' class="active"' : '') ?>>
						<a href="<?= ($url == '/') ? '.' : ('?oldal=' . $url) ?>">
						<?= $oldal['szoveg'] ?></a>
						</li>
					<?php } ?>
				
					
					<?php if(isset($_SESSION['lusername']) && !empty($_SESSION['lusername']) )
					{
					?>
					<li><a href="logout.php">Kilépés</a><li>
					<?php }else{ ?>
					<li><a href="login_page.php">Bejelentkezés</a></li>
					<?php }  ?>
					
					<?php
					if( isset($_SESSION['lusername']) && !empty($_SESSION['lusername']) ){
					?>
					<li><a>
					<?php 	
					echo $_SESSION['success'];				
					?>
					</a></li>
					<?php
					}		
           				?>
					
		
			 </ul>
           </nav>
		   
        </aside>
		
        <div id="">
            <?php include("./templates/pages/{$keres['fajl']}.tpl.php"); ?>
        </div>
    </div>

</body>
</html>
