<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php echo htmlspecialchars($_title) ?></title>
	<!-- Bootstrap -->
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="/js/jquery.min.js"></script>
	
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/bootstrap-hover-dropdown.min.js"></script>
	
	<!-- Ours -->
	<link href='http://fonts.googleapis.com/css?family=Lato:700|Raleway:500,600,700,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<script src="/js/main.js"></script>
	
	<!-- Custom -->
	<?php foreach($_css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	
	<?php foreach($_js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/images/favicons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top gns">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Activar Navegación</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li<?php echo ($_section=='servicios')?' class="active"':'';?>><a href="/servicios">SERVICIOS</a></li>
						<li<?php echo ($_section=='como')?' class="active"':'';?>><a href="/como">¿CÓMO LO HACEMOS?</a></li>
						<li class="dropdown<?php echo ($_section=='proyectos')?' active':'';?>">
							<a id="projects_menu_button" href="/proyectos" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">PROYECTOS <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/proyectos#order=time&amp;category=all">Más reciente</a></li>
								<li><a href="/proyectos#order=abc&amp;category=all">Alfabéticamente</a></li>
								<li class="divider"></li>
								<?php foreach ($_categories AS $category): ?>
									<?php if(count($category->sub_categories)): ?>
										<li class="menu-item dropdown-submenu dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo htmlspecialchars($category->name)?></a>
										<ul class="dropdown-menu">
											<li class="menu-item"><a href="/proyectos#order=time&amp;category=<?php echo $category->id_category?>"><em><b>Todos</b></em></a>
										<?php foreach ($category->sub_categories AS $sub_category): ?>
											<li class="menu-item"><a href="/proyectos#order=time&amp;category=<?php echo $sub_category->id_category?>"><?php echo htmlspecialchars($sub_category->name)?></a></li>
										<?php endforeach; ?>
										</ul>
									<?php else: ?>
										<li><a href="/proyectos#order=time&amp;category=<?php echo $category->id_category?>"><?php echo htmlspecialchars($category->name)?></a>
									<?php endif; ?></li>
								<?php endforeach; ?>
							</ul>
						</li>
						<li<?php echo ($_section=='contacto')?' class="active"':'';?>><a href="/contacto">CONTACTO</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a class="navbar-brand" href="/"><img alt="Neurona Creativa" src="/images/logo_header.png"></a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>

		<div class="container">
			<nav class="navbar navbar-default navbar-fixed-top smalls">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
						<span class="sr-only">Activar Navegación</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<ul class="nav navbar-nav navbar-right">
						<li><a class="navbar-brand" href="/"><img alt="Neurona Creativa" src="/images/logo_header.png"></a></li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
					<ul class="nav navbar-nav">
						<li<?php echo ($_section=='servicios')?' class="active"':'';?>><a href="/servicios">SERVICIOS</a></li>
						<li<?php echo ($_section=='como')?' class="active"':'';?>><a href="/como">¿CÓMO LO HACEMOS?</a></li>
						<li class="dropdown<?php echo ($_section=='proyectos')?' active':'';?>">
							<a id="projects_menu_button" href="/proyectos" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">PROYECTOS <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/proyectos#order=time&amp;category=all">Más reciente</a></li>
								<li><a href="/proyectos#order=abc&amp;category=all">Alfabéticamente</a></li>
								<li class="divider"></li>
								<?php foreach ($_categories AS $category): ?>
									<?php if(count($category->sub_categories)): ?>
										<li class="menu-item dropdown-submenu dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo htmlspecialchars($category->name)?></a>
										<ul class="dropdown-menu">
											<li class="menu-item"><a href="/proyectos#order=time&amp;category=<?php echo $category->id_category?>"><em><b>Todos</b></em></a>
											<?php foreach ($category->sub_categories AS $sub_category): ?>
												<li class="menu-item"><a href="/proyectos#order=time&amp;category=<?php echo $sub_category->id_category?>"><?php echo htmlspecialchars($sub_category->name)?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php else: ?>
										<li><a href="/proyectos#order=time&amp;category=<?php echo $category->id_category?>"><?php echo htmlspecialchars($category->name)?></a>
									<?php endif; ?></li>
								<?php endforeach; ?>
							</ul>
						</li>
						<li<?php echo ($_section=='contacto')?' class="active"':'';?>><a href="/contacto">CONTACTO</a></li>
					</ul>
					
				</div><!-- /.navbar-collapse -->
		</nav>
	</div>

	<div class="container<?php echo ($_fluid)?'-fluid':'';?>">
		<?php echo $_content_for_layout ?>
		
		<div class="markers">
			<div class="top-left"></div>
			<div class="bottom-left fixed"></div>
			<div class="top-right"></div>
			<div class="bottom-right fixed"></div>
			<div class="hide-up"></div>
			<div class="hide-down fixed"></div>
		</div>

	</div>
	
	<footer class="footer">
		<div class="container-fluid">
			<!--div class="center visible-xs-block"><span>Neurona Creativa</span></div>-->
			<div class="phone visible-xs-block">cel. <a href="tel:3339498793" class="phone">(33) 3949.8793</a></div>
			<div id="footer_text" class="right"></div>
			<div class="left">
				<a class="facebook icon" href="https://facebook.com/" target="_blank"><span>Facebook</span></a>
				<a class="youtube icon" href="https://youtube.com/" target="_blank"><span>Youtube</span></a>
				<a class="behance icon" href="https://behance.com/" target="_blank"><span>Behance</span></a>
				<a class="linkedin icon" href="https://linkedin.com/" target="_blank"><span>LinkedIn</span></a>
				<a class="instagram icon" href="https://instagram.com/" target="_blank"><span>Instagram</span></a>
				<span class="phone hidden-xs">cel. <a href="tel:3339498793" class="phone">(33) 3949.8793</a></span>
			</div>
		</div>
	</footer>

	<script type="text/javascript">
		var special_texts = [
			'¡Ey!, ¿Qué haces?',
			'Vamos... deja de hacer click ¬_¬',
			'Sí, sí, descubriste un easter egg, ¡felicidades!',
			'Ya dije felicidades, ¿Qué más quieres?',
			'Mira, suficiente es suficiente.',
			'Contaré hasta 10, y deja de dar clicks, ¿Ok?',
			'Uno.',
			'Dos.',
			'Tres.',
			'Eres todo un rebelde (Sigh).',
			'Cuatro.',
			'Cinco.',
			'Seis.',
			'Seriously?',
			'Siete.',
			'Ocho.',
			'Nueve.',
			'Una más, te lo advierto.',
			'Diez.',
			'Ok te lo advertí, sobre advertencia no hay engaño.',
			'Un click más y despidete, ¿Capichi?',
		];
		var footer_clicks = 0;
		var footer_texts = <?php echo json_encode($_footer_texts) ?>;
	</script>

</body>
</html>