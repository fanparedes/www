<?php
	get_header(); 
?>

<div class="bloque-titular">
    <div class="container">
        <h1><?php echo get_the_title(); ?></h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- BLOQUE TITULAR -->
        <div class="col-12">
            <div class="bloque-titular">
                <h2>Selecciona una región</h2>
            </div>
        </div>
        <?php 
            $sql_region = "select id_region, name_region from cl_regions order by cast(code_region as integer) asc";
            $rs_region  = $wpdb->get_results($sql_region);
        ?>
        <div class="col-12">
            <div class="bloque-regiones">
                <ul>
                <?php if(is_array($rs_region) && count($rs_region)>0): ?>
                    
                    <?php foreach ($rs_region as $row): 
                        //var_dump($row->id_region); die;
                        $id_region      = isset($row->id_region)      && $row->id_region !=''    ? $row->id_region : '';
                        $name_region    = isset($row->name_region)    && $row->name_region !=''  ? $row->name_region : '';

                        $args_region        = array(
                            'post_type'     => 'regiones_detalle',
                            'post_status'   => 'publish',
                            'showposts'     => 1,
                            'order'         => 'ASC',
                            'meta_query' => array(
                              'relation'    => 'WHERE',
                              array(
                                'key'   => 'id',
                                'value'     => $id_region,
                                'compare'   => '=',
                              )
                            )
                        );
                        
                        $wp_region = new WP_Query( $args_region ); ?>

                        <?php if ( $wp_region->have_posts() ) : ?>
                            <?php while ( $wp_region->have_posts() ) : 

                                $wp_region->the_post();
                                $title_region   = get_the_title();
                                $content_region = get_the_content();
                                $icono          = get_field('icono');
                                $nombre_corto   = get_field('nombre_corto');
                                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

                            endwhile;
                            wp_reset_postdata();
                        endif; 

                         ?>
                        
                        <li>
                            <a href="<?php echo get_site_url().'/region-detalle/'.$id_region; ?>"> 
                                <img src="<?= $featured_img_url; ?> " alt="<?php the_title(); ?>">
                                <?php echo $nombre_corto; ?>
                            </a>
                        </li>
                        
                    <?php endforeach;  ?>
                <?php endif; ?>
                    
                </ul>
            </div>
        </div>
        <!-- BLOQUE TITULAR -->
        <div class="col-12">
            <div class="bloque-titular">
                <h2>Datos generales para todo el territorio nacional</h2>
            </div>
        </div>
        <!-- FIN BLOQUE TITULAR -->
        <!-- BLOQUE GRUPO INDICADORES -->
        <!-- BLOQUE GRUPO INDICADORES CARRUSEL -->
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
                        <p>Porcentaje de población en activo en todo el territorio nacional</p>
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
                        <p>Tasa de cesantía en todo el territorio nacional</p>
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
                        <p>Porcentaje de mujeres en activo en todo el territorio nacional</p>
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
                    <p>Porcentaje de población en activo en todo el territorio nacional</p>
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
                    <p>Tasa de cesantía en todo el territorio nacional</p>
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
                    <p>Porcentaje de mujeres en activo en todo el territorio nacional</p>
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
                    <p>Promedio de ingresos mensuales en todo el territorio nacional</p>
                </div>
            </div>
        </div>
        <!-- FIN BLOQUE INDICADOR DATO -->
    </div>
</div>

<?php
	get_footer();
?>