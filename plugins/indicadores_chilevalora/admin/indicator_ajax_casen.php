<?php

    defined('ABSPATH') or die("Bye bye");

  

    function salary_avg(){

        global $wpdb;
        
        $array_response = array(array());

        $occupations = $wpdb->get_results("
            SELECT id_occupation, name_occupation
            FROM cl_occupations
        ", OBJECT);

        if($occupations){
            $count = 0;
            foreach($occupations as $occupation){

                $results = $wpdb->get_results("
                    SELECT round(avg(clb.median_salary_occupied)) as salary, clo.name_occupation
                    FROM cl_busy_casen clb
                    inner join cl_occupations clo on clb.id_occupation = clo.id_occupation
                    WHERE clb.id_occupation = " . $occupation->id_occupation . "
                    group by clo.name_occupation
                ", OBJECT);

                if( !empty($results[0]->name_occupation) ){
                    $array_response[$count]['type'] = 'text';
                    $array_response[$count]['data']['description'] = sprintf('%s presenta una mediana salarial del %s a nivel nacional en el último periodo.', $results[0]->name_occupation, $results[0]->salary );
                }
                
                $count++;
            }

        }
        
        return $array_response;

    }

    function ranking_occupied(){
        global  $wpdb;
        $results = $wpdb->get_results("SELECT cl_occupations.name_occupation nombre ,  cl_busy_casen.number_occupied * 100.0 / 
        (SELECT SUM(number_occupied) FROM cl_busy_casen  WHERE ano = (SELECT MAX(ano)FROM cl_busy_casen)) cantidad
                FROM cl_busy_casen
                LEFT JOIN cl_occupations ON cl_busy_casen.id_occupation = cl_occupations.id_occupation
                WHERE ano = (SELECT MAX(ano)FROM cl_busy_casen)
                GROUP BY nombre, cantidad
                ORDER BY cantidad DESC
                limit 3", OBJECT);

                $description = sprintf('%s presenta un porcentaje de ocupados del %s a nivel nacional en el último periodo.<br/> 
                %s presenta un porcentaje de ocupados del %s a nivel nacional en el último periodo<br/>
                %s presenta un porcentaje de ocupados del %s a nivel nacional en el último periodo', 
                $results[0]->nombre, $results[0]->cantidad, 
                $results[1]->nombre, $results[1]->cantidad,
                $results[2]->nombre, $results[2]->cantidad); 
                return  $description;
      
    }

    function indefinite_contract(){
        global $wpdb;
        $array_response = array(array());

        $results = $wpdb->get_results("SELECT(
            (SELECT ROUND(SUM(occ_indefinite_contracts)  * 100.0) 
            FROM cl_busy_casen 
            WHERE ano = (SELECT max(ano)
            FROM cl_busy_casen))  / 
            (SELECT SUM(number_occupied) 
            FROM cl_busy_casen 
            WHERE ano = (SELECT MAX(ano)FROM cl_busy_casen) )) 
            AS total
            FROM cl_busy_casen
            LIMIT 1", OBJECT);
            
        $array_response['type'] = 'text';
        $array_response['data']['description'] = sprintf('El porcentaje de contratos indefinidos a nivel nacional equivalen al %s el ultimo periodo', $results[0]->total );

        return $array_response;
    }

  

    // PORCENTAJE DE MUJERES ENTRE LOS TRABAJADORES OCUPADOS EN EL ULTIMO PERIODO.
    function female_percentage_sql(){
        global  $wpdb;
        $result = $wpdb->get_row (
            'SELECT 
	                    round(cast((SUM(number_occupied_female)::float/SUM(number_occupied)::float)*100.0 as numeric)
	                        ,2) as percentage,
                        SUM(number_occupied_female) as total_women,
                        SUM(number_occupied) as total_workers,
                        ano as year
                    FROM cl_busy_casen  
                    WHERE ano = (SELECT MAX(ano) FROM cl_busy_casen)
                    GROUP BY ano');
        $response['data'] = $result;
        $response['descripcion'] = 'El porcentaje de mujeres entre el total de personas ocupadas en el ultimo periodo es '.$result->percentage.'%';
        
        return $response['descripcion'];
       
    }

    // RESPONDE TOP 5 OCUPACIONES CON MAYOR CRECIMIENTO EN EL ULTIMO PERIODO
    function topfiveCrecimiento(){

        $query = 'SELECT 
                    round( CAST(((a.ocupados::float - b.ocupados::float)/b.ocupados::float)*100.0 as numeric ),2) as percentage,
                    (a.ocupados - b.ocupados) as difference,
                    a.ocupados as periodo_actual,
                    b.ocupados as periodo_anterior,
                    nombre_ocupacion,
                    a.id_occupation as id_occupation, 
                    a.ano as year1, b.ano as year2
                    FROM (select 
                                sum(casen.number_occupied) as ocupados, casen.id_occupation, casen.ano, ocupation.name_occupation as nombre_ocupacion
                            from 
                                cl_busy_casen as casen inner join cl_occupations as ocupation on casen.id_occupation = ocupation.id_occupation
                            where
                                casen.ano = (select max(ano) from cl_busy_casen) 
                            group by 
                                casen.id_occupation,nombre_ocupacion,casen.ano
                            order by
                                ocupados desc, casen.id_occupation, casen.ano) as a ,
                            (select 
                                    sum(number_occupied) as ocupados, id_occupation, ano
                                from 
                                    cl_busy_casen
                                where
                                    ano = (select max(ano)-2 from cl_busy_casen)
                                group by 
                                    id_occupation,ano
                                order by
                                    ocupados desc, id_occupation, ano) as b
                    WHERE a.id_occupation = b.id_occupation	
                    ORDER BY percentage desc
                    LIMIT 5';
        global  $wpdb;
        $queryResults = $wpdb->get_results($query);
        $finalList = [];
        $finalList['data'] = $queryResults;
        $finalList['descripcion'] = 'Las ocupaciones con mayor crecimiento en el ultimo periodo son: ';
        $x= 0;
        $length = count($queryResults);
        foreach ($queryResults as $row){
            if($x>0 && $x<$length-1){
                $finalList['descripcion'] .= ', ';
            }elseif ($x === $length-1){
                $finalList['descripcion'] .= ' y ';
            }
            $finalList['descripcion'] .= $row->nombre_ocupacion.' con '.$row->percentage.'%';
            $x++;
        }

        echo $finalList;
        
    }

    function menorCrecimiento(){
        $query = 'select 
                    round( CAST(((a.ocupados::float - b.ocupados::float)/b.ocupados::float)*100.0 as numeric ),2) as percentage,
                    (a.ocupados - b.ocupados) as difference,
                    a.ocupados as periodo_actual,
                    b.ocupados as periodo_anterior,nombre_ocupacion, a.id_occupation as id_occupation,
                    a.ano as year1, b.ano as year2
                    from 
                        (select sum(casen.number_occupied) as ocupados, casen.id_occupation, 
                             casen.ano, ocupation.name_occupation as nombre_ocupacion
                        from 
                             cl_busy_casen as casen 
                                 inner join 
                                 cl_occupations as ocupation on casen.id_occupation = ocupation.id_occupation
                        where
                            casen.ano = (select max(ano) from cl_busy_casen) 
                        group by 
                            casen.id_occupation,nombre_ocupacion,casen.ano
                        order by
                            ocupados desc, casen.id_occupation, casen.ano) as a ,
                        (select sum(number_occupied) as ocupados, id_occupation, ano
                            from 
                                cl_busy_casen
                            where
                                ano = (select max(ano)-2 from cl_busy_casen)
                            group by 
                                id_occupation,ano
                            order by
                                ocupados desc, id_occupation, ano) as b
                where a.id_occupation = b.id_occupation	
                order by percentage asc
                limit 1';
        global  $wpdb;
        $row = $wpdb->get_row($query);
        $response['data'] = $row;
        $response['descripcion'] = 'La ocupacion con menor crecimiento en el ultimo periodo es: '.$row->nombre_ocupacion.', con un crecimiento de '.$row->percentage.'%';
        return $response['descripcion'];
        exit();

    }
   

?>
