<?php
	get_header(); 
?>

<style type="text/css">
	#buscar_curso{
		margin-bottom: unset !important;
	}
</style>

<div class="bloque-titular" id="titular_head" tabindex='1'>
    <div class="container">
        <h1>Cursos</h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- BLOQUE FILTROS -->
        <div class="col-12">
            <div class="bloque-filtros">
                <form class="formulario">
                     <div class="form-row">
                        <div class="col-12 col-md-12 col-lg col-xl-3">
                            <div class="input-tags">
                                <input type="text" class="form-control" name="buscar_curso	" id="buscar_curso" value="<?= isset($_GET['key']) ? $_GET['key'] : ''; ?> " />
                                <button type="submit"><i class="fal fa-flip-horizontal fa-search"></i></button>
                            </div>
                         </div>
                         <!--<div class="col-12 col-md-6 col-lg col-xl-4">
                            <select class="form-control" id="nivel_curso" name="nivel_curso">
                                <option value="">Todos los niveles</option>
                                <option value="Principiante">Principiante</option>
                                <option value="Medio">Medio</option>
                                <option value="Avanzado">Avanzado</option>
                            </select>
                         </div>-->
                          <?php 
                              $sql_region = "select id_region, name_region from cl_regions order by id_region";
                              $rs_region  = $wpdb->get_results($sql_region);
                          ?>
                         <div class="col-12 col-md-6 col-lg col-xl-3">
                            <select class="form-control" id="region_id" name="region_id">
                                <option value="">Todas las regiones</option>
                                <?php
                                    if(is_array($rs_region) && count($rs_region)>0){
                                        foreach ($rs_region as $row) {
                                            //var_dump($row->id_region); die;
                                            $id_region      = isset($row->id_region)      && $row->id_region !=''    ? $row->id_region : '';
                                            $name_region    = isset($row->name_region)    && $row->name_region !=''  ? $row->name_region : '';
                                            ?>
                                              <option value="<?php echo $id_region ?>"><?php echo $name_region; ?></option>
                                            <?php
                                        }
                                    } 
                                ?>
                            </select>
                         </div>
                         <div class="col-12 col-md-6 col-lg col-xl-6">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                              <label class="btn btn-secondary">
                                <input type="radio" name="modalidad_curso" value="" id="option0" autocomplete="off"> Todas
                              </label>
                              <label class="btn btn-secondary">
                                <input type="radio" name="modalidad_curso" value="2" id="option1" autocomplete="off"> Presencial
                              </label>
                              <label class="btn btn-secondary">
                                <input type="radio" name="modalidad_curso" value="1" id="option2" autocomplete="off"> Semi-Presencial
                              </label>
                              <label class="btn btn-secondary">
                                <input type="radio" name="modalidad_curso" value="0" id="option3" autocomplete="off"> Online
                              </label>

                            </div>
                         </div>
                         <div class="col-12 col-md-6 col-lg col-xl-2 offset-xl-10">
                            <select class="form-control" id="ordenar_curso" name="ordenar_curso">
                                <option value="">Ordenar por...</option>
                                <option value="1">Mayor costo</option>
                                <option value="2">Menor costo</option>
                                <option value="3">Mayor duración</option>
                                <option value="4">Menor duración</option>
                            </select>
                         </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- FIN BLOQUE FILTROS -->
        <!-- BLOQUE TITULAR -->
        <div class="col-12">
            <div class="bloque-titular">
                <h2 id="title_curso">Resultado búsqueda</h2>
            </div>
        </div>
        <!-- FIN BLOQUE TITULAR -->
        <!-- BLOQUE LISTADO CURSOS -->
        <div class="col-12">
            <div class="bloque-listado-cursos">
                <ul>
                   
                    
                </ul>
            </div>
            <div class="row">
                <div class="text-center col-12" id="btn_paginator"> 
                </div>
            </div>
        </div>
        <!-- FIN BLOQUE LISTADO CURSOS -->
    </div>
</div>

<?php
	get_footer();
?>