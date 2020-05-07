jQuery(document).ready(function($) {

	$("#buscar_sectores").keyup(function(event) {

		var buscar_sectores = $("#buscar_sectores").val();
		if(buscar_sectores!=''){
			$.ajax({
			    type: "post",
			    dataType: "json",
			    url: dcms_vars.ajaxurl, // Pon aquí tu URL
			    data: {
			        action: "dcms_ajax_buscar_sector",
			        buscar_sectores: buscar_sectores

			    },
			    error: function (response) {
			        console.log(response);
			    },
			    success: function (response) {
			    
			    	var i;
			    	var html = '';
			    	if(parseInt(response.length) > 0){
			    		for (i = 0;	i < response.length; i++) {
				    		//html+= '<a href="'+response[i]['uri_sector']+'" class="list-group-item list-group-item-action">'+response[i]['name_sector']+'</a>';
				    		html+= '<a class="list-group-item collapsed" type="button" data-toggle="collapse" data-target="#collapse'+response[i]['code_sector']+'" aria-expanded="true" aria-controls="collapse'+response[i]['code_sector']+'">'+response[i]['name_sector']+'</a>'; 
				    		html+= '<div id="collapse'+response[i]['code_sector']+'" class="list-group collapse" data-parent="#accordionSector">';
				    		if(parseInt(response[i]['code'].length) > 0){
				    			for(d =0; d < response[i]['code'].length; d++){
				    				//console.log(response[i]['code'][d]);
				    				html+= '<a href="'+response[i]['code'][d]['uri_code']+'" class="list-group-item list-group-item-action">'+response[i]['code'][d]['name_code']+'</a>';
				    			}
				    		}
				    		html+= '</div>';

				    	}
				    
			    	}else{
			    		html+= '<a class="list-group-item list-group-item-action">¡No existe información asociada a su búsqueda!</a>';
			    		html+= '<a class="list-group-item list-group-item-action">Por favor intente nuevamente.</a>';
			    	}
			    	
			    	$('#accordionSector').find('.list-group').html(html);
			    	

			    }
			});	
		}
		
	});

	$("#buscar_ocupaciones").keyup(function(event) {

		var buscar_ocupaciones = $("#buscar_ocupaciones").val();
		if(buscar_ocupaciones!=''){
			$.ajax({
			    type: "post",
			    dataType: "json",
			    url: dcms_vars.ajaxurl, // Pon aquí tu URL
			    data: {
			        action: "dcms_ajax_buscar_job_ocupacion", // IJENSEN MOD 05-02-2020  action: "dcms_ajax_buscar_ocupacion",
			        buscar_ocupaciones: buscar_ocupaciones

			    },
			    error: function (response) {
			        console.log(response);
			    },
			    success: function (response) {
			    
			    	var i;
			    	var html = '';
			    	if(parseInt(response.length) > 0){
			    		for (i = 0;	i < response.length; i++) {
				    		//html+= '<a href="'+response[i]['uri_occupation']+'" class="list-group-item list-group-item-action">'+response[i]['name_occupation']+'</a>';


				    		/*	MOD 05-02-2020 IJENSEN
					    		html+= '<a class="list-group-item collapsed" onclick="fn_buscar_ocupacion('+response[i]['id_occupation']+')" type="button" data-toggle="collapse" data-target="#collapse'+response[i]['id_occupation']+'" aria-expanded="true" aria-controls="collapse'+response[i]['id_occupation']+'">'+response[i]['name_occupation']+'</a>'; 
					    		html+= '<div id="collapse'+response[i]['id_occupation']+'" class="list-group collapse" data-parent="#accordionOcupaciones">';

					    		html+= '</div>';
					    	*/

					    	//05-02-2020 IJENSEN AGREGADO
					    	html+= '<a href="'+response[i]['uri_occupation']+'" class="list-group-item list-group-item-action">'+response[i]['name_job_position']+'</a>';

				    	}
				    
			    	}else{
			    		html+= '<a class="list-group-item list-group-item-action">¡No existe información asociada a su búsqueda!</a>';
			    		html+= '<a class="list-group-item list-group-item-action">Por favor intente nuevamente.</a>';
			    	}
			    	
			    	$('#accordionOcupaciones').find('.list-group').html(html);
			    	

			    }
			});	
		}
		
	});

	$("#buscar_regiones").keyup(function(event) {

		var buscar_regiones = $("#buscar_regiones").val();
		if(buscar_regiones!=''){
			$.ajax({
			    type: "post",
			    dataType: "json",
			    url: dcms_vars.ajaxurl, // Pon aquí tu URL
			    data: {
			        action: "dcms_ajax_buscar_region",
			        buscar_regiones: buscar_regiones

			    },
			    error: function (response) {
			        console.log(response);
			    },
			    success: function (response) {
			    
			    	var i;
			    	var html = '';
			    	if(parseInt(response.length) > 0){
			    		for (i = 0;	i < response.length; i++) {
				    		html+= '<a href="'+response[i]['uri_region']+'" class="list-group-item list-group-item-action">'+response[i]['name_region']+'</a>';
				    	}
				    
			    	}else{
			    		html+= '<a class="list-group-item list-group-item-action">¡No existe información asociada a su búsqueda!</a>';
			    		html+= '<a class="list-group-item list-group-item-action">Por favor intente nuevamente.</a>';
			    	}
			    	
			    	$('#divRegiones').html(html);
			    	

			    }
			});	
		}
		
	});

	ajax_buscar_cursos('', '', '');

	$("#buscar_curso").keyup(function(event) {

		var buscar_curso = $("#buscar_curso").val();
		var nivel_curso = $("#nivel_curso").val();
		var region_id 		= $("#region_id").val();
		var ordenar_curso	= $("#ordenar_curso").val();
		
		if ($('#option1').is(":checked")) {
	        var modalidad_curso = $('#option1').val();
	    }else if ($('#option2').is(":checked")) {
	        var modalidad_curso = $('#option2').val();
	    }else{
	    	var modalidad_curso = '';
	    }
		
		ajax_buscar_cursos(buscar_curso, nivel_curso, modalidad_curso, 0, region_id, ordenar_curso);
		
	});

	$("#region_id").change(function(event) {

		var buscar_curso = $("#buscar_curso").val();
		var nivel_curso = $("#nivel_curso").val();
		var region_id 		= $("#region_id").val();
		var ordenar_curso	= $("#ordenar_curso").val();
		if ($('#option1').is(":checked")) {
	        var modalidad_curso = $('#option1').val();
	    }else if ($('#option2').is(":checked")) {
	        var modalidad_curso = $('#option2').val();
	    }else{
	    	var modalidad_curso = '';
	    }
		ajax_buscar_cursos(buscar_curso, nivel_curso, modalidad_curso, 0, region_id, ordenar_curso);
		
	});

	$("#ordenar_curso").change(function(event) {

		var buscar_curso = $("#buscar_curso").val();
		var nivel_curso = $("#nivel_curso").val();
		var region_id 		= $("#region_id").val();
		var ordenar_curso	= $("#ordenar_curso").val();
		if ($('#option1').is(":checked")) {
	        var modalidad_curso = $('#option1').val();
	    }else if ($('#option2').is(":checked")) {
	        var modalidad_curso = $('#option2').val();
	    }else{
	    	var modalidad_curso = '';
	    }
		ajax_buscar_cursos(buscar_curso, nivel_curso, modalidad_curso, 0, region_id, ordenar_curso);
		
	});


	$("#nivel_curso").change(function(event) {

		var buscar_curso = $("#buscar_curso").val();
		var nivel_curso = $("#nivel_curso").val();
		var region_id 		= $("#region_id").val();
		var ordenar_curso	= $("#ordenar_curso").val();
		if ($('#option1').is(":checked")) {
	        var modalidad_curso = $('#option1').val();
	    }else if ($('#option2').is(":checked")) {
	        var modalidad_curso = $('#option2').val();
	    }else{
	    	var modalidad_curso = '';
	    }
		ajax_buscar_cursos(buscar_curso, nivel_curso, modalidad_curso, 0, region_id, ordenar_curso);
		
	});

	$('input[type=radio][name=modalidad_curso]').change(function() {
    	var buscar_curso 	= $("#buscar_curso").val();
		var nivel_curso 	= $("#nivel_curso").val();
		var region_id 		= $("#region_id").val();
		var ordenar_curso	= $("#ordenar_curso").val();	
		if ($(this).is(":checked")) {
	        var modalidad_curso = $(this).val();
	    }else{
	    	var modalidad_curso = '';
	    }
		ajax_buscar_cursos(buscar_curso, nivel_curso, modalidad_curso, 0, region_id, ordenar_curso);
	});

});


