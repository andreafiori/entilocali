<?php

/**
 * Kronoweb CMS Enti locali \ Aziende. Tool di migrazione dati da precedente CMS
 * 
 * @since  02 July 2014
 * @author Andrea Fiori
 */
 
 require_once("setup_database.php");

$migrationButtons = array(

    'users' => array(
        'formId'     => 'userFormMigration',
        'formAction' => '?op=users',
        'buttonId'   => 'userMigrationButton',
        'buttonLabel' => 'Utenti',
    ),

    'config' => array(
        'formId'      => 'configurationFormMigration',
        'formAction'  => '?op=config',
        'buttonId'    => 'configurationMigrationButton',
        'buttonLabel' => 'Configurazioni',
    ),

    'modules' => array(
        'formId'      => 'modulesFormMigration',
        'formAction'  => '?op=modules',
        'buttonId'    => 'modulesMigrationButton',
        'buttonLabel' => 'Moduli',
    ),

    'stato-civile' => array(
        'formId'      => 'statocivileFormMigration',
        'formAction'  => '?op=stato-civile',
        'buttonId'    => 'statocivileMigrationButton',
        'buttonLabel' => 'Stato Civile',
    ),

    'contratti-pubblici' => array(
        'formId'      => 'contrattiPubbliciFormMigration',
        'formAction'  => '?op=contratti-pubblici',
        'buttonId'    => 'contrattiPubbliciMigrationButton',
        'buttonLabel' => 'Contratti Pubblici',
    ),

    'amministrazione-trasparente' => array(
        'formId'      => 'amministrazioneTrasparenteFormMigration',
        'formAction'  => '?op=amministrazione-trasparente',
        'buttonId'    => 'statocivileMigrationButton',
        'buttonLabel' => 'Amministrazione trasparente',
    ),

    'albo-pretorio' => array(
        'formId'      => 'alboPretorioFormMigration',
        'formAction'  => '?op=albo-pretorio',
        'buttonId'    => 'alboPretorioMigrationButton',
        'buttonLabel' => 'Albo pretorio',
    ),
    
    'enti-terzi' => array(
        'formId'      => 'entiTerziFormMigration',
        'formAction'  => '?op=enti-terzi',
        'buttonId'    => 'entiTerziMigrationButton',
        'buttonLabel' => 'Enti terzi',
    ),

    'contenuti' => array(
        'formId'      => 'contenutiFormMigration',
        'formAction'  => '?op=contenuti',
        'buttonId'    => 'contenutiMigrationButton',
        'buttonLabel' => 'Contenuti',
    ),

    'foto' => array(
        'formId'      => 'fotoFormMigration',
        'formAction'  => '?op=foto',
        'buttonId'    => 'fotoMigrationButton',
        'buttonLabel' => 'Foto',
    ),

    'blogs' => array(
        'formId'      => 'blogsFormMigration',
        'formAction'  => '?op=blogs',
        'buttonId'    => 'blogsMigrationButton',
        'buttonLabel' => 'Blogs',
    ),

    'forum' => array(
        'formId'      => 'forumFormMigration',
        'formAction'  => '?op=forum',
        'buttonId'    => 'forumMigrationButton',
        'buttonLabel' => 'Forum',
    ),

    'newsletter' => array(
        'formId'      => 'newsletterFormMigration',
        'formAction'  => '?op=newsletter',
        'buttonId'    => 'newsletterMigrationButton',
        'buttonLabel' => 'Newsletter',
    ),

    'assistenze' => array(
        'formId'      => 'assistenzeFormMigration',
        'formAction'  => '?op=forum',
        'buttonId'    => 'assistenzeMigrationButton',
        'buttonLabel' => 'Assistenze',
    ),
    
    'assistenze' => array(
        'formId'      => 'assistenzeFormMigration',
        'formAction'  => '?op=forum',
        'buttonId'    => 'assistenzeMigrationButton',
        'buttonLabel' => 'Assistenze',
    ),
    
    'delete-old-cms' => array(
        'formId'      => 'deleteOldCMSFormMigration',
        'formAction'  => '?op=delete-old-cms',
        'buttonId'    => 'deleteOldCMSMigrationButton',
        'buttonLabel' => 'Conferma eliminazione',
    ),
);

