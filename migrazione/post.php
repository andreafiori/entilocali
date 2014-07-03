<?php

require_once("setup_database.php");

/**
 * @since  03 July 2014
 * @author Andrea Fiori
 */
function showAlertMessage($title, $message, $type='danger')
{
?>
<div class="alert alert-<?php echo $type ?>">
	<h1><?php echo $title ?></h1>
	<p><?php echo $message ?></p>
</div>
<?php
}


switch($_GET['op'])
{
	default:
		?>
		<div class="alert alert-danger">
			<h1>Errore</h1>
			<p>Richiesta non valida</p>
		</div>
		<?php
	break;
	
	case("config"):
		try {
			$result = R::getAll("SELECT * FROM config");
			if ($result) {
				$result = R::getAll("SELECT * FROM zfms_config");
				
			} else {
				showAlertMessage('Errore vecchio CMS', 'Tabella vecchio CMS vuota o non presente nel database');
			}
		} catch(Exception $ex) {
			showAlertMessage('Errore vecchio CMS', 'Tabella vecchio CMS vuota o non presente nel database');
		}
	break;
	
	case("users"):
		$result = R::getAll("SELECT * FROM utenti");
		if ($result) {
			
		} else {
			showAlertMessage();
		}
	break;
	
	case("modules"):
	
	break;
	
	case("stato-civile"):
	
	break;
	
	case("albo-pretorio"):
	
	break;
	
	case("amministrazione-trasparente"):
	
	break;
	
	case("contratti-pubblici"):
	
	break;
	
	case("contenuti"):
		// from contenuti to posts...
	break;
	
	case("foto"):
	
	break;
	
	case("blogs"):
	break;
	
	case("forum"):
	
	break;
	
	case("newsletter"):
		?>
		<div class="alert alert-warning">
			<h1>In costruzione</h1>
			<p>Migrazione dati in fase di sviluppo...</p>
		</div>
		<?php
	break;
}
