<?php

session_start();
ini_set("display_errors",false);
$percorso_sito = 'http://www.cmskronoweb.it/telti';
if(($_POST['uscita']==1))
{
unset($_SESSION['cms']);
header("Location: $percorso_sito/index_ingresso.php");
}

echo'<div style="text-align:center; padding: 1%; background-color: #faffaf; margin-bottom: 10px;">';
echo'Visualizzazione demo del cms kronoweb enti locali Comune di Telti';
echo'<form action="" method="post">';
echo'<div style="margin:auto;">';
echo'<input type="hidden" name="uscita" value="1" />
<input type="image" title="Logout" value="Logout" src="'.$percorso_sito.'/login.png" />';
echo'</div>';
echo'</form>';
echo'</div>';

if(!$_SESSION['cms'])
header("Location: $percorso_sito/index_ingresso.php");
else
{
include'index_inclusa.php';
}

?>