function displayMigrationButton($key, $cellSpan = 3, $btnClass = 'primary')
{
    global $migrationButtons;

    $migrationForm = $migrationButtons[$key];

    ?>
    <div class="col-md-<?php echo $cellSpan ?>">
        <form action="post.php<?php echo $migrationForm['formAction'] ?>" method="post" id="<?php echo $migrationForm['formId'] ?>" role="form">
            <button type="submit" class="btn btn-lg btn-<?php echo $btnClass ?>"><?php echo $migrationForm['buttonLabel'] ?></button><br><br>
        </form>
    </div>
    <?php
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Setup e migrazione dati CMS Enti locali</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/navbar.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>

    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" title="">Enti locali - Aziende</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#" title="">Home</a></li>
            <li><a href="#" title="">Torna al sito web</a></li>
            <li><a href="#" title="">Backend</a></li>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <?php if ($connectionError): ?>
	<div class="container">
	
    <div class="alert alert-danger">
        <h1>Errore connessione al database</h1>
        <div>Messaggio generato: <?php echo $connectionError; ?></div>
    </div>

    <h1>Database</h1>
    
    <p>Genera nuovi parametri di connessione al database MySQL</p>
    
    <form action="" method="post" class="form-horizontal" role="form">
        <div class="form-group">
        <label for="host" class="col-sm-2 control-label">Host:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="host" placeholder="Server...">
        </div>
        </div>
        
        <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Nome database:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="dbname" id="dbname" placeholder="Nome database...">
        </div>
        </div>
        
        <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Username:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="username" id="username" placeholder="Username...">
        </div>
        </div>
        
        <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password:</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" placeholder="Password...">
        </div>
        </div>
        
        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Crea configurazioni</button>
        </div>
        </div>
    </form>
    
	</div>
    <?php else: ?>
    <div class="container">	
    
	<div class="jumbotron">

            <h1>Console migrazione</h1>

            <p>Migrazione dati database, controllo integrit&agrave; dei dati, setup del CMS realizzato con Zend framework 2. I seguenti pulsanti eseguono operazioni di migrazione dati dal CMS originario. Assicurarsi di aver fatto i backup del sito prima dell'utilizzo di questa console.</p>

            <div class="row">

                <h2>Test connessione</h2>

                <p><button type="button" class="btn btn-warning">Check tabelle vecchio CMS</button></p>

                <p><button type="button" class="btn btn-warning">Check tabelle CMS Zend</button></p>

            </div>

            <div class="row">
            <h2>Indispensabili</h2>
            <!--<p>Moduli primari che garantiscono l'effettivo funzionamento</p>-->
            <?php
                displayMigrationButton('users',4);
                displayMigrationButton('config',4);
                displayMigrationButton('modules',4);
            ?>
            </div>

            <div class="row">
            <h2>Comuni</h2>
            <?php
                displayMigrationButton('albo-pretorio');
                displayMigrationButton('amministrazione-trasparente', 4);
                displayMigrationButton('stato-civile');
                displayMigrationButton('contratti-pubblici');
                displayMigrationButton('enti-terzi');
            ?>
            </div>

            <div class="row">
            <h2>Media</h2>
            <?php
                displayMigrationButton('contenuti');
                displayMigrationButton('foto');
                displayMigrationButton('blogs');
            ?>
            </div>

            <div class="row">
            <h2>Community</h2>
            <?php
                displayMigrationButton('forum');
                displayMigrationButton('newsletter');
            ?>
            </div>

            <div class="row">
            <h2>Elimina tabelle database vecchio CMS</h2>
            <p>ATTENZIONE: prima di procedere con l'eliminazione delle tabelle del vecchio CMS, assicurarsi che TUTTI precedenti siano stati importati.</p>
            <?php
                displayMigrationButton('delete-old-cms', 3, 'danger');
            ?>
            </div>

    </div>
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Chiudi</span></button>
			<h4 class="modal-title" id="myModalLabel">Risultato operazione</h4>
		  </div>
		  <div class="modal-body">
			<div id="migrationResult"></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal">Chiudi</button>
		  </div>
		</div>
	  </div>
	</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    
    <script>

    function showLoading()
    {
        $("#migrationResult").hide();
        //$("#formDataLoading").show();
    }

    function showResponse()
    {
        $("#migrationResult").show();
        //$("#formDataLoading").hide();
    }

    function submitMigration(element) {
        
        $(element).ajaxSubmit({
                    target: "#migrationResult",
                    type: "post"
                });

        return false;
    };
    
    
    $(document).ready(function () {
	
	<?php foreach($migrationButtons as $migrationForm): ?>

            $('#<?php echo $migrationForm['formId'] ?>').submit(function() {

                $('#myModal').modal('show');

                $("#<?php echo $migrationForm['formId'] ?>").ajaxSubmit({
                    target: "#migrationResult",
                    type: "post",
                    onkeyup: false
                });

                return false; 
            }); 

	<?php endforeach; ?>

    });
    
    </script>
    <?php endif; ?>

	<hr>
    &copy; <?php echo date("Y"); ?> <a href="http://www.kronoweb.it" target="_blank" title="Copyright Kronoweb.it">Kronoweb.it</a>
    
    </div><!-- /end container -->
	
</body>
</html>