<?php 

defined('ABSPATH') or die("Bye bye");

function create_indicator_preview($id){
	switch($id){

		//casen
        case 47:  	$result = indefinite_contract(); break;
        case 141: 	$result = salary_avg(); break;
        case 60:  	$result = female_percentage_sql(); break;
        case 151:  	$result = topfiveCrecimiento(); break;
        case 152:  	$result = menorCrecimiento(); break;
        case 46:    $result = ranking_occupied(); break;

        //afc
		case 58: 	$result = participation_percent_by_sector('mayor', 'mujeres', 58); break;
		case 59: 	$result = participation_percent_by_sector('menor', 'mujeres', 59); break;
		case 56: 	$result = participation_percent_by_sector('mayor', 'migrantes',136); break;
		case 57: 	$result = participation_percent_by_sector('menor', 'migrantes', 137); break;
		case 50: 	$result = indefinite_contracts(); break;
        
		case 51: 	$result = indefinite_percent_variation('alza'); break;
		case 52: 	$result = indefinite_percent_variation('baja'); break;
        case 48: 	$result = occupied_variation('alza'); break;
        case 49: 	$result = occupied_variation('baja'); break;
		case 1:     $result = occupied_variation('baja', true); break;
        case 2:     $result = occupied_variation('alza', true); break;
   }

   return $result;
}

add_action( 'wp_ajax_save_indicator', 'save_indicator' );

function save_indicator($id){
    global $wpdb;
    $id = $_POST['id'];

    //Limpiar el id en caso que venga con '-''
    if(strpos($id, '-')){
        $pos = strrpos($id, "-");
        $indicator_id = intval(substr($id,0,$pos)); 
    }else{
        $indicator_id = $id;
    }
    //Obtener variable de sesiones creada en create_ind.php con todos los indicadores
    $indicators = $_SESSION['indicators'];
    //Obtener el indicador específico mediante el id
    $indicator = $indicators[$id];

    $data = array(
                'id_indicator_type' => $indicator_id, 
                'name_indicator'    => $indicator['name'],
                'status'            => true,
                'data'              => json_encode($indicator),
                'created_at'        => date('Y-m-d'),
                'updated_at'        => date('Y-m-d'),
    );

    if( $wpdb->insert('cl_indicators', $data, array('%s','%s','%s','%s','%s','%s') ) ){
         echo json_encode(1);
    }else{
        echo json_encode($wpdb->last_error);
    }
   
    wp_die();
   
}

