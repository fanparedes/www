<?php 
if (!current_user_can ('manage_options')) wp_die (__ ('No tienes suficientes permisos para acceder a esta página.'));

if(isset( $_GET['ind'] ) && is_numeric($_GET['ind'])){

	$ind = $_GET['ind'];

	global $wpdb;
	//AFC, CASEN, ETC
	$origins = $wpdb->get_results("SELECT id_data_origin, origin FROM cl_data_origins", OBJECT);

	foreach ($origins as $origin) {

		$types_indicators = $wpdb->get_results("
			SELECT cli.id_indicator_type, cli.name_indicator_type 
				FROM cl_indicator_types cli 
				INNER JOIN cl_indicator_type_origin clito 
				ON cli.id_indicator_type = clito.id_indicator_type 
			WHERE cli.id_indicator_section = " . $ind . " AND clito.id_data_origin = " . $origin->id_data_origin . "", OBJECT);

		if($types_indicators){

			$total_indicators = array();

			$html .= 	'<div class="container-fluid">';

			$html .= 	'<h2>Fuente de datos ' . $origin->origin . '</h2>';

			$html .=	'<hr>';

			$html .= 	'<table class="table data-table table-stripped">';
				$html .= 	'<thead>';
					$html .= 	'<tr>';
					$html .= 	'<td>';
							$html .= 	'ID';
						$html .= 	'</td>';
						$html .= 	'<td>';
							$html .= 	'Descripción de indicador';
						$html .= 	'</td>';
						$html .= 	'<td>';
							$html .= 	'Resultado';
						$html .= 	'</td>';
						$html .= 	'<td>';
							$html .= 	'Estado';
						$html .= 	'</td>';
						$html .= 	'<td>';
							$html .= 	'Acciones';
						$html .= 	'</td>';
					$html .= 	'</tr>';
				$html .= 	'</thead>';
				$html .= 	'<tbody>';

				foreach($types_indicators as $indicator){

					$results = create_indicator_preview($indicator->id_indicator_type);

					print_r($results);

					if(is_array($results) && sizeof($results) > 2){

						$count = 1;

						foreach ($results as $result) {
							
							$html .= 	'<tr>';
								
								$html .= 	'<td>';
									$html .= $indicator->id_indicator_type;
								$html .= 	'</td>';
								$html .= 	'<td>';
									$html .= $indicator->name_indicator_type;
								$html .= 	'</td>';
								$html .= 	'<td>';

								//Como habrán varios con el mismo id, se le añade un guión con contador
								$ind_key = $indicator->id_indicator_type . '-' . $count;
								
								$total_indicators[$ind_key];
								$total_indicators[$ind_key]['name'] = $indicator->name_indicator_type;
								$total_indicators[$ind_key]['type'] = $result['type'];
								$total_indicators[$ind_key]['data']['description'] = $result['data']['description'];
									$html .= $result['data']['description'];
								$html .= 	'</td>';
								$html .= 	'<td class="td-status">';
									$html .= 	'No publicado';
								$html .= 	'</td>';
								$html .= 	'<td>';
									$html .= 	'<button id="' . $ind_key . '" type="submit" class="btn-success btn btn-block btn-publish-indicator">Publicar</button>';
								$html .= 	'</td>';
								
							$html .= 	'</tr>';
							$count++;
						}

					}else{

						$html .= 	'<tr>';
							
							$html .= 	'<td>';
								$html .= $indicator->id_indicator_type;
							$html .= 	'</td>';
							$html .= 	'<td>';
								$html .= $indicator->name_indicator_type;
							$html .= 	'</td>';
							$html .= 	'<td>';

							$ind_key = $indicator->id_indicator_type;

							$total_indicators[$ind_key];
							$total_indicators[$ind_key]['name'] = $indicator->name_indicator_type;
							$total_indicators[$ind_key]['type'] = $results[0]['type'];
							$total_indicators[$ind_key]['data']['description'] = $results[0]['data']['description'];

								$html .= $results[0]['data']['description'];

							$html .= 	'</td>';
							$html .= 	'<td class="td-status">';
								$html .= 	'No publicado';
							$html .= 	'</td>';
							$html .= 	'<td>';
								$html .= 	'<button id="' . $ind_key . '" class="btn-success btn btn-block btn-publish-indicator">Publicar</button>';
							$html .= 	'</td>';
							
						$html .= 	'</tr>';
					}

				}

				$html .= 	'</tbody>';

			$html .= 	'</table>';

			$html .= 	'</div>';

		}

	}

	echo $html;
	
}

session_start();
$_SESSION['indicators'] = $total_indicators;

?>
