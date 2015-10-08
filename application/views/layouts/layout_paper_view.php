<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $this->configurations->get('site_name')?> : PaperView Prototype</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
  <style>
  /* Sticky footer styles
  -------------------------------------------------- */
  html {
  	position: relative;
  	min-height: 100%;
  }
</style>
</head>
<body>
	<div style="display:none" id="with_selected">
		<a id="reject_button" href="#" class="btn btn-info">Reject</a>
		<a id="approve_button" href="#" class="btn btn-primary">Approve</a>
		<a id="select_none_button" href="#" class="btn btn-default pull-right">Select None</a>
	</div>
	
	<div class="container-fluid">
		<h1>PaperView Prototype</h1>
		<div class="row"  id="tools">
			<form class="form-inline col-xs-12">
				<div class="form-group">
					<label for="search_input">Search:</label>
					<input type="search" class="form-control" id="search_input" placeholder="Search"/>
				</div>
			</form>
		</div>
		
		<div class="row"  id="paper_view"></div>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="/js/handlebars-v4.0.2.js"></script>
	<script src="/js/paper_view.js"></script>
	<script src="/templates/template_loader.js"></script>
</body>
</html>