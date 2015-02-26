<?php
ini_set("display_errors",false);
session_start();
include'pswd.php';
if(($_POST['vai_a_backend']==1))
{
		if(!$_POST['entraci'])
		{
		$msg = '<div style="padding: 5px 10px; color: red;">Devi inserire una keyArea</div>';
		}
		else 
		{
		if($_POST['entraci']!=$password)
				$msg = '<div style="width: 100%; text-align: center; margin: auto; padding: 5px 10px; color: red;">KeyArea errata</div>';
		else
		{
				if($_POST['entraci']==$password)
				{
				$backend_si = TRUE;
				$_POST['entraci_key'] = $_POST['entraci'];
				$_SESSION['entraci_key'] = $_POST['entraci_key'];
				$_SESSION['vai_a_backend'] = $_POST['vai_a_backend'];
       		    #indirizza al backend dopo che si è premuto il tasto di login in front
				echo $_SESSION['vai_a_backend'];
				echo $_SESSION['cms'] = 'visualizza';
				$backend = './';
				#$msg = '<div style="font-size: 20px; padding: 5px 10px; "><a style="color: green; text-decoration: none;" href="'.$backend.'" title="Entra nel Sito: '.$backend.'" onclick="window.open(this.href); return false;">Entra nel Sito</a></div>';
				header("Location: ".$backend);
		
}		
				}
		}
}
else 
$msg = '';

echo'<div style="text-shadow: 0px 1px 0px #dddddd; font: 13px/1.231 trebuchet ms, helvetica,sans-serif; width: 402px; text-align: center; margin: 120px auto; padding: 1%; box-shadow: 1px 1px 0px #ffffff inset, 0px 1px 4px #a2a2a2, 2px 1px 1px #EDEEEF; border-radius: 5px;">';
echo'AREA CMS KRONOWEB ENTI LOCALI<br /><br />';
				if($backend_si == FALSE)
				{
				  echo'<div id="box_form">';
				  echo'<form action="" method="post">';
				  echo'<div style="padding: 5px 0px;">KEYAREA:</div>
						<div><input style="border: 1px solid #BBBEC0; border-radius: 3px; text-align:center;" type="password" maxlength="10" size="10" name="entraci" /></div>
						<div style="margin:auto;">';
				  echo'<input type="hidden" name="vai_a_backend" value="1" />
						<input type="image" title="Login" value="Login" src="login.png" />';
				  echo'</div>
						</form>';
   				echo '</div>';
				}
echo $msg;
	echo '</div>';

?>