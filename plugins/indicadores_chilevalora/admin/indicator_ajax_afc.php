<?php

    defined('ABSPATH') or die("Bye bye");

    add_action('wp_ajax_generate_dumy', 'dummy_data');

    add_action('wp_ajax_create_indicator', 'create_indicator');
    

    function create_indicator(){
       // TODO en tabla cl_indicator_types falta columna que diferencie si es mayor o menor porcentaje
       // Por ahora se valida esto con el id del indicador

       switch($_GET['indicator_type']){

           case 21: participation_percent_by_sector('mayor', 'mujeres'); break;
           case 22: participation_percent_by_sector('menor', 'mujeres'); break;
           case 17: participation_percent_by_sector('mayor', 'migrantes'); break;
           case 18: participation_percent_by_sector('menor', 'migrantes'); break;
           case 1:  indefinite_contracts(); break;
           case 9:  indefinite_percent_variation('alza'); break;
           case 10: indefinite_percent_variation('baja'); break;
           case 3:  occupied_variation('alza'); break;
           case 6:  occupied_variation('baja'); break;
          
       }
    }

    function occupied_variation($tendency, $regional = false){

        global $wpdb;

        $array_response = array(array());
        
        //Respuesta general
        $response = '%s es el sector %s en número de ocupados %s';

        //Definir order de la query y trend para el sprintf
        if($tendency == 'baja'){
            $orderby =  'ASC';
            $trend = 'a la baja';
        }else{
            $orderby =  'DESC';
            $trend = 'al alza';
        }

        $lastyear = date('Y') - 1;
        $firstyear = $lastyear - 1;

        $lastyear_period = "ano = '$lastyear'";
        $firstyear_period = "ano = '$firstyear'";

        //Si es para regional
        if( $regional ){

            $results = array();

            $regions = $wpdb->get_results("SELECT id_region, code_region, name_region
                                            FROM cl_regions");

                $count = 0;

                foreach ($regions as $region) {

                    $description = $wpdb->get_results(regional_occupied_variation_sql($lastyear_period, $firstyear_period, $orderby, $region->id_region));

                    $region_text = sprintf('en la región de %s', $region->name_region);

                    if(!empty($description[0]->name_sector)){

                        array_push($results, sprintf($response, $description[0]->name_sector, $trend, $region_text) );
                        
                        $array_response[$count]['type'] = 'text';
                        $array_response[$count]['data']['description'] = sprintf($response, $description[0]->name_sector, $trend, $region_text);
                       
                    }

                    $count++;
                    
                }

        }else{ //Es para nacional

            $results = $wpdb->get_results(national_occupied_variation_sql($lastyear_period, $firstyear_period, $orderby));

            $array_response[0]['type'] = 'text';
            $array_response[0]['data']['description'] = sprintf($response, $results[0]->name_sector, $trend, 'a nivel nacional');

        }

        return $array_response;

    }

    function indefinite_contracts(){
        global $wpdb;
        $query;
        $range_text;
       
        switch(1){
            case 1:
                $last_year = date('Y') - 1;
                $time_period = "ano = '$last_year'";
                if($_GET['region_id']){
                    $query = regional_indefinite_contracts_sql($time_period);
                } else {
                    $query = national_indefinite_contracts_sql($time_period);
                }
            break;
            case 2:
                $from = date('Ym', strtotime('-3 month'));
                $to = date('Ym', strtotime('-1 month'));
                $dates_period = $wpdb->get_results("SELECT TO_DATE('$from', 'YYYYMM') AS desde, TO_DATE('$to', 'YYYYMM') AS hasta");
                $time_period = "TO_DATE(CONCAT(ano,mes), 'YYYYMM') BETWEEN '{$dates_period[0]->desde}' AND '{$dates_period[0]->hasta}'";
                if($_GET['region_id']){
                    $query = regional_indefinite_contracts_sql($time_period);
                } else {
                    $query = national_indefinite_contracts_sql($time_period);
                }
            break;
        }

        $indicator = array(
            'categoria' => 'texto',        
            'tipo_post' => 'sector'
        );

        $results = $wpdb->get_results($query);
        
        if($results){

            $indicator['numero'] = $results[0]->porcentaje;
            $indicator['texto'] = $results[0]->porcentaje . '%';

            $indicator_template = $wpdb->get_results("SELECT template FROM cl_indicator_section_template WHERE id_indicator_type = {$_GET['indicator_type']}");

            //$template = $indicator_template[0]->template;

            $template = '%s%% Porcentaje de contratos indefinidos el último trimestre';

            if($_GET['region_id']){
                $indicator['descripcion'] = sprintf($template, $results[0]->porcentaje, $results[0]->name_sector, 'en la ' . $results[0]->name_region, $results[0]->porcentaje);
            } else {
                $indicator['descripcion'] = sprintf($template, $results[0]->porcentaje, $results[0]->name_sector, 'a nivel nacional', $results[0]->porcentaje);
            }

            // campos de la tabla indicators para no volver a hacer la query al guardar
            $table_data = array(
                'id_indicator_type' => (int)$_GET['indicator_type'],
                'name_indicator' => sprintf('Porcentaje de contratos indefinidos el último trimestre en la %s', $range_text),
                'data' => json_encode($indicator),
                'page_asoc' => 0,
                'status' => 'true'
            );
    
            // Guardar en $_SESSION el resultado para ser guardado a la bdd despues que el usuario acepte guardarlo
            $tmp_id = time();
            $_SESSION['indicator_tmp_id_' . $tmp_id] = $table_data;
            
            // Entregar los datos del indicador + el id temporal para enviarlo en ajax al guardado
            $indicator['tmp_id'] = $tmp_id;
        } else {
            $indicator['descripcion'] = 'No existen resultados para la solicitud';
        }

        return $indicator['descripcion'];
        
    }

    function indefinite_percent_variation($tendency){

        global $wpdb;
        $query;
        $range_text;

        //$orderby = $tendency == 'baja' ? 'ASC' : 'DESC';

        if($tendency == 'baja'){
            $orderby = 'ASC';
            $response = '%s es el sector a la baja en contratos indefinidos';
        }else{
            $orderby = 'DESC';
            $response = '%s es el sector al alza en contratos indefinidos';
        }

        switch(1){

            case 1:

                $lastyear = date('Y') - 1;
                $firstyear = $lastyear - 1;
                if($_GET['region_id']){
                    $query = regional_indefinite_percent_variation_sql($firstyear, $lastyear, $orderby);
                } else {
                    $query = national_indefinite_percent_variation_sql($firstyear, $lastyear, $orderby);
                }

            break;

            case 2:
                $from = date('Ym', strtotime('-3 month'));
                $to = date('Ym', strtotime('-1 month'));
                // query para dar formato a la fecha
                $dates_period = $wpdb->get_results("SELECT TO_DATE('$from', 'YYYYMM') AS desde, TO_DATE('$to', 'YYYYMM') AS hasta");
                $time_period = "TO_DATE(CONCAT(ano,mes), 'YYYYMM') BETWEEN '{$dates_period[0]->desde}' AND '{$dates_period[0]->hasta}'";
                if($_GET['region_id']){
                    $query = regional_indefinite_percent_variation_sql($time_period, $orderby);
                } else {
                    $query = national_indefinite_percent_variation_sql($time_period, $orderby);
                }
            break;
        }

        $indicator = array(
            'categoria' => 'texto',        
            'tipo_post' => 'sector'
        );

        $results = $wpdb->get_results($query);

        if($results){

            $indicator['numero'] = $results[0]->porcentaje;
            $indicator['texto'] = $results[0]->porcentaje . '%';

            $indicator_template = $wpdb->get_results("SELECT template FROM cl_indicator_section_template WHERE id_indicator_type = {$_GET['indicator_type']}");
            
            if($indicator_template){
                $template = $indicator_template[0]->template;
            }else{
                $template = $response;
            }
            

            if($_GET['region_id']){
                $range_text = sprintf('en la %s', $results[0]->name_region);
                $indicator['descripcion'] = sprintf($template, $results[0]->name_sector, $range_text);
            } else {
                $range_text = 'a nivel nacional';
                $indicator['descripcion'] = sprintf($template, $results[0]->name_sector, $range_text);
            }

            // campos de la tabla indicators para no volver a hacer la query al guardar
            $table_data = array(
                'id_indicator_type' => (int)$_GET['indicator_type'],
                'name_indicator' => sprintf('Porcentaje de contratos indefinidos el último trimestre en la %s', $range_text),
                'data' => json_encode($indicator),
                'page_asoc' => 0,
                'status' => 'true'
            );
    
            // Guardar en $_SESSION el resultado para ser guardado a la bdd despues que el usuario acepte guardarlo
            $tmp_id = time();
            $_SESSION['indicator_tmp_id_' . $tmp_id] = $table_data;
            
            // Entregar los datos del indicador + el id temporal para enviarlo en ajax al guardado
            $indicator['tmp_id'] = $tmp_id;
        } else {
            $indicator['descripcion'] = 'No existen resultados para la solicitud';
        }

       return $indicator['descripcion'];
       
    }

    
    
    function participation_percent_by_sector($sign, $field,$indicator_id, $time_interval = false){

        global $wpdb;

        $orderby = $sign == 'mayor' ? 'DESC' : 'ASC';

        switch($field){
            case 'migrantes': $conditional_field = 'cl_afc.id_nacionality = 2'; break;
            case 'mujeres': $conditional_field = 'cl_afc.id_sex = 2'; break;
        }
       
        $query =  national_participation_query($orderby, $conditional_field);

        $results = $wpdb->get_results($query);

        if($results){

            $indicator_template = $wpdb->get_results("SELECT template FROM cl_indicator_section_template WHERE id_indicator_type = {$indicator_id}");

            $template = $indicator_template[0]->template;

            if($_GET['region_id']){

                // formato ejemplo: %s es el sector con mayor porcentaje de mujeres %s, con un %s%% el último año
                $range_text = sprintf('en la %s', $results[0]->name_region);

                $indicator['descripcion'] = sprintf($template, $results[0]->name_sector, $range_text, $results[0]->porcentaje);

            } else {
                $range_text = 'a nivel nacional';

                $indicator['descripcion'] = sprintf($template, $results[0]->name_sector, $range_text, $results[0]->porcentaje);
            }

            // campos de la tabla indicators para no volver a hacer la query al guardar
          
    
           
        } else {
            $indicator['descripcion'] = 'No existen resultados para la solicitud';
        }

        //mostrar indicador con ajax
        return $indicator['descripcion'];
       
        
    }
    /*
    function save_indicator(){
        global $wpdb;

        // Crear insert manual para traer el id insertado. No funciona $wpdb->insert_id con postgres
        $data = $_SESSION['indicator_tmp_id_' . $_GET['tmp_id']];
        $wpdb->insert('cl_indicators', $data);
        $get_sequence = $wpdb->get_results("SELECT currval('cl_indicators_id_indicator_seq')");
        $indicator_id = $get_sequence[0]->currval;
        if($indicator_id){
            echo json_encode(array('success' => TRUE, 'id' => $indicator_id));
        } else {
            echo json_encode(array('success' => FALSE));
        }
        exit();
    }*/

    function regional_participation_query($orderby, $conditional_field){
        $query = "SELECT top_sector.name_sector, ROUND((top_sector.total_sector * 100.0 / (SELECT SUM(number_workers) AS total FROM cl_afc WHERE ano = (SELECT MAX(ano) FROM cl_afc) AND cl_afc.id_region_employment = {$_GET['region_id']})), 1) AS porcentaje, top_sector.name_region
        FROM 
        (
            SELECT cl_sectors.id_sector, cl_sectors.name_sector, SUM(number_workers) as total_sector, cl_regions.name_region
            FROM cl_afc
            LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
            LEFT JOIN cl_class  on cl_class.id_class = cl_subclass.id_class
            LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
            LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
            LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector
            LEFT JOIN cl_regions ON cl_regions.id_region = cl_afc.id_region_employment
            WHERE $conditional_field
            AND ano = (SELECT MAX(ano) FROM cl_afc)
            AND  cl_afc.id_region_employment = {$_GET['region_id']}
            GROUP BY cl_sectors.id_sector, cl_regions.name_region
            ORDER BY total_sector {$orderby}
            LIMIT 1
        ) AS top_sector";

        return $query;
    }

    function national_participation_query($orderby, $conditional_field){
        $query =  "SELECT top_sector.name_sector, ROUND((top_sector.total_sector * 100.0 / (SELECT SUM(number_workers) FROM cl_afc WHERE ano = (SELECT MAX(ano) FROM cl_afc))), 1) AS porcentaje
        FROM 
        (
            SELECT cl_sectors.id_sector, cl_sectors.name_sector, SUM(number_workers) as total_sector
            FROM cl_afc
            LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
            LEFT JOIN cl_class  on cl_class.id_class = cl_subclass.id_class
            LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
            LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
            LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector
            WHERE $conditional_field
            AND ano = (SELECT MAX(ano) FROM cl_afc)
            GROUP BY cl_sectors.id_sector
            ORDER BY total_sector $orderby
            LIMIT 1
        ) AS top_sector";

        return $query;
    }

    function regional_indefinite_contracts_sql($time_period){
        $query = "SELECT top_sector.name_sector, ROUND((top_sector.total_sector * 100.0 / (SELECT SUM(number_workers) AS total FROM cl_afc WHERE $time_period AND cl_afc.id_region_employment = {$_GET['region_id']})), 1) AS porcentaje, top_sector.name_region
        FROM 
        (
            SELECT cl_sectors.id_sector, cl_sectors.name_sector, SUM(number_workers) as total_sector, cl_regions.name_region
            FROM cl_afc
            LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
            LEFT JOIN cl_class  on cl_class.id_class = cl_subclass.id_class
            LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
            LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
            LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector
            LEFT JOIN cl_regions ON cl_regions.id_region = cl_afc.id_region_employment
            WHERE id_contract_type = 1
            AND $time_period
            AND  cl_afc.id_region_employment = {$_GET['region_id']}
            GROUP BY cl_sectors.id_sector, cl_regions.name_region
            ORDER BY total_sector DESC
            LIMIT 1
        ) AS top_sector";

        return $query;
    }

    function national_indefinite_contracts_sql($time_period){
        $query =  "SELECT top_sector.name_sector, ROUND((top_sector.total_sector * 100.0 / (SELECT SUM(number_workers) FROM cl_afc WHERE $time_period)), 1) AS porcentaje
        FROM 
        (
            SELECT cl_sectors.id_sector, cl_sectors.name_sector, SUM(number_workers) as total_sector
            FROM cl_afc
            LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
            LEFT JOIN cl_class  on cl_class.id_class = cl_subclass.id_class
            LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
            LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
            LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector
            WHERE id_contract_type = 1
            AND $time_period
            GROUP BY cl_sectors.id_sector
            ORDER BY total_sector DESC
            LIMIT 1
        ) AS top_sector";

        return $query;
    }

    function national_indefinite_percent_variation_sql($firstyear, $lastyear, $orderby = 'DESC'){
        $query = "SELECT top_sector.name_sector, (
            ROUND(
                (
                    top_sector.total_sector * 100.0 / (SELECT SUM(number_workers)
                    FROM cl_afc 
                    WHERE ano = '$lastyear')), 1) - 
            ROUND(
                (
                    top_sector2.total_sector * 100.0 / (SELECT SUM(number_workers)
                    FROM cl_afc 
                    WHERE ano = '$firstyear')), 1)
                ) as porcentaje
            FROM ( 
                    SELECT cl_sectors.id_sector, cl_sectors.name_sector, SUM(number_workers) as total_sector 
                    FROM cl_afc 
                    LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
                    LEFT JOIN cl_class on cl_class.id_class = cl_subclass.id_class
                    LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
                    LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
                    LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector 
                    WHERE id_contract_type = 1 
                    AND ano = '$lastyear'
                    GROUP BY cl_sectors.id_sector
            ) AS top_sector
            LEFT JOIN ( 
                    SELECT cl_sectors.id_sector, SUM(number_workers) as total_sector 
                    FROM cl_afc 
                    LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
                    LEFT JOIN cl_class on cl_class.id_class = cl_subclass.id_class
                    LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
                    LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
                    LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector 
                    WHERE id_contract_type = 1 
                    AND ano = '$firstyear'
                    GROUP BY cl_sectors.id_sector
            ) AS top_sector2 ON top_sector2.id_sector = top_sector.id_sector
            ORDER BY porcentaje $orderby
            LIMIT 1";
            return $query;
    }

    function regional_indefinite_percent_variation_sql($firstyear, $lastyear, $orderby = 'DESC'){
        $query = "SELECT top_sector.name_sector, (
            ROUND(
                (
                    top_sector.total_sector * 100.0 / (SELECT SUM(number_workers)
                    FROM cl_afc 
                    WHERE ano = '$lastyear' AND  AND cl_afc.id_region_employment = {$_GET['region_id']})), 1) - 
            ROUND(
                (
                    top_sector2.total_sector * 100.0 / (SELECT SUM(number_workers)
                    FROM cl_afc 
                    WHERE ano = '$firstyear' AND  AND cl_afc.id_region_employment = {$_GET['region_id']})), 1)
                ) as porcentaje
            FROM ( 
                    SELECT cl_sectors.id_sector, cl_sectors.name_sector, SUM(number_workers) as total_sector 
                    FROM cl_afc 
                    LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
                    LEFT JOIN cl_class on cl_class.id_class = cl_subclass.id_class
                    LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
                    LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
                    LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector 
                    WHERE id_contract_type = 1 
                    AND ano = '$lastyear'
                    AND cl_afc.id_region_employment = {$_GET['region_id']}
                    GROUP BY cl_sectors.id_sector
            ) AS top_sector
            LEFT JOIN ( 
                    SELECT cl_sectors.id_sector, SUM(number_workers) as total_sector 
                    FROM cl_afc 
                    LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
                    LEFT JOIN cl_class on cl_class.id_class = cl_subclass.id_class
                    LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
                    LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
                    LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector 
                    WHERE id_contract_type = 1 
                    AND ano = '$firstyear'
                    AND cl_afc.id_region_employment = {$_GET['region_id']}
                    GROUP BY cl_sectors.id_sector
            ) AS top_sector2 ON top_sector2.id_sector = top_sector.id_sector
            ORDER BY porcentaje $orderby
            LIMIT 1";
            return $query;
    }

    function national_occupied_variation_sql($lastyear_period, $firstyear_period, $orderby = 'DESC'){
        $query = "SELECT top_sector.name_sector, (
            ROUND(
                (
                    top_sector.total_sector * 100.0 / (SELECT SUM(number_workers)
                    FROM cl_afc 
                    WHERE $lastyear_period)), 1) - 
            ROUND(
                (
                    top_sector2.total_sector * 100.0 / (SELECT SUM(number_workers)
                    FROM cl_afc 
                    WHERE $firstyear_period)), 1)
                ) as porcentaje
            FROM ( 
                    SELECT cl_sectors.id_sector, cl_sectors.name_sector, SUM(number_workers) as total_sector 
                    FROM cl_afc 
                    LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
                    LEFT JOIN cl_class on cl_class.id_class = cl_subclass.id_class
                    LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
                    LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
                    LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector 
                    WHERE $lastyear_period
                    GROUP BY cl_sectors.id_sector
            ) AS top_sector
            LEFT JOIN ( 
                    SELECT cl_sectors.id_sector, SUM(number_workers) as total_sector 
                    FROM cl_afc 
                    LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
                    LEFT JOIN cl_class on cl_class.id_class = cl_subclass.id_class
                    LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
                    LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
                    LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector 
                    WHERE $firstyear_period
                    GROUP BY cl_sectors.id_sector
            ) AS top_sector2 ON top_sector2.id_sector = top_sector.id_sector
            ORDER BY porcentaje $orderby
            LIMIT 1";
            return $query;
    }

    function regional_occupied_variation_sql($lastyear_period, $firstyear_period, $orderby = 'DESC', $region){
        

        $query = "SELECT top_sector.name_sector, (
            ROUND(
                (
                    top_sector.total_sector * 100.0 / (SELECT SUM(number_workers)
                    FROM cl_afc 
                    WHERE $lastyear_period AND cl_afc.id_region_employment = {$region})), 1) - 
            ROUND(
                (
                    top_sector2.total_sector * 100.0 / (SELECT SUM(number_workers)
                    FROM cl_afc 
                    WHERE $firstyear_period AND cl_afc.id_region_employment = {$region})), 1)
                ) as porcentaje
            FROM ( 
                    SELECT cl_sectors.id_sector, cl_sectors.name_sector, SUM(number_workers) as total_sector 
                    FROM cl_afc 
                    LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
                    LEFT JOIN cl_class on cl_class.id_class = cl_subclass.id_class
                    LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
                    LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
                    LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector 
                    WHERE $lastyear_period
                    AND cl_afc.id_region_employment = {$region}
                    GROUP BY cl_sectors.id_sector
            ) AS top_sector
            LEFT JOIN ( 
                    SELECT cl_sectors.id_sector, SUM(number_workers) as total_sector 
                    FROM cl_afc 
                    LEFT JOIN cl_subclass on cl_subclass.id_subclass = cl_afc.id_subclass
                    LEFT JOIN cl_class on cl_class.id_class = cl_subclass.id_class
                    LEFT JOIN cl_groups on cl_groups.id_group = cl_class.id_group
                    LEFT JOIN cl_divisions on cl_divisions.id_division = cl_groups.id_division
                    LEFT JOIN cl_sectors ON cl_sectors.id_sector = cl_divisions.id_sector 
                    WHERE $firstyear_period
                    AND cl_afc.id_region_employment = {$region}
                    GROUP BY cl_sectors.id_sector
            ) AS top_sector2 ON top_sector2.id_sector = top_sector.id_sector
            ORDER BY porcentaje $orderby
            LIMIT 1";
            return $query;
    }

?>