function ajax_buscar_cursos(buscar_curso, nivel_curso, modalidad_curso, position_pag, region_id, ordenar_curso){

		//$("#title_curso").text('Cursos para "'+buscar_curso+' & '+nivel_curso+' & '+modalidad_curso+'"')

		if(buscar_curso=='' && nivel_curso=='' && modalidad_curso==''){
			$("#title_curso").hide();
		}else{
			$("#title_curso").show();
		}
		
		$('.bloque-listado-cursos').find('ul').html('<h1>Cargando...</h1>');
		$("#btn_paginator").html('');
		$("#buscar_curso").focus();
		
		$.ajax({
		    type: "post",
		    dataType: "json",
		    url: dcms_vars.ajaxurl, // Pon aquí tu URL
		    data: {
		        action: "dcms_ajax_buscar_curso",
		        buscar_curso: buscar_curso,
		        nivel_curso : nivel_curso,
		        modalidad_curso: modalidad_curso,
		        position_pag : position_pag,
		        region_id : region_id,
		        ordenar_curso : ordenar_curso

		    },
		    error: function (response) {
		        console.log(response);
		    },
		    success: function (response) {
		    
		    	var i;
		    	var html = '';
		    	if(parseInt(response[0].data.length) > 0){
		    		for (i = 0;	i < response[0].data.length; i++) {
		    			//console.log(response[0].data[9]['name_course']);
		    			//console.log(response[0].data[i]);
			    		//html+= '<a href="'+response[i]['uri_occupation']+'" class="list-group-item list-group-item-action">'+response[i]['name_occupation']+'</a>';
			    		html+= '<li>';
			    		html+= '<a class="titular">'+response[0].data[i]['name_course']+'</a>';
			    		html+= '<p style="text-align: justify;">'+response[0].data[i]['description']+'</p>';
			    		html+= '<p style="text-align: justify;">'+response[0].data[i]['overall_objective']+'</p>';
			    		html+= '<p class="datos"><i class="iconcl-curso-online"></i> '+response[0].data[i]['modality']+'</p>';
			    		html+= '<p class="datos"><i class="iconcl-curso-horas"></i>'+response[0].data[i]['duration']+' hrs.</p>';
			    		html+= '<p class="datos"><i class="iconcl-curso-fechas"></i> '+response[0].data[i]['status']+' </p>';
			    		html+= '<p class="datos"><i class="iconcl-curso-precio"></i> '+response[0].data[i]['price']+'</p>';
			    		html+= '<a href="http://'+response[0].data[i]['url']+'" target="_blank" class="btn btn-yellow">Más información</a>';
			    		html+= '</li>';
			    	}
			    
		    	}else{
		    		//html+= '<a class="list-group-item list-group-item-action">¡No existe información asociada a su búsqueda!</a>';
		    		//html+= '<a class="list-group-item list-group-item-action">Por favor intente nuevamente.</a>';
		    	}
		    	
		    	$('.bloque-listado-cursos').find('ul').html(html);

		    	//Pagination
		    	//console.log(response[0].pagination['total_rows']);
		    	var total_rows 		= response[0].pagination['total_rows'];
		    	var cant_pagina 	= response[0].pagination['cant_pagina'];
		    	var position_pag 	= response[0].pagination['position_pag'];
		    	var buscar_curso 	= response[0].pagination['buscar_curso'];
		    	var nivel_curso 	= response[0].pagination['nivel_curso'];
		    	var modalidad_curso = response[0].pagination['modalidad_curso'];
		    	var region_id		= response[0].pagination['region_id'];
		    	var total_paginas 	= Math.round(parseInt(total_rows) / parseInt(cant_pagina));
		    	
		    	//para calcular registros en label
		    	if(position_pag==0){
		    		position_start	= (parseInt(position_pag)+1);
		    		position_stop 	= parseInt(position_start)*parseInt(cant_pagina);
		    	}else{
		    		position_start	= (parseInt(1)+(parseInt(cant_pagina)*parseInt(position_pag)));
		    		// position_stop 	= (parseInt(position_pag)+1)*parseInt(cant_pagina);
		    		position_stop 	= (parseInt(position_pag)+1)*parseInt(cant_pagina);
		    		if(position_stop > total_rows){
		    			position_stop  = total_rows;
		    		}
		    	}
		    	
		    	
		    	var html_button 	= '';

		    	if(parseInt(total_paginas)>1){
		    		
		    		html_button += '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">';
		    			html_button += '<div class="btn-group mr-2" role="group" aria-label="First group">';
		    			if(position_pag==0){
		    				html_button += '<button type="button" class="btn btn-secondary" disabled="disabled">&laquo</button>';
		    			}else{
		    				html_button += '<button type="button" onclick="ajax_buscar_cursos(\''+buscar_curso+'\', \''+nivel_curso+'\', \''+modalidad_curso+'\', '+(parseInt(position_pag)-1)+', \''+region_id+'\')" class="btn btn-secondary">&laquo</button>';
		    			}
		    			html_button += '</div>';
		    			html_button += '<div class="btn-group mr-2" role="group" aria-label="Second group">';
		    		if(position_pag==0){
		    			for(c = 0; c < total_paginas ; c++){
			    			if(c <= 6){
			    				if(c==0){
			    					html_button += '<button type="button" onclick="ajax_buscar_cursos(\''+buscar_curso+'\', \''+nivel_curso+'\', \''+modalidad_curso+'\', '+c+', \''+region_id+'\')" class="btn btn-secondary active">'+(parseInt(c)+1)+'</button>';
			    				}else{
			    					html_button += '<button type="button" onclick="ajax_buscar_cursos(\''+buscar_curso+'\', \''+nivel_curso+'\', \''+modalidad_curso+'\', '+c+', \''+region_id+'\')" class="btn btn-secondary">'+(parseInt(c)+1)+'</button>';
			    				}
			    			}

			    		}
		    		}else{
		    			if(parseInt(position_pag)>2){
		    				contador = parseInt(position_pag)-3;	
		    			}else{
		    				contador = parseInt(position_pag)-1;
		    			}
		    			//console.log((parseInt(total_paginas)+parseInt(0)));

		    			for(c = contador; c < (parseInt(total_paginas)+parseInt(0)) ; c++){
					    	
			    			if(c <= (parseInt(contador)+6)){
			    				if(c==position_pag){
			    					html_button += '<button type="button" onclick="ajax_buscar_cursos(\''+buscar_curso+'\', \''+nivel_curso+'\', \''+modalidad_curso+'\', '+c+', \''+region_id+'\')" class="btn btn-secondary active">'+(parseInt(c)+1)+'</button>';
			    				}else{
			    					html_button += '<button type="button" onclick="ajax_buscar_cursos(\''+buscar_curso+'\', \''+nivel_curso+'\', \''+modalidad_curso+'\', '+c+', \''+region_id+'\')" class="btn btn-secondary">'+(parseInt(c)+1)+'</button>';
			    				}				    				
			    			}

			    		}
		    		}
		    		
		    			html_button += '</div>';
		    			html_button += '<div class="btn-group" role="group" aria-label="Third group">';
		    			//console.log(total_paginas+' - '+position_pag)
		    			if(total_paginas==(parseInt(position_pag)+1)){

		    				html_button += '<button type="button" class="btn btn-secondary" disabled="disabled">&raquo</button>';
		    			}else{
		    				html_button += '<button type="button" onclick="ajax_buscar_cursos(\''+buscar_curso+'\', \''+nivel_curso+'\', \''+modalidad_curso+'\', '+(parseInt(position_pag)+1)+', \''+region_id+'\')" class="btn btn-secondary">&raquo</button>';
		    			}
		    			html_button += '</div>';
		    			html_button += '&nbsp;&nbsp;<label>Mostrando desde '+position_start+' hasta '+position_stop+' de '+total_rows+' registros</label>'; 
	    			html_button += '</div>';


	    			$("#btn_paginator").html(html_button);
		    	}
		    	

		    }
		});	
			
}

function fn_buscar_ocupacion(id_occupation){
	if(id_occupation!=''){
		$('#collapse'+id_occupation).html('');
		$.ajax({
		    type: "post",
		    dataType: "json",
		    url: dcms_vars.ajaxurl, // Pon aquí tu URL
		    data: {
		        action: "dcms_ajax_buscar_subocupacion",
		        id_occupation: id_occupation

		    },
		    error: function (response) {
		        console.log(response);
		    },
		    success: function (response) {
		    
		    	var i;
		    	var html = '';
		    	console.log(response);
		    	if(parseInt(response.length) > 0){
		    		for (i = 0;	i < response.length; i++) {
			    		html+= '<a href="'+response[i]['uri_occupation']+'" class="list-group-item list-group-item-action">'+response[i]['name_job_position']+'</a>';

			    	}
			    
		    	}else{
		    		html+= '<a class="list-group-item list-group-item-action">¡No existe información asociada a su búsqueda!</a>';
		    		html+= '<a class="list-group-item list-group-item-action">Por favor intente nuevamente.</a>';
		    	}
		    	
		    	$('#collapse'+id_occupation).html(html);
		    	

		    }
		});	
	}
}