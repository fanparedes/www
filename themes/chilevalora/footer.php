<?php
/**
 *
 * @package chilevalora
 */

global $wpdb;

?>
    <?php
        //Se valida si la página no es la home para mostrar el breadcrumb 
        if(get_the_ID()!='105'){
    ?>
	<!-- BANNERS -->
    <div class="bloque-banners">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-4 text-center">
                    <a href="<?php echo get_site_url().'/ocupaciones';?>" class="banner banner04 align-items-center">
                        <div class="text">
                            <p><small>Consulta los datos por</small> Ocupaciones</p>
                            <span><i class="far fa-chevron-right"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <a href="<?php echo get_site_url().'/regiones';?>" class="banner banner02 align-items-center">
                        <div class="text">
                            <p><small>Consulta los datos por</small> Regiones</p>
                            <span><i class="far fa-chevron-right"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-4 text-center align-items-center">
                    <a href="<?php echo get_site_url().'/como-funciona/'; ?>" class="banner banner03">
                        <div class="text">
                            <p>¿Cómo funciona?</p>
                            <span><i class="far fa-chevron-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <!-- FIN BANNERS -->
    
    <footer>
        <div class="container">
            <div class="row align-items-center logos">
                <?php
					$args          = array(
						'post_type'     => 'banners',
						'post_status'   => 'publish',
						'showposts'     => 20,
						'order'         => 'ASC'
					);
					$i             = 1;
					$products_loop = new WP_Query( $args );
					if ( $products_loop->have_posts() ) :
						while ( $products_loop->have_posts() ) : $products_loop->the_post();
							// Set variables
							$id 		 = get_the_ID();
							$title       = get_the_title();
							$description = get_the_content();
							$image       = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
                            $url         = get_field('url');
							
							?>
							
							<div class="col-6 col-md-3 text-center">
			                    <a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo $image; ?>" class="img-fluid" alt="<?php echo $title; ?>"></a>
			                </div>
							<?php
							$i ++;
						endwhile;
					wp_reset_postdata();
					endif;
			    ?>
            </div>
            <div class="row links">
                <div class="col-6 col-md-3">
                    <?php
					if(is_active_sidebar('footer-sidebar-1')){
						dynamic_sidebar('footer-sidebar-1');
					}
					?>
                </div>
                <div class="col-6 col-md-3">
                	<?php
					if(is_active_sidebar('footer-sidebar-2')){
						dynamic_sidebar('footer-sidebar-2');
					}
					?>
                    
                </div>
                <div class="col-6 col-md-3">
                	<?php
					if(is_active_sidebar('footer-sidebar-3')){
						dynamic_sidebar('footer-sidebar-3');
					}
					?>
                    
                </div>
                <div class="col-6 col-md-3">
                	<?php
					if(is_active_sidebar('footer-sidebar-4')){
						dynamic_sidebar('footer-sidebar-4');
					}
					?>
                </div>
            </div>
            <?php
                $args_rss          = array(
                    'post_type'     => 'rrss',
                    'post_status'   => 'publish',
                    'showposts'     => 1,
                    'order'         => 'DESC'
                );
                
                $rs_rrss = new WP_Query( $args_rss );
                $facebook        = "";
                $twitter         = "";
                $youtube         = "";
                $instagram       = "";
                $linkedin        = "";
                if ( $rs_rrss->have_posts() ) :
                    while ( $rs_rrss->have_posts() ) : $rs_rrss->the_post();
                        $facebook        = get_field('facebook');
                        $twitter         = get_field('twitter');
                        $youtube         = get_field('youtube');
                        $instagram       = get_field('instagram');
                        $linkedin        = get_field('linkedin');

                    endwhile;
                wp_reset_postdata();
                endif;
            ?>
            <p class="social">
                <?php
                    if($facebook!=''){
                        echo '<a href="'.$facebook.'"><i class="fab fa-facebook-f"></i></a>';        
                    }
                    if($twitter!=''){
                        echo '<a href="'.$twitter.'"><i class="fab fa-twitter"></i></a>';        
                    }
                    if($youtube!=''){
                        echo '<a href="'.$youtube.'"><i class="fab fa-youtube"></i></a>';        
                    }
                    if($instagram!=''){
                        echo '<a href="'.$instagram.'"><i class="fab fa-instagram"></i></a>';        
                    }
                    if($linkedin!=''){
                        echo '<a href="'.$linkedin.'"><i class="fab fa-linkedin"></i></a>';        
                    }
                ?>
            </p>
        </div>
    </footer>

    <div class="modal" id="FiltroSector">
        <form>
            <div class="closeFiltroSector close"><i class="iconcl-aspa"></i></div>
            <h2>Elige un sector</h2>
             <?php 
                // change id's/code_sector ijensen
                    //$sql_sector = "select id_sector, code_sector ,name_sector from cl_sectors cs order by id_sector";

                $sql_sector = "
                    select 
                        wp_postmeta.post_id as get_the_id,
                        wp_posts.post_title,
                        wp_posts.post_content,
                        wp_posts.guid,
                        cl_sectors.id_sector,
                        cl_sectors.name_sector
                    from wp_posts  
                    inner join wp_postmeta  on (wp_posts.ID = wp_postmeta.post_id)
                    inner join cl_sectors on (cl_sectors.id_sector::int = wp_postmeta.meta_value::int)
                    where post_type = 'detalle_sector'
                    and wp_postmeta.meta_key = 'id'
                    order by cl_sectors.name_sector asc
                ";
                $rs_sector  = $wpdb->get_results($sql_sector);
            ?>
            <div class="form-group">
                <input type="text" class="form-control" id="buscar_sectores" name="buscar_sectores" placeholder="Buscar...">
            </div>
            <div class="accordion" id="accordionSector">
                <div class="list-group">
                <?php
                    if(is_array($rs_sector) && count($rs_sector)>0){
                        foreach ($rs_sector as $row) {

                            $id_sector      = isset($row->id_sector)      && $row->id_sector !=''    ? $row->id_sector : '';
                            $name_sector    = isset($row->name_sector)    && $row->name_sector !=''  ? $row->name_sector : '';
                            $get_the_id     = isset($row->get_the_id)           && $row->get_the_id !=''            ? $row->get_the_id : '';
                            $get_permalink  = get_permalink($get_the_id);
                            ?>
                                <!-- <a href="<?php echo get_site_url().'/sector-detalle/'.$id_sector; ?>" class="list-group-item list-group-item-action"><?php echo $name_sector; ?></a> -->
                                <a class="list-group-item collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $id_sector; ?>" aria-expanded="true" aria-controls="collapse<?php echo $id_sector; ?>"><?php echo $name_sector; ?></a>
                                <div id="collapse<?php echo $id_sector; ?>" class="list-group collapse" data-parent="#accordionSector">
                            <?php
                                $sql_code= "
                                    select cc.id_code, cc.name_code
                                        from cl_codes cc
                                            inner join cl_subclass sc on sc.id_subclass = cc.id_subclass
                                            inner join cl_class cl on cl.id_class = sc.id_class
                                            inner join cl_groups gr on cl.id_group = gr.id_group
                                            inner join cl_divisions dv on gr.id_division = dv.id_division
                                            inner join cl_sectors se on dv.id_sector = se.id_sector
                                        where se.id_sector =".$id_sector;
                                //echo $sql_code;
                                $rs_code  = $wpdb->get_results($sql_code);
                                if(is_array($rs_code) && count($rs_code)>0){
                                    foreach ($rs_code as $row_code) {
                                        $id_code      = isset($row_code->id_code)      && $row_code->id_code !=''    ? $row_code->id_code : '';
                                        $name_code    = isset($row_code->name_code)    && $row_code->name_code !=''  ? $row_code->name_code : '';
                                        
                                        ?>
                                            <!-- <a href="#" class="list-group-item list-group-item-action">Agentes de seguros</a> -->
                                            <a href="<?php echo $get_permalink.'?code_sector='.$id_code; ?>" class="list-group-item list-group-item-action"><?php echo $name_code; ?></a> 
                                        <?php
                                    }
                                }
                            ?>
                                </div>
                            <?php

                        }
                    } 
                ?>
                </div>
            </div>
        </form> 
    </div>
    <?php 
        $sql_region = "select id_region, name_region from cl_regions order by cast(code_region as integer) asc";
        $rs_region  = $wpdb->get_results($sql_region);
    ?>
    <div class="modal" id="FiltroRegion">
        <form>
            <div class="closeFiltroRegion close"><i class="iconcl-aspa"></i></div>
            <h2>Elige una región</h2>
             <div class="form-group">
                <input type="text" class="form-control" id="buscar_regiones" name="buscar_regiones" placeholder="Buscar...">
            </div>
            <div class="list-group" id="divRegiones">
                <?php
                    if(is_array($rs_region) && count($rs_region)>0){
                        foreach ($rs_region as $row) {
                            //var_dump($row->id_region); die;
                            $id_region      = isset($row->id_region)      && $row->id_region !=''    ? $row->id_region : '';
                            $name_region    = isset($row->name_region)    && $row->name_region !=''  ? $row->name_region : '';
                            ?>
                                <a href="<?php echo get_site_url().'/region-detalle/'.$id_region; ?>" class="list-group-item list-group-item-action"><?php echo $name_region; ?></a>
                            <?php
                        }
                    } 
                ?>
            </div>
        </form> 
    </div>
     <?php 
        

        /* BACKUP CHANGE 05-02-2020 - IJENSEN
            $sql_ocupacion = "select id_occupation, name_occupation from cl_occupations order by id_occupation";
            $rs_ocupacion  = $wpdb->get_results($sql_ocupacion);
        */
        //$sql_job_ocupacion = "select id_occupation, code_job_position, name_job_position from cl_job_positions order by name_job_position";
        $sql_job_ocupacion = "
            select
            wp_posts.ID as get_the_id,
            wp_posts.post_title,
            wp_posts.post_content,
            wp_posts.guid,
            cl_job_positions.id_occupation,
            cl_job_positions.code_job_position, 
            cl_job_positions.name_job_position
            from wp_posts  
            inner join wp_postmeta  on (wp_posts.ID= wp_postmeta.post_id)
            inner join cl_job_positions on (cl_job_positions.id_occupation::int = wp_postmeta.meta_value::int)
            where post_type = 'detalle_ocupacion'
            and wp_postmeta.meta_key = 'id'
            order by name_job_position asc
        ";
        $rs_job_ocupacion  = $wpdb->get_results($sql_job_ocupacion);

        //var_dump($rs_job_ocupacion);


    ?>
    <div class="modal" id="FiltroOcupacion">
        <form>
            <div class="closeFiltroOcupacion close"><i class="iconcl-aspa"></i></div>
            <h2>Elige una ocupación</h2>
            <div class="form-group">
                <input type="text" class="form-control" id="buscar_ocupaciones" name="buscar_ocupaciones" placeholder="Buscar...">
            </div>
                       
            <div class="accordion" id="accordionOcupaciones">
                <div class="list-group">        
                    <?php

                        if(is_array($rs_job_ocupacion) && count($rs_job_ocupacion)>0){
                            foreach ($rs_job_ocupacion as $row) {
        
                                $id_occupation      = isset($row->id_occupation)        && $row->id_occupation !=''         ? $row->id_occupation : '';
                                $code_job_position  = isset($row->code_job_position)    && $row->code_job_position !=''     ? $row->code_job_position : '';
                                $name_job_position  = isset($row->name_job_position)    && $row->name_job_position !=''     ? $row->name_job_position : '';
                                $get_the_id         = isset($row->get_the_id)           && $row->get_the_id !=''            ? $row->get_the_id : '';
                                $get_permalink      = get_permalink($get_the_id);
                                $uri_occupation     = $row->name_job_position !=''      && $row->code_job_position !=''     ? $get_permalink.'?code_job_position='.$code_job_position  : '';
        
                                ?>
                                <a href="<?php echo $uri_occupation; ?>" class="list-group-item list-group-item-action"><?php echo $name_job_position;?> </a>      
                                <?php
                            }
                        } 
                    ?>
                </div>
            </div>
        </form> 
    </div>
    <div class="modal-backdrop" id="backMenu" style="display:none"></div>
</body>

</html>
