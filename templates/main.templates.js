!function(){var n=Handlebars.template,a=HandlebarsTemplates.main=HandlebarsTemplates.main||{};a.card_template=n({compiler:[7,">= 4.0.0"],main:function(n,a,e,l,t){var o,s=null!=a?a:{},r=e.helperMissing,u="function",d=n.escapeExpression;return'<div class="card col-xs-12 col-sm-6 col-md-4 col-lg-3">\n	<div class="content">\n		<div class="text-right options_container">\n			<div class="dropdown">\n				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu'+d((o=null!=(o=e.number||(null!=a?a.number:a))?o:r,typeof o===u?o.call(s,{name:"number",hash:{},data:t}):o))+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">\n					<span class="caret"></span>\n				</button>\n				<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu'+d((o=null!=(o=e.number||(null!=a?a.number:a))?o:r,typeof o===u?o.call(s,{name:"number",hash:{},data:t}):o))+'">\n					<li><a href="#" class="single_approve_button">Approve</a></li>\n					<li><a href="#" class="single_reject_button">Reject</a></li>\n				</ul>\n			</div>\n		</div>\n		<div class="clearfix"></div>\n		<h1>'+d((o=null!=(o=e.name||(null!=a?a.name:a))?o:r,typeof o===u?o.call(s,{name:"name",hash:{},data:t}):o))+" ("+d((o=null!=(o=e.number||(null!=a?a.number:a))?o:r,typeof o===u?o.call(s,{name:"number",hash:{},data:t}):o))+')</h1>\n		<div class="text-right expand_container">\n			<a href="#" class="expand_button"><span class="glyphicon glyphicon-chevron-down"></span></a>\n		</div>\n		<div class="detail" style="display:none">\n			<h3>Details</h3>\n			<p>\n				Extra content for the number <strong>'+d((o=null!=(o=e.name||(null!=a?a.name:a))?o:r,typeof o===u?o.call(s,{name:"name",hash:{},data:t}):o))+"</strong>, also known\n				numerically as <strong>"+d((o=null!=(o=e.number||(null!=a?a.number:a))?o:r,typeof o===u?o.call(s,{name:"number",hash:{},data:t}):o))+"</strong>.\n			</p>\n			<p>\n				It's located at secuentially at the position number\n				<strong>"+d((o=null!=(o=e.number||(null!=a?a.number:a))?o:r,typeof o===u?o.call(s,{name:"number",hash:{},data:t}):o))+"</strong>.\n			</p>\n			<p>\n				To reach "+d((o=null!=(o=e.number||(null!=a?a.number:a))?o:r,typeof o===u?o.call(s,{name:"number",hash:{},data:t}):o))+", you would need to count:<br/>\n				"+d((e.count||a&&a.count||r).call(s,null!=a?a.number:a,{name:"count",hash:{},data:t}))+"\n			</p>\n		</div>\n	</div>\n</div>"},useData:!0})}();
