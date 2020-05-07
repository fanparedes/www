<?php 
global $wpdb;
global $id_occupation;
global $id_code;
$results = $wpdb->get_results('SELECT cl_occupations.name_occupation o_name, cl_job_positions.name_job_position j_name, cl_job_positions.description j_desc, code_job_position code
FROM cl_occupations
LEFT JOIN cl_job_positions 
ON cl_occupations.id_occupation = cl_job_positions.id_occupation
WHERE cl_occupations.id_occupation = '.$id_occupation.'
ORDER BY random()
LIMIT 9 ');
?>
<?php 
$suggest = $wpdb->get_results('SELECT  name_occupation titulo, description descripcion, id_occupation id 
FROM cl_occupations
ORDER BY  random()
LIMIT 3');?>
<?php 
$cert_link = $id_occupation;
$sql = "SELECT  name_profile, link, code_ciuo_88 FROM cl_cert_chilevalora WHERE code_ciuo_88 = '".$cert_link."'";
$certs = $wpdb->get_results($sql);
?>

    
        </div>
      </div>
     <div class="bloque-blanco">
        <div class="container">
            <div class="bloque-columnas">
                <h2>Ocupaciones relacionadas con <?php echo $results[0]->o_name ?></h2>
                <div class="row">
                    <div class="col-12 col-md-4" style="padding-bottom: 35px;">
                        <h3><a href="<?php echo get_site_url().'/ocupacion-detalle/'.$id_occupation.'/?code_job_position=/'.$results[0]->code; ?>"><?php echo $results[0]->j_name; ?></a></h3>
                        <p style="text-align:justify;"><?php echo $results[0]->j_desc; ?></p>
                       <!-- <div class="bloque-progress">
                            <p>Demanda</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100">67%</div>
                            </div>
                            <a href="ocupacion-digital-desarrollador-web-resumen.html" class="icon-plus"><i class="fal fa-plus"></i></a>
                        </div> -->
                    </div>
                    <div class="col-12 col-md-4" style="padding-bottom: 35px;">
                        <h3><a href="<?php echo get_site_url().'/ocupacion-detalle/'.$id_occupation.'/?code_job_position=/'.$results[1]->code; ?>"><?php echo $results[1]->j_name; ?></a></h3>
                        <p style="text-align:justify;"><?php echo $results[2]->j_desc; ?></p>
                        <!-- <div class="bloque-progress">
                            <p>Demanda</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100">42%</div>
                            </div>
                            <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
                        </div> -->
                    </div>
                    <div class="col-12 col-md-4" style="padding-bottom: 35px;">
                        <h3><a href="<?php echo get_site_url().'/ocupacion-detalle/'.$id_occupation.'/?code_job_position=/'.$results[2]->code; ?>"><?php echo $results[2]->j_name; ?></a></h3>
                        <p style="text-align:justify; "><?php echo $results[2]->j_desc; ?></p>
                        <!-- <div class="bloque-progress">
                            <p>Demanda</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100">46%</div>
                            </div>
                            <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a> 
                        </div>
                    </div>-->
                </div>
                    <div class="collapse" id="collapseOcupaciones">
                        <div class="row">
                            <div class="col-12 col-md-4" style="padding-bottom: 35px;">
                            <h3><a href="<?php echo get_site_url().'/ocupacion-detalle/'.$id_occupation.'/?code_job_position=/'.$results[3]->code; ?>"><?php echo $results[3]->j_name; ?></a></h3>
                            <p style="text-align: justify;"><?php echo $results[3]->j_desc; ?></p>
                                <!-- <div class="bloque-progress">
                                    <p>Demanda</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="63" aria-valuemin="0" aria-valuemax="100">63%</div>
                                    </div>
                                    <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
                                </div> -->
                            </div>
                            <div class="col-12 col-md-4" style="padding-bottom: 35px;">
                            <h3><a href="<?php echo get_site_url().'/ocupacion-detalle/'.$id_occupation.'/?code_job_position=/'.$results[4]->code; ?>"><?php echo $results[4]->j_name; ?></a></h3>
                            <p style="text-align:justify;"><?php echo $results[4]->j_desc; ?></p>
                                <!-- <div class="bloque-progress">
                                    <p>Demanda</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100">71%</div>
                                    </div>
                                    <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
                                </div> -->
                            </div>
                            <div class="col-12 col-md-4" style="padding-bottom: 35px;">
                            <h3><a href="<?php echo get_site_url().'/ocupacion-detalle/'.$id_occupation.'/?code_job_position=/'.$results[5]->code; ?>"><?php echo $results[5]->j_name; ?></a></h3>
                            <p style="text-align:justify;"><?php echo $results[5]->j_desc; ?></p>
                                <!-- <div class="bloque-progress">
                                    <p>Demanda</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="83" aria-valuemin="0" aria-valuemax="100">83%</div>
                                    </div>
                                    <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
                                </div> -->
                            </div>
                            <div class="col-12 col-md-4" style="padding-bottom: 35px;">
                            <h3><a href="<?php echo get_site_url().'/ocupacion-detalle/'.$id_occupation.'/?code_job_position=/'.$results[7]->code; ?>"><?php echo $results[6]->j_name; ?></a></h3>
                            <p style="text-align:justify;"><?php echo $results[6]->j_desc; ?></p>
                                <!-- <div class="bloque-progress">
                                    <p>Demanda</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100">56%</div>
                                    </div>
                                    <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
                                </div> -->
                            </div>
                            <div class="col-12 col-md-4" style="padding-bottom: 35px;">
                            <h3><a href="<?php echo get_site_url().'/ocupacion-detalle/'.$id_occupation.'/?code_job_position=/'.$results[7]->code; ?>"><?php echo $results[7]->j_name; ?></a></h3>
                            <p style="text-align:justify;"><?php echo $results[7]->j_desc; ?></p>
                                <!-- <div class="bloque-progress">
                                    <p>Demanda</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100">23%</div>
                                    </div>
                                    <a href="#" class="icon-plus"><i class="fal fa-plus"></i></a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="bloque-boton">
                        <a data-toggle="collapse" 
                        href="#collapseOcupaciones" 
                        role="button" 
                        aria-expanded="false" 
                        aria-controls="collapseOcupaciones" 
                        data-txtalt="Ver menos ocupaciones relacionadas" 
                        class="btn btn-yellow">Ver más ocupaciones relacionadas</a>
                    </div>
                </div>
            <!-- FIN 3 COLUMNAS -->
        </div>
    </div>
    <div class="container">
        <hr>
    </div>
    <!-- BLOQUE BLANCO -->
    <div class="bloque-blanco">
        <div class="container">
            <!-- 3 COLUMNAS -->
            <div class="bloque-columnas">
                <h2>Perfiles de ChileValora asociados</h2>
                    <?php if ($certs == NULL): ?>
                <ul class="perfiles-asociados row">
                    <li class="col-sm-12"><p>No se encontraron Perfiles ChileValora asociados para esta ocupación</p></li>
                </ul>
                    <?php else :?>
                <ul class="perfiles-asociados row">
                    <li class="col-sm-4"><a target="_blank" href="<?php echo $certs[0]->link; ?>"><?php echo $certs[0]->name_profile;?></a></li>
                    <li class="col-sm-4"><a target="_blank" href="<?php echo $certs[1]->link; ?>"><?php echo $certs[1]->name_profile; ?></a></li>
                    <li class="col-sm-4"><a target="_blank" href="<?php echo $certs[2]->link; ?>"><?php echo $certs[2]->name_profile; ?></a></li>
                    <li class="col-sm-4"><a target="_blank" href="<?php echo $certs[3]->link; ?>"><?php echo $certs[3]->name_profile; ?></a></li>
                    <li class="col-sm-4"><a target="_blank" href="<?php echo $certs[4]->link; ?>"><?php echo $certs[4]->name_profile; ?></a></li>
                    <li class="col-sm-4"><a target="_blank" href="<?php echo $certs[5]->link; ?>"><?php echo $certs[5]->name_profile; ?></a></li>
                    <li class="col-sm-4"><a target="_blank" href="<?php echo $certs[6]->link; ?>"><?php echo $certs[6]->name_profile; ?></a></li>
                    <li class="col-sm-4"><a target="_blank" href="<?php echo $certs[7]->link; ?>"><?php echo $certs[7]->name_profile; ?></a></li>
                </ul>
            <?php endif;?>
            </div>
        </div>
    </div>
    <!-- FIN BLOQUE BLANCO -->
    <!-- BOTON SOLO MÓVIL -->
    <div class="col-12 d-block d-sm-none">
        <div class="bloque-boton">
            <a href="ocupacion-digital-desarrollador-web-masinfo.php" class="btn btn-arrow btn-block">Ver más información</a>
        </div>
    </div>
    <!-- FIN BOTON SOLO MÓVIL -->
    <!-- BLOQUE AMARILLO -->
    <div class="bloque-amarillo">
        <div class="container">
            <!-- 3 COLUMNAS -->
            <div class="bloque-columnas">
                <h2>También te puede interesar</h2>
                <div class="row">
                    <div style="padding-bottom: 20px;" class="col-12 col-md-4">
                        <h3><a href="<?php echo get_site_url().'/ocupacion-detalle/'.$suggest[0]->id; ?>"><?php echo $suggest[0]->titulo; ?></a></h3>
                        <p style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; text-align: justify;"><?php echo $suggest[0]->descripcion; ?></p>
                    </div>
                    <div style="padding-bottom: 20px;"  class="col-12 col-md-4">
                        <h3><a href="<?php echo get_site_url().'/ocupacion-detalle/'.$suggest[1]->id; ?>"><?php echo $suggest[1]->titulo; ?></a></h3>
                        <p style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; text-align: justify;"><?php echo $suggest[1]->descripcion ?></p>
                    </div>
                    <div style="padding-bottom: 20px;"  class="col-12 col-md-4">
                        <h3><a href="<?php echo get_site_url().'/ocupacion-detalle/'.$suggest[2]->id; ?>"><?php  echo $suggest[2]->titulo; ?></a></h3>
                        <p style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; text-align: justify;"><?php echo $suggest[2]->descripcion; ?></p>
                    </div>
                </div>
            </div>
            <!-- FIN 3 COLUMNAS -->
                </div>
             </div>
        </div>
    </div>
</div>
        <!-- FIN BLOQUE AMARILLO -->