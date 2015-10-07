$(document).ready(function (){
	Handlebars.loadTemplate('main', 'card_template', function(template) {
	var data = [
	'one','two','three','four','five','six','seven',
	'eight','nine','ten','eleven','twelve','thirteen',
	'fourteen','fifteen','sixteen','seventeen','eighteen',
	'nineteen','twenty',
	'twenty-one','twenty-two','twenty-three','twenty-four',
	'twenty-five','twenty-six','twenty-seven', 'twenty-eight',
	'twenty-nine','thirty',
	'thirty-one','thirty-two','thirty-three','thirty-four',
	'thirty-five','thirty-six','thirty-seven','thirty-eight',
	'thirty-nine','forty',
	'forty-one','forty-two','forty-three','forty-four',
	'forty-five','forty-six','forty-seven','forty-eight',
	'forty-nine', 'fifty'
	];
	
	//var template = Handlebars.compile($("#card-template").html());
	for(var i=0;i<data.length;i++) {
		$("#paper_view").append(template({'number':i+1, 'name':data[i]}));
	}
	updateClearFix();

	$('#paper_view').delegate('.card', 'click', function(){
		$(this).toggleClass('selected');
		
		if($('#paper_view .card.selected').length && $('#with_selected').css('display')=='none'){
			$('#with_selected').slideDown('fast');
		}
		
		if(!$('#paper_view .card.selected').length && $('#with_selected').css('display')=='block'){
			$('#with_selected').slideUp('fast');
		}
	});
	$('#paper_view').delegate('.dropdown-toggle', 'click', function(){
		e.stopPropagation();
		$(this).toggle();
	});
	$("#select_none_button").click(function(){
		$('#paper_view .card.selected').removeClass('selected');
		$('#with_selected').slideUp('fast');
		return false;
	});

	$('#paper_view').delegate('.card .expand_button', 'click', function(){
		$(this).find('span').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
		$(this).closest('.card').find('.detail').slideToggle('fast');
		return false;
	});

	$("#reject_button").click(function(){
		$('#with_selected').slideUp('fast');

		$('#paper_view .card.selected h1').append('<div class="overlay"><span class="glyphicon glyphicon-remove"></span></div>');

		$('#paper_view .card.selected').each(function(){
			$(this).fadeOut('slow', function(){
				$(this).remove();
				updateClearFix();
			});
		});
		
		return false;
	});

	$("#approve_button").click(function(){
		$('#with_selected').slideUp('fast');

		$('#paper_view .card.selected h1').append('<div class="overlay"><span class="glyphicon glyphicon-ok"></span></div>');
		
		$('#paper_view .card.selected').each(function(){
			$(this).fadeOut('slow', function(){
				$(this).remove();
				updateClearFix();
			});
		});
		
		return false;
	});

	$('#paper_view').delegate('.card .single_approve_button', 'click', function(){
		var card = $(this).closest('.card');
		$(card).find('h1').append('<div class="overlay"><span class="glyphicon glyphicon-ok"></span></div>');
		$(card).fadeOut('slow', function(){
			$(this).remove();
			updateClearFix();
		});
		
		return false;
	});

	$('#paper_view').delegate('.card .single_reject_button', 'click', function(){
		var card = $(this).closest('.card');
		$(card).find('h1').append('<div class="overlay"><span class="glyphicon glyphicon-remove"></span></div>');
		$(card).fadeOut('slow', function(){
			$(this).remove();
			updateClearFix();
		});
		
		return false;
	});

	$('#search_input').keyup(function(){
		var search = $('#search_input').val()
		if($('#search_input').val().length>2){
			$('#paper_view').addClass('filtering');
			
			$('#paper_view .card h1').each(function(){
				if($(this).text().indexOf(search)>=0) {
					$(this).closest('.card').addClass('found');
				} else {
					$(this).closest('.card').removeClass('found');
				}
			});
			updateClearFix();
		} else {
			$('#paper_view .card').removeClass('found');
			$('#paper_view').removeClass('filtering');
			updateClearFix();
		}
	});
	
	});
});

/** A Cleafirx must be added after every 4th(lg screens),
 *	3rd(md screes) and 2nd(small screens) card, so they
 *  can have diferrent heights and still align horizontally.
 *  As this changes when a card is taken out of the flow
 *  it must be updated after every change to the set.
 **/
 function updateClearFix() {
 	$('#paper_view .clearfix').remove();

 	var found 	 = ($('#paper_view').hasClass('filtering'))?'.found':'';
 	var elements = $('#paper_view .card' + found);

 	for(var i=0; i<elements.length; i++){
 		var seq 	= i+1; 
 		var classes = "";

 		/** Modulus magic to find out every 4th, 3rd and 2nd card **/
 		classes += (seq%4)?'':" visible-lg-block";
 		classes += (seq%3)?'':" visible-md-block";
 		classes += (seq%2)?'':" visible-sm-block";

 		if(classes != '') {
 			/** We insert a single row for every combination **/
 			$(elements[i]).after('<div class="clearfix'+classes+'"></div>');
 		}
 	}
 }

 Handlebars.registerHelper('count', function(counter) {
 	var string = "1"
 	for(var i=2; i<=counter; i++) {
 		string += ', '+i;
 	}
 	return string+".";
 });