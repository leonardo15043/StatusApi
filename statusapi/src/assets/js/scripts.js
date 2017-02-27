$(document).ready(function(){
	

	/*OPEN MESSAGE LIST*/

	$('.bt_lidata').on("click", function(e) { 

			$('.conten_editor').animate({width: '800px' , top: '-200px'});
			$('body').append('<div class="opa"></div>');
			$('.list_data').animate({top: '125px' , opacity: '10' , 'z-index': '3' });
			//Load Data Table
		    load_table(); 
		    setTimeout(function(){ $('.k-link').trigger('click');}, 1000);

		//Click to close the list of messages
		$('.opa').on("click", function(e) { 

			$('body .opa').remove();
			$('body .cont_log').remove();
			$('.conten_editor').animate({width: '1000px' , top: '0px'});
			$('.list_data').animate({opacity: '0' , bottom: '0px' , 'z-index': '-1' });
		
		});

	});


    /*OPEN THE TOOLS MENU*/

	$('.bttool').click(function(){
		
		$('body').append('<div class="opa"></div>');
		$('.cont_tool').animate({width: '55px'});
		
		$('.opa').on("click", function(e) { 
			$('body .opa').remove();
			$('body .cont_log').remove();
			$('.cont_tool').animate({width: '0px'});
		});
		
	});

	
});

/*VALIDATE THE AMOUNT OF MESSAGE CHARACTERS*/

window.onload = function () {
	 //Each time we write this event will be activated
	$('#message').keyup(function() {
		
			var message = $('#message').val();
			var number_characters = message.length;
			var cont_chars = $(this).val();
			var limit = 120-number_characters;
			$('#count-chars').html(limit);
	     
			if(0 > limit ){
				$( ".btn-save" ).addClass('disabled');
				$( "#count-chars" ).addClass('red');
			}else{
				$( ".btn-save" ).removeClass('disabled');
				$( "#count-chars" ).removeClass('red');
			}
			
    });//keyup
		
}//window.onload


/*LOAD LIST OF MESSAGES*/

function load_table(){
			//Webservice base URL
			var baseurl = location.protocol + "//" + location.host;

			var jsons = new Array();
			//We make a url request to bring the entire message list
			$.getJSON(baseurl+"/proyectoInt/list/all")
				.done(function(data){
					//We show the data that the JSON returns
					$.each(data , function(indice,valueD){

							   var key = {

									   Id : valueD['id'],
									   Mensaje : valueD['message'],
									   Fecha : valueD['fecha']

								};

								jsons.push(key);				  

					});

			});

		//We used the "Kendo UI" library to format the table
		$("#grid").kendoGrid({

				title: {
					text: "Lista de messages"
				},

				dataSource: new kendo.data.DataSource({
					//We add the data returned from the webservice
					data: jsons,
					
				}),

				filterable: true,
				height: 550,
				groupable: false,
				sortable: true,
				pageable: {
					refresh: true,
					pageSizes: true,
					buttonCount: 5
				},

				columns: [ 
					//We place the headings of the table
					{ field: "Id", width: 30 },
					{ field: "Mensaje", width: 270 },
					{ field: "Fecha", width: 50 },
					//Add the function "Delete" to the button
					{ command: {
							text: " Eliminar",
							click: Delete,
							className: "fa fa-map-marker"
						  },
						title: " ",
						width: "50px"

				}],//columns

		});//kendoGrid

}//load_table


 //ADD NEW MESSAGE
 
function new_message(){

	$('.message-alert').html('');
	var message = $('#message').val();
	
	if( $(".btn-save").hasClass("disabled")){
		return false;
	}

	//Webservice base URL
	var baseurl = location.protocol + "//" + location.host;
	//If the message is different from empty
	if(message != ""){
		//Using the url we added a new message
		$.getJSON(baseurl+"/proyectoInt/add/"+message)
			.done(function(data){
			
			$.each(data , function(indice,valueD){
				//We show webservice response
				$('.message-alert').html(valueD);
			});
			
		});//$.getJSON
		
	}else{
		//Show an alert if you have sent an empty message
		$('.message-alert').html('Debe ingresar un message ');

	}
			
}//new_message()


/*REMOVE MESSAGES*/

function Delete(e) {
	 e.preventDefault();
	 //Capture message id
	 var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
     var id = dataItem['Id'];
	 //Webservice base URL
	 var baseurl = location.protocol + "//" + location.host;
	 
	 	$.getJSON(baseurl+"/proyectoInt/delete/"+id)
			.done(function(data){
			
			$.each(data , function(indice,valueD){
				//Show the message that the webservice returns
				$('.message-alert').html(valueD);
				//Select the item you want to remove
				var dataSource = $("#grid").data("kendoGrid").dataSource;
                    dataSource.remove(dataItem);
                    dataSource.sync();

			});
			
		});//$.getJSON
	 
}

//CLEAR LOGS

function clear_logs(){
	//We close the window
	$('.opa').trigger('click');
	//Webservice base URL
	var baseurl = location.protocol + "//" + location.host;
	 
	 	$.getJSON(baseurl+"/proyectoInt/log/clear")
			.done(function(data){
			//Select the item you want to remove
			$.each(data , function(indice,valueD){
					$('.message-alert').html(valueD);
			});
			
		});//$.getJSON

}//clear_logs



