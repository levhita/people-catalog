<div class="row margin-xs">
	<h1 class="main-title first">Somos tu departamento creativo</h1>
	<hr/>
	<div class="intro">
		<em>Tú sabes muy bien lo que haces, pero la gente necesita que se lo digas de una forma que lo pueda entender</em> con
		sólo escuchar el nombre de tu marca y se le quede en la cabeza. <em>Una marca debe evocar un significado, y ese significado
		se va construyendo poco a poco a través de diferentes acciones mercadológicas.</em>
	</div>
	<hr/>
</div>

<div class="row">
	<form class="form-inline" id="filters">
		<label for="main_filters">Mostrar:</label>
		<select id="main_filters" name="main_filters"class="form-control">
			<option value="time">Más reciente</option>
			<option value="abc">Alfabéticamente</option>
			<?php foreach ($_categories AS $category): ?>
				<option value="<?php echo $category->id_category?>"><?php echo htmlspecialchars($category->name); echo (count($category->sub_categories))?' »':'';?></option>
			<?php endforeach; ?>
		</select>
		&nbsp;<div class="nowrap"><label for="sub_filters" id="sub_filters_label">De:</label>
		<select class="form-control" id="sub_filters"></select></div>
	</form>
</div>

<div class="row expanded">
	<div id="side_pagers"></div>
	<div id="projects"></div>
</div>


<div cass="row">
	<div id="bottom_pagers"></div>
	<div id="pager_container"></div>
</div>

<script type="text/javascript">
	var categories = <?php echo json_encode($_categories); ?>;
</script>

<script id="sub_filters-template" type="text/x-handlebars-template">
	<option value="{{id_parent_category}}"{{#if parent_selected}} selected="selected"{{/if}}>Todos</option>
	{{#each sub_categories}}
		<option value="{{id_category}}"{{#if selected}} selected="selected"{{/if}}>{{name}}</option>
	{{/each}}
</script>

<script id="side_pagers-template" type="text/x-handlebars-template">
	{{#each pager}}
		{{#if @first}}<div class="previous{{#if active}} active{{/if}}{{#if disabled}} disabled{{/if}}"><a href="#page={{page}}"><span>Anterior</span></a></div>{{/if}}
		{{#if @last}}<div class="next{{#if active}} active{{/if}}{{#if disabled}} disabled{{/if}}"><a href="#page={{page}}"><span>Siguiente</span></a></div>{{/if}}
	{{/each}}	
</script>

<script id="bottom_pagers-template" type="text/x-handlebars-template">
	{{#each pager}}
		{{#if @first}}<div class="visible-xs previous{{#if active}} active{{/if}}{{#if disabled}} disabled{{/if}}"><a href="#page={{page}}">Anterior</a></div>{{/if}}
		{{#if @last}}<div class="visible-xs next{{#if active}} active{{/if}}{{#if disabled}} disabled{{/if}}"><a href="#page={{page}}">Siguiente</a></div>{{/if}}
	{{/each}}	
</script>

<script id="pager-template" type="text/x-handlebars-template">
	<ul id="pager">
		{{#each pager}}
			<li class="{{#if active}}active{{/if}}{{#if disabled}} disabled{{/if}}{{#if @first}} first{{/if}}{{#if @last}} last{{/if}}"><a href="#page={{page}}"><span>{{name}}</span></a></li>
			{{#unless @first}}{{#unless @last}}{{#unless prelast}}<li>·</li>{{/unless}}{{/unless}}{{/unless}}
		{{/each}}
	</ul>
</script>

<script id="project-template" type="text/x-handlebars-template">
	<div id="carousel-{{id_project}}" class="col-lg-3 col-md-4 col-sm-6 col-xs-12 carousel">
		{{#each thumbnails}}
		<div class="slide{{#if @first}} active{{/if}} {{type}}">
			<a href="/proyecto/{{../short_url}}"><img src="/project_uploads/{{thumbnail}}"/></a>
		</div>
		{{/each}}
	</div>
</script>