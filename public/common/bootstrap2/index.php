<!DOCTYPE html>
<html lang="it">
	<head>
    <meta charset="utf-8">
    <title><?php echo $templateData['sitename'] ?> - area riservata</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="admin/common/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<link rel="shortcut icon" href="favicon.ico">
	
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
	label.error {
		color: red;
		margin-left: 0.5%;
	}
	input.error, textarea.error {
		border: 1px solid red;
	}
    </style>
    <link href="admin/common/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="admin/common/bootstrap/js/html5shiv.js"></script>
    <![endif]-->
	
	</head>

	<body>

	<noscript>
		<div>
			<h3><?php echo $templateData['languageLabels']['ADMIN_NOJAVSCRPT_TITLE']; ?></h3>
			<div><?php echo $templateData['languageLabels']['ADMIN_NOJAVSCRPT_DESCRIPTION'] ?></div>
		</div>
	</noscript>
		
    <div class="container">
    
	<!-- Login Form -->
	<form class="form-signin" id="frmLogin" action="" method="post">
		<h3 class="form-signin-heading"><?php echo $templateData['languageLabels']['ADMIN_RESERVED_AREA']?></h3>
		<input type="text" name="emailuser" class="input-block-level" placeholder="<?php echo $templateData['languageLabels']['ADMIN_EMAILUSERPLACEHOLDER']?>" title="<?php echo $templateData['languageLabels']['ADMIN_EMAILUSERPLACEHOLDER']?>">
		<input type="password" name="password" class="input-block-level" placeholder="<?php echo $templateData['languageLabels']['ADMIN_PASSWORDPLACEHOLDER']?>" title="<?php echo $templateData['languageLabels']['ADMIN_PASSWORDPLACEHOLDER']?>">
		<!-- Language: only if enabled -->
		<?php if ($templateData['languageAvailables'] and count($templateData['languageAvailables']) > 1): ?>
		<label>
			<select name="adminLanguage" id="adminLanguage">
				<option value=""><?php echo $templateData['languageLabels']['ADMIN_LANGUAGE']?></option>
				<?php foreach($templateData['languageAvailables'] as $availableLanguages): ?>
				<option value="<?php echo $availableLanguages['abbrev1'] ?>"><?php echo $availableLanguages['abbrev3'] ?></option>
				<?php endforeach; ?>
			</select>
		</label>
		<?php endif; ?>
		<!--
		<label for="checkbox" class="checkbox">
			<input type="checkbox" name="checkbox" id="checkbox" value="remember-me" title="<?php echo $templateData['languageLabels']['ADMIN_REMEMBERME']?>"> <?php echo $templateData['languageLabels']['ADMIN_REMEMBERME']?>
		</label>
		-->	
		<input type="hidden" name="honeypot" id="honeypot" value="">
		<button class="btn btn-large btn-primary" type="submit" title="<?php echo $templateData['languageLabels']['ADMIN_ACCESSBUTTONTITLE']?>"><?php echo $templateData['languageLabels']['ADMIN_ACCESSBUTTON']?></button>
		<div class="clear">&nbsp;</div>
		
		<p><a href="javascript:void(0)" title="<?php echo $templateData['languageLabels']['ADMIN_RECOVERPASSWORD']?>" onclick="$('#recoverPasswordContainer').show(); $('#frmLogin').hide()"><span class="icon-arrow-right"></span> <?php echo $templateData['languageLabels']['ADMIN_RECOVERPASSWORD']?></a></p>		
		<p><a href="<?php echo $templateData['remotelinkWeb'] ?>" title="<?php echo $templateData['languageLabels']['ADMIN_BACK_TO_WEBSITE'] ?>"><span class="icon-home"></span> <?php echo $templateData['languageLabels']['ADMIN_BACK_TO_WEBSITE'] ?></a></p>

		<div class="clear"></div>
		&copy; <?=date("Y")?> <?php echo $templateData['sitename'] ?>
	</form>
	
	<div id="loginResult"></div>
	
	<!-- Recorver password form -->
	<div id="recoverPasswordContainer" style="display: none">
	<form class="form-signin" id="frmPasswordRecover" action="" method="post">
		<h3 class="form-signin-heading"><?php echo $templateData['languageLabels']['ADMIN_RECOVERPASSWORD']?></h3>
		<input type="text" name="emailrecover" class="input-block-level" placeholder="Email o nome utente" title="Inserisci email o nome utente">
		<input type="hidden" name="honeypot" id="honeypot" value="">
		<button class="btn btn-large btn-primary" type="submit" title="Procedi">Procedi</button>
		<div class="clear">&nbsp;</div>
		<p><a href="javascript:void(0)" onclick="$('#frmLogin').show(); $('#recoverPasswordContainer').hide()" title="<?php echo $templateData['languageLabels']['ADMIN_BACKTOLOGIN']?>"><span class="icon-arrow-left"></span> <?php echo $templateData['languageLabels']['ADMIN_BACKTOLOGIN']?></a></p>
		<p><a href="<?php echo $templateData['remotelinkWeb'] ?>" title="<?php echo $templateData['languageLabels']['ADMIN_BACK_TO_WEBSITE'] ?>"><span class="icon-home"></span> <?php echo $templateData['languageLabels']['ADMIN_BACK_TO_WEBSITE'] ?></a></p>
		
		<div class="clear"></div>
		&copy; <?=date("Y")?> <?php echo $templateData['sitename'] ?>
	</form>
	</div>
	
	<!-- TODO: generate new password, store on db, send to the user email -->
	<div id="recoverPasswrodResult"></div>
	
    </div>

	<!-- JQuery -->
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/javascript/jquery/jquery.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/javascript/jquery/validate/jquery.validate.min.js"></script>
	<script>
	jQuery(document).ready(function() {
		
		/* Validate form login */
		$("#frmLogin").validate({
			rules: {
				emailuser: {
					required: true,
					email: true
					},
				password: {
					required: true
					}
				},
				messages: {
					emailuser: {
						required: "<?php echo $templateData['languageLabels']['ADMIN_INSERT_EMAIL']?>",
						email: "<?php echo $templateData['languageLabels']['ADMIN_INSERT_VALIDEMAIL']?>"
					},
					password: "Inserisci password"
				}
		});

		/* Validate form login */
		$('#frmPasswordRecover').validate({
			rules: {
				emailrecover: {
					required: true,
					email: true
					}
				},
				messages: {
					emailrecover: {
						required: "<?php echo $templateData['languageLabels']['ADMIN_INSERT_EMAIL']?>",
						email: "<?php echo $templateData['languageLabels']['ADMIN_INSERT_VALIDEMAIL']?>"
					}
				}
		});
		
	});
	</script>
	
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-transition.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-alert.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-modal.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-tab.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-popover.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-button.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-collapse.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-carousel.js"></script>
    <script src="<?php echo $templateData['remotelinkWeb'] ?>admin/common/bootstrap/js/bootstrap-typeahead.js"></script>
	
	</body>
</html>