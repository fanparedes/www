<?php
	
	$rs_search 	= array('/', 'region-detalle');
	$rs_replace = array('', '');
	$id_region 	= str_replace($rs_search, $rs_replace, $_SERVER['REQUEST_URI']);
	$id_region	= is_numeric($id_region) ? $id_region : '1';

	//var_dump($id_region); die;

	if(is_numeric($id_region)){
		$sql_region = "select id_region, name_region from cl_regions where id_region = ".$id_region;
        $rs_region  = $wpdb->get_results($sql_region);
        if(is_array($rs_region) && count($rs_region)>0){
        	$args_region        = array(
				'post_type'     => 'regiones_detalle',
				'post_status'   => 'publish',
				'showposts'     => 1,
				'order'         => 'ASC',
				'meta_query' => array(
		          'relation'    => 'WHERE',
		          array(
		            'key'   => 'id',
		            'value'     => $rs_region[0]->id_region,
		            'compare'   => '=',
		          )
		        )
			);
			
			$wp_region = new WP_Query( $args_region );

			if ( $wp_region->have_posts() ) :
	        	while ( $wp_region->have_posts() ) : $wp_region->the_post();
	        		$title_region 	= get_the_title();
	        		$content_region = get_the_content();

	        	endwhile;
	    		wp_reset_postdata();
	    	endif;

	    	get_header(); 
    	?>
    		<style type="text/css">
    			.content_justify p{
    				text-align: justify !important;
    			}
    		</style>
				<div class="bloque-titular">
				    <div class="container">
				        <h1><?php echo ucwords(strtolower($rs_region[0]->name_region)); ?></h1>
				    </div>
				</div>
				<div class="container">
				    <div class="row">
				        <!-- BLOQUE TEXTO -->
				        <div class="col-12">
				            <div class="bloque-texto row">
				                <div class="col-12 col-lg-2">
				                    <h2><?php echo $title_region; ?></h2>
				                </div>
				                <div class="col-12 col-lg-10 content_justify" >
				                    <?php echo $content_region; ?>
				                </div>
				            </div>
				        </div>
				        <div class="owl-carousel owl-theme">
			                <div class="item">
			                    <div class="bloque-indicador">
			                        <div class="grafica-circulo">
			                        <span class="indicador-icon"><i class="iconcl-ocupacion"></i></span>                            
			                            <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
			                            <a href="#">
			                                <svg class="radial-progress" data-percentage="73" viewBox="0 0 80 80">
			                                <circle class="incomplete" cx="40" cy="40" r="35"></circle>
			                                <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220px;"></circle>
			                                <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">73%</text>
			                                </svg>
			                            </a>
			                        </div>
			                        <div class="text">
			                            <a href="#" class="title">Población activa</a>
			                            <p>Porcentaje de población en activo en esta región en el último periodo</p>
			                        </div>
			                    </div>
			                </div>
			                <div class="item">
			                    <div class="bloque-indicador">
			                        <div class="grafica-circulo red">
			                            <span class="indicador-icon"><i class="iconcl-cesantia"></i></span>
			                            <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
			                            <a href="#">
			                                <svg class="radial-progress" data-percentage="36" viewBox="0 0 80 80">
			                                <circle class="incomplete" cx="40" cy="40" r="35"></circle>
			                                <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220px;"></circle>
			                                <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">36%</text>
			                                </svg>
			                            </a>
			                        </div>
			                        <div class="text">
			                            <a href="#" class="title">Tasa Cesantía</a>
			                            <p>Tasa de cesantía en esta región en el último periodo</p>
			                        </div>
			                    </div>
			                </div>
			                <div class="item">
			                    <div class="bloque-indicador">
			                        <div class="grafica-circulo">
			                            <span class="indicador-icon"><i class="iconcl-mujeres"></i></span>
			                            <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
			                            <a href="#">
			                                <svg class="radial-progress" data-percentage="83" viewBox="0 0 80 80">
			                                <circle class="incomplete" cx="40" cy="40" r="35"></circle>
			                                <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220px;"></circle>
			                                <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">83%</text>
			                                </svg>
			                            </a>
			                        </div>
			                        <div class="text">
			                            <a href="#" class="title">Mujeres</a>
			                            <p>Porcentaje de mujeres en activo en esta región en el último periodo</p>
			                        </div>
			                    </div>
			                </div>
			            </div>
			            <!-- BLOQUE GRUPO INDICADORES DESKTOP -->
			            <div class="col-12 col-md-6 owl-desktop">
			                <div class="bloque-indicador">
			                    <div class="grafica-circulo">
			                        <span class="indicador-icon"><i class="iconcl-ocupacion"></i></span>                        
			                        <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
			                        <a href="#">
			                            <svg class="radial-progress" data-percentage="73" viewBox="0 0 80 80">
			                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
			                            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220px;"></circle>
			                            <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">73%</text>
			                            </svg>
			                        </a>
			                    </div>
			                    <div class="text">
			                        <a href="#" class="title">Población activa</a>
			                        <p>Porcentaje de población en activo en esta región en el último periodo</p>
			                    </div>
			                </div>
			            </div>
			            <div class="col-12 col-md-6 owl-desktop">
			                <div class="bloque-indicador">
			                    <div class="grafica-circulo red">
			                        <span class="indicador-icon"><i class="iconcl-cesantia"></i></span>
			                        <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
			                        <a href="#">
			                            <svg class="radial-progress" data-percentage="36" viewBox="0 0 80 80">
			                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
			                            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220px;"></circle>
			                            <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">36%</text>
			                            </svg>
			                        </a>
			                    </div>
			                    <div class="text">
			                        <a href="#" class="title">Tasa Cesantía</a>
			                        <p>Tasa de cesantía en esta región en el último periodo</p>
			                    </div>
			                </div>
			            </div>
			            <div class="col-12 col-md-6 owl-desktop">
			                <div class="bloque-indicador">
			                    <div class="grafica-circulo">
			                        <span class="indicador-icon"><i class="iconcl-mujeres"></i></span>
			                        <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
			                        <a href="#">
			                            <svg class="radial-progress" data-percentage="83" viewBox="0 0 80 80">
			                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
			                            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220px;"></circle>
			                            <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">83%</text>
			                            </svg>
			                        </a>
			                    </div>
			                    <div class="text">
			                        <a href="#" class="title">Mujeres</a>
			                        <p>Porcentaje de mujeres en activo en esta región en el último periodo</p>
			                    </div>
			                </div>
			            </div>
			            <!-- FIN BLOQUE GRUPO INDICADORES -->
			            <!-- BLOQUE INDICADOR DATO -->
			            <div class="col-12 col-md-6">
			                <div class="bloque-indicador-dato">
			                    <div class="grafica-circulo">
			                        <span class="indicador-icon"><i class="iconcl-ingresos"></i></span>
			                        <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
			                        <a href="#">
			                            <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
			                            <circle class="complete" cx="40" cy="40" r="35"></circle>
			                            <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">$1,5M</text>
			                            </svg>
			                        </a>
			                    </div>
			                    <div class="text">
			                        <a href="#" class="title">Ingresos</a>
			                        <p>Promedio de ingresos mensuales en esta región en el último periodo</p>
			                    </div>
			                </div>
			            </div>
			            <!-- FIN BLOQUE INDICADOR DATO -->
			            <!-- BLOQUE CABECERA -->
			            <div class="col-12">
			                <div class="bloque-cabecera">
			                    <div class="linea"><i class="iconcl-empleados"></i></div>
			                    <h2>Empleados</h2>
			                    <p>Sectores con mayor número de empleados creados en 2018 en esta región en el último periodo</p>
			                </div>
			            </div>
			            <!-- FIN BLOQUE CABECERA -->
			            <!-- BLOQUE INDICADORES DISTRIBUTIVA -->
			                <div class="bloque-indicadores-distributiva">
			                    <div class="owl-carousel owl-theme">
			                        <div class="col-12 col-md-6 item">
			                            <div class="bloque-indicador-dato">
			                                <div class="grafica-circulo">
			                                    <a href="<?php echo get_site_url().'/sector-detalle/7'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                    <a href="<?php echo get_site_url().'/sector-detalle/7'; ?>">
			                                        <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
			                                        <circle class="complete" cx="40" cy="40" r="35"></circle>
			                                        <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">35%</text>
			                                        </svg>
			                                    </a>
			                                </div>
			                                <div class="text">
			                                    <a href="<?php echo get_site_url().'/sector-detalle/7'; ?>" class="title">Construcción</a>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="col-12 col-md-6 item">
			                            <div class="bloque-indicador-dato">
			                                <div class="grafica-circulo">
			                                    <a href="<?php echo get_site_url().'/sector-detalle/15'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                    <a href="<?php echo get_site_url().'/sector-detalle/15'; ?>">
			                                        <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
			                                        <circle class="complete" cx="40" cy="40" r="35"></circle>
			                                        <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">22%</text>
			                                        </svg>
			                                    </a>
			                                </div>
			                                <div class="text">
			                                    <a href=""<?php echo get_site_url().'/sector-detalle/15'; ?>"" class="title">Servicios Sociales y de Salud</a>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="col-12 col-md-6 item">
			                            <div class="bloque-indicador-dato">
			                                <div class="grafica-circulo">
			                                    <a href="<?php echo get_site_url().'/sector-detalle/14'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                    <a href="<?php echo get_site_url().'/sector-detalle/14'; ?>">
			                                        <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
			                                        <circle class="complete" cx="40" cy="40" r="35"></circle>
			                                        <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">20%</text>
			                                        </svg>
			                                    </a>
			                                </div>
			                                <div class="text">
			                                    <a href="<?php echo get_site_url().'/sector-detalle/14'; ?>" class="title">Enseñanza</a>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row owl-desktop justify-content-center">
			                        <div class="col-2 col-sm-6 col-md-4">
			                            <div class="bloque-indicador-dato">
			                                <div class="grafica-circulo">
			                                    <a href="<?php echo get_site_url().'/sector-detalle/7'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                    <a href="<?php echo get_site_url().'/sector-detalle/7'; ?>">
			                                        <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
			                                        <circle class="complete" cx="40" cy="40" r="35"></circle>
			                                        <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">35%</text>
			                                        </svg>
			                                    </a>
			                                </div>
			                                <div class="text">
			                                    <a href="<?php echo get_site_url().'/sector-detalle/7'; ?>" class="title">Construcción</a>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="col-2 col-sm-6 col-md-4">
			                            <div class="bloque-indicador-dato">
			                                <div class="grafica-circulo">
			                                    <a href="<?php echo get_site_url().'/sector-detalle/15'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                    <a href="<?php echo get_site_url().'/sector-detalle/15'; ?>">
			                                        <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
			                                        <circle class="complete" cx="40" cy="40" r="35"></circle>
			                                        <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">22%</text>
			                                        </svg>
			                                    </a>
			                                </div>
			                                <div class="text">
			                                    <a href="<?php echo get_site_url().'/sector-detalle/15'; ?>" class="title">Servicios Sociales y de Salud</a>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="col-2 col-sm-6 col-md-4">
			                            <div class="bloque-indicador-dato">
			                                <div class="grafica-circulo">
			                                    <a href="<?php echo get_site_url().'/sector-detalle/14'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                    <a href="<?php echo get_site_url().'/sector-detalle/14'; ?>">
			                                        <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
			                                        <circle class="complete" cx="40" cy="40" r="35"></circle>
			                                        <text class="percentage" x="50%" y="58.7%" transform="matrix(0, 1, -1, 0, 80, 0)">20%</text>
			                                        </svg>
			                                    </a>
			                                </div>
			                                <div class="text">
			                                    <a href="<?php echo get_site_url().'/sector-detalle/14'; ?>" class="title">Enseñanza</a>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="bloque-boton">
			                        <a href="<?php echo get_site_url().'/sectores-productivos'?>" class="btn btn-yellow">Ver más sectores</a>
			                    </div>
			                </div>
			            <!-- FIN BLOQUE INDICADORES DISTRIBUTIVA -->
			            <!-- BLOQUE CABECERA -->
			            <div class="col-12">
			                <div class="bloque-cabecera">
			                    <div class="linea"><i class="iconcl-ocupacion"></i></div>
			                    <h2>Ocupaciones más demandadas</h2>
			                    <p>Ocupaciones más demandadas en las bolsas de empleo</p>
			                    <!-- <div class="btn-group btn-group-toggle" data-toggle="buttons">
			                          <label class="btn btn-secondary">
			                            <input type="radio" name="options" id="option1" autocomplete="off"> No digital
			                          </label>
			                          <label class="btn btn-secondary active">
			                            <input type="radio" name="options" id="option2" autocomplete="off" checked> Digital
			                          </label>
			                    </div> -->
			                </div>
			            </div>
			            <!-- FIN BLOQUE CABECERA -->
			            <!-- BLOQUE BARRA DISTRIBUTIBA -->
			            <div class="col-12 col-lg-8 offset-lg-2">
			                <div class="bloque-barra">
			                    <div class="bloque-progress">
			                        <p>Ingeniero civil, construcción/estructuras de edificios</p>
			                        <div class="progress">
			                            <div class="progress-bar" role="progressbar" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100">94%</div>
			                        </div>
			                        <a href="<?php echo get_site_url().'/ocupacion-detalle/2142/?code_job_position=0-22.20'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                    </div>
			                    <div class="bloque-progress">
			                        <p>Médico, medicina general</p>
			                        <div class="progress">
			                            <div class="progress-bar" role="progressbar" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100">76%</div>
			                        </div>
			                        <a href="<?php echo get_site_url().'/ocupacion-detalle/2221/?code_job_position=0-61.05'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                    </div>
			                    <div class="bloque-progress">
			                        <p>Abogado</p>
			                        <div class="progress">
			                            <div class="progress-bar" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100">72%</div>
			                        </div>
			                        <a href="<?php echo get_site_url().'/ocupacion-detalle/2421/?code_job_position=1-21.10'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                    </div>
			                    <div class="bloque-progress">
			                        <p>Desarrollador web y multimedia</p>
			                        <div class="progress">
			                            <div class="progress-bar" role="progressbar" aria-valuenow="64" aria-valuemin="0" aria-valuemax="100">64%</div>
			                        </div>
			                        <a href="<?php echo get_site_url().'/ocupacion-detalle/2132/?code_job_position=2513X'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                    </div>
			                    <div class="bloque-progress">
			                        <p>Desarrollador Full Stack</p>
			                        <div class="progress">
			                            <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
			                        </div>
			                        <a href="<?php echo get_site_url().'/ocupacion-detalle/2132/?code_job_position=2513X'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                    </div>
			                    <div class="bloque-progress">
			                        <p>Dentista, ortodoncia</p>
			                        <div class="progress">
			                            <div class="progress-bar" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100">38%</div>
			                        </div>
			                        <a href="<?php echo get_site_url().'/ocupacion-detalle/2222/?code_job_position=0-63.20'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                    </div>
			                    <div class="bloque-progress">
			                        <p>Comerciante, mayorista</p>
			                        <div class="progress">
			                            <div class="progress-bar" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100">31%</div>
			                        </div>
			                        <a href="<?php echo get_site_url().'/ocupacion-detalle/1314/?code_job_position=4-10.30'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                    </div>
			                    <div class="bloque-progress">
			                        <p>Ingeniero civil, mecánica/suelos</p>
			                        <div class="progress">
			                            <div class="progress-bar" role="progressbar" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100">26%</div>
			                        </div>
			                        <a href="<?php echo get_site_url().'/ocupacion-detalle/2142/?code_job_position=0-22.60'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                    </div>
			                    <div class="bloque-progress">
			                        <p>Técnico agrónomo</p>
			                        <div class="progress">
			                            <div class="progress-bar" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100">22%</div>
			                        </div>
			                        <a href="<?php echo get_site_url().'/ocupacion-detalle/3212/?code_job_position=0-54.90'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                    </div>
			                    <div class="bloque-progress">
			                        <p>Minero, superficie</p>
			                        <div class="progress">
			                            <div class="progress-bar" role="progressbar" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100">16%</div>
			                        </div>
			                        <a href="<?php echo get_site_url().'/ocupacion-detalle/7111/?code_job_position=7-11.05'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                    </div>    
			                    <div class="bloque-boton">
			                        <a href="<?php echo get_site_url().'/ocupaciones'?>" class="btn btn-yellow">Ver más ocupaciones</a>
			                    </div>
			                </div>
			            </div>
			            <!-- FIN BLOQUE BARRA DISTRIBUTIBA -->
			            <!-- BLOQUE PODIO -->
			            <div class="bloque-podio">
			                <div class="intro">
			                    <div class="icono"><i class="iconcl-podium-xl"></i></div>
			                    <h2>Ocupaciones más difíciles de cubrir</h2>
			                    <p>Ocupaciones más difíciles de cubrir vacantes en esta region en el último periodo</p>
			                </div>
			                <!-- CARRUSEL PODIO -->
			                <div class="owl-carousel owl-theme off">
			                    <div class="item">
			                        <div class="bloque-indicador">
			                            <div class="grafica-circulo">
			                                <span class="indicador-icon"><i class="iconcl-puesto1"></i></span>
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/1130'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/1130'; ?>" class="circle-icon">
			                                <i class="iconcl-ocupacion-xl"></i>
			                            </a>
			                            </div>
			                            <div class="text">
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/1130'; ?>" class="title">Jefes de pequeñas poblaciones</a>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="item">
			                        <div class="bloque-indicador">
			                            <div class="grafica-circulo">
			                                <span class="indicador-icon"><i class="iconcl-puesto2"></i></span>
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2145'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2145'; ?>" class="circle-icon">
			                                <i class="iconcl-ocupacion-xl"></i>
			                            </a>
			                            </div>
			                            <div class="text">
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2145'; ?>" class="title">Ingenieros mecánicos</a>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="item">
			                        <div class="bloque-indicador">
			                            <div class="grafica-circulo">
			                                <span class="indicador-icon"><i class="iconcl-puesto3"></i></span>
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2111'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2111'; ?>" class="circle-icon">
			                                <i class="iconcl-ocupacion-xl"></i>
			                            </a>
			                            </div>
			                            <div class="text">
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2111'; ?>" class="title">Físicos y astrónomos</a>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			                <!-- FIN CARRUSEL PODIO -->
			                <div class="row owl-desktop">
			                    <div class="col-4 owl-desktop">
			                        <div class="bloque-indicador">
			                            <div class="grafica-circulo">
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/1130'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/1130'; ?>" class="circle-icon">
			                                <i class="iconcl-ocupacion-xl"></i>
			                            </a>
			                            </div>
			                            <div class="text">
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/1130'; ?>" class="title">Jefes de pequeñas poblaciones</a>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="col-4 owl-desktop">
			                        <div class="bloque-indicador">
			                            <div class="grafica-circulo">
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2145'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2145'; ?>" class="circle-icon">
			                                <i class="iconcl-ocupacion-xl"></i>
			                            </a>
			                            </div>
			                            <div class="text">
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2145'; ?>" class="title">Ingenieros mecánicos</a>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="col-4 owl-desktop">
			                        <div class="bloque-indicador">
			                            <div class="grafica-circulo">
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2111'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2111'; ?>" class="circle-icon">
			                                <i class="iconcl-ocupacion-xl"></i>
			                            </a>
			                            </div>
			                            <div class="text">
			                                <a href="<?php echo get_site_url().'/ocupacion-detalle/2111'; ?>" class="title">Físicos y astrónomos</a>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
				    </div>
				</div>
			<?php
			get_footer();

        }else{
        	header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".home_url( '/404/' ));
			exit();
        }
	}else{
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".home_url( '/404/' ));
		exit();
	}
?>