<!DOCTYPE html>
<html lang="it">
	<head>
    <meta charset="utf-8">
    <title><?php echo $templateData['sitename'] ?> - area riservata</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="admin/common/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
    <style type="text/css">
	body {
		padding-top: 40px;
		padding-bottom: 40px;
		background-color: #f5f5f5;
	}

	.form-signin {
		max-width: 300px;
		padding: 19px 29px 29px;
		margin: 0 auto 20px;
		background-color: #fff;
		border: 1px solid #e5e5e5;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
		-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
		box-shadow: 0 1px 2px rgba(0,0,0,.05);
	}
	
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
		margin-bottom: 10px;
	}
	.form-signin input[type="text"],
	.form-signin input[type="password"] {
		font-size: 16px;
		height: auto;
		margin-bottom: 15px;
		padding: 7px 9px;
	}
    </style>
    <link href="admin/common/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="admin/common/bootstrap/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="admin/common/bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="admin/common/bootstrap/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="admin/common/bootstrap/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="admin/common/bootstrap/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="admin/common/bootstrap/ico/favicon.png">
	-->
	</head>

	<body>

    <div class="container">

	<form class="form-signin" id="frmLogin" action="" method="post">
		<h2 class="form-signin-heading">Area riservata</h2>
		<input type="text" name="emailuser" class="input-block-level" placeholder="Email o nome utente">
		<input type="password" name="password" class="input-block-level" placeholder="Password">
		<!--
		<label for="checkbox" class="checkbox">
			<input type="checkbox" name="checkbox" id="checkbox" value="remember-me"> Remember me
		</label>
		-->
		<input type="hidden" name="honeypot" id="honeypot" value="">
		<button class="btn btn-large btn-primary" type="submit">Accedi</button>
		<div class="clear">&nbsp;</div>
		&copy; <?=date("Y")?> <?php echo $templateData['sitename'] ?>
	</form>
	
	<div id="loginResult"></div>
	
    </div>

	<!-- Jquery -->
    <script src="admin/common/javascript/jquery/jquery.js"></script>
    <script src="admin/common/javascript/jquery/jquery.validate.min.js"></script>
	
    <script src="admin/common/bootstrap/js/bootstrap-transition.js"></script>
    <script src="admin/common/bootstrap/js/bootstrap-alert.js"></script>
    <script src="admin/common/bootstrap/js/bootstrap-modal.js"></script>
    <script src="admin/common/bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="admin/common/bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="admin/common/bootstrap/js/bootstrap-tab.js"></script>
    <script src="admin/common/bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="admin/common/bootstrap/js/bootstrap-popover.js"></script>
    <script src="admin/common/bootstrap/js/bootstrap-button.js"></script>
    <script src="admin/common/bootstrap/js/bootstrap-collapse.js"></script>
    <script src="admin/common/bootstrap/js/bootstrap-carousel.js"></script>
    <script src="admin/common/bootstrap/js/bootstrap-typeahead.js"></script>
	
	</body>
</html>