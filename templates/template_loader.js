Handlebars.loadTemplate = function(directory, name, callback) {
	//console.log('Entering');
	if (typeof HandlebarsTemplates == 'undefined') {
		//If it's the firstCall, create the repository
		HandlebarsTemplates = {};
	}
	if (typeof callback == 'undefined') {
		callback = function(){};
	}
	
	if (typeof HandlebarsTemplates[directory] == 'undefined' ) { // Load the whole templates
		//console.log('Not Loaded');
		HandlebarsTemplates[directory]={};
		$.ajax({
			url : '/templates/' + directory + '.templates.js',
			dataType: "text",
		}).then(
			function(data){ //Success
	  			loadJs(data);
				if (typeof HandlebarsTemplates[directory][name] == 'undefined') { 
					//console.log("Loading single template");
					$.ajax({
						url : '/templates/' + directory + '/' + name + '.hbs',
						success : function(data) {
							var template = HandlebarsTemplates[directory][name] = Handlebars.compile(data);
							callback(template);
						},
						error : function(){
							callback(false);
						}
					});
				} else {
					//console.log("Loaded with function");
					callback(HandlebarsTemplates[directory][name]);
				}

			},
			function(data){ //Error
				//console.log("Loading single template");
				$.ajax({
					url : '/templates/' + directory + '/' + name + '.hbs',
					dataType:'text',
					success : function(data) {
						//console.log('single template loaded');
						var template = HandlebarsTemplates[directory][name] = Handlebars.compile(data);
						callback(template);
					},
					error : function(){
						//console.log("Template doesn't exist");
						callback(false);
					}
				});
				
			}
		);
	} else{
		if (typeof HandlebarsTemplates[directory][name] == 'undefined') { 
			$.ajax({
				url : '/templates/' + directory + '/' + name + '.hbs',
				success : function(data) {
					var template = HandlebarsTemplates[directory][name] = Handlebars.compile(data);
					callback(template);
				},
				error : function(){
					callback(false);
				}
			});
		} else {
			//console.log('already loaded');
			callback(HandlebarsTemplates[directory][name]);
		}
	} 
};

function loadJs(source) {
	var jsfile = $("<script type='text/javascript'>"+source+"</script>");
	$("head").append(jsfile); 
}