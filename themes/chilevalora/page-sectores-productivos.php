<?php
	get_header(); 
?>
<div class="bloque-titular">
    <div class="container">
        <h1>Sectores productivos</h1>
        <div class="filtros-titular">
            <a href="#" class="openFiltroSector">Elige un sector <i class="fal fa-filter"></i></a>
            <a href="#" class="openFiltroRegion">Elige una región <i class="fal fa-filter"></i></a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- BLOQUE PODIO -->
        <div class="bloque-podio">
            <div class="intro">
                <div class="icono"><i class="iconcl-podium-xl"></i></div>
                <h2>Número de ocupados</h2>
                <p>Sectores con mayor crecimiento en el nº de ocupados en todo el territorio nacional <a href="#popover" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fas fa-question-circle"></i></a></p>
            </div>
            <!-- CARRUSEL PODIO -->
            <?php
            	//Sectores con mayor crecimiento en el nº de ocupados en todo el territorio nacional 	
            	echo do_shortcode( '[sector_crecimiento_nacional]' ); 
            ?>
        </div>
        <!-- FIN BLOQUE PODIO -->
        <!-- BLOQUE CABECERA -->
        <div class="col-12 jnsn">
            <div class="bloque-cabecera">
                <div class="linea"><i class="iconcl-mujeres"></i></div>
                <h2>Mujeres</h2>
                <p>Sectores con mayor porcentaje de mujeres en todo el territorio nacional</p>
            </div>
        </div>
        <!-- FIN BLOQUE CABECERA -->
        <!-- BLOQUE BARRA DISTRIBUTIBA -->
        <div class="col-12 col-lg-8 offset-lg-2">
            <div class="bloque-barra">
            	<?php
	            	//Sectores con mayor porcentaje de mujeres en todo el territorio nacional
	            	echo do_shortcode( '[sector_crecimiento_mujeres]' ); 
	            ?>
            </div>
        </div>
        <!-- FIN BLOQUE BARRA DISTRIBUTIBA -->
        <!-- BLOQUE CABECERA -->
        <div class="col-12">
            <div class="bloque-cabecera">
                <div class="linea"><i class="iconcl-migrante"></i></div>
                <h2>Migrantes</h2>
                <p>Sectores con mayor porcentaje de migrantes en todo el territorio nacional</p>
            </div>
        </div>
        <!-- FIN BLOQUE CABECERA -->
        <!-- BLOQUE INDICADORES DISTRIBUTIVA -->
        	<?php
            	//Sectores con mayor porcentaje de migrantes en todo el territorio nacional
            	echo do_shortcode( '[sector_crecimiento_migrantes]' ); 
            ?>
        </div>
        <!-- FIN BLOQUE INDICADORES DISTRIBUTIVA -->
        <!-- BLOQUE CABECERA -->
        <div class="col-12">
            <div class="bloque-cabecera">
                <div class="linea"><i class="iconcl-contratos"></i></div>
                <h2>Contratos indefinidos</h2>
                <p>Sectores con mayor porcentaje de contratos indefinidos en todo el territorio nacional</p>
            </div>
        </div>
        <!-- FIN BLOQUE CABECERA -->
        <!-- BLOQUE BARRA DISTRIBUTIBA -->
        <div class="col-12 col-lg-8 offset-lg-2">
        	<?php
            	//Sectores con mayor porcentaje de contratos indefinidos en todo el territorio nacional
            	echo do_shortcode( '[sector_crecimiento_contrato]' ); 
            ?>
        </div>
        <!-- FIN BLOQUE BARRA DISTRIBUTIBA -->
        <!-- BLOQUE ICONO -->
        <div class="col-12">
            <?php
            	//Sector con mayor incorporación de nuevos trabajadores
            	echo do_shortcode( '[sector_crecimiento_ingreso_trabajadores]' ); 
            ?>
        </div>
        <!-- FIN BLOQUE ICONO -->
        <!-- BLOQUE CABECERA -->
        <div class="col-12">
            <div class="bloque-cabecera red">
                <div class="linea"><i class="iconcl-cesantia"></i></div>
                <h2>Duración Cesantía</h2>
                <p>Sectores con mayor duración de cesantía en todo el territorio nacional</p>
            </div>
        </div>
        <!-- FIN BLOQUE CABECERA -->
        <!-- BLOQUE INDICADORES DISTRIBUTIVA -->
        <div class="bloque-indicadores-distributiva">
            <div class="owl-carousel owl-theme">
                <div class="col-12 col-md-6 item">
                    <div class="bloque-indicador-dato">
                        <div class="grafica-circulo red">
                            <a href="<?php echo get_site_url().'/detalle_sector/pesca/?code_sector=51040'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
                            <a href="<?php echo get_site_url().'/detalle_sector/pesca/?code_sector=51040'; ?>">
                                <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
                                <circle class="complete" cx="40" cy="40" r="35"></circle>
                                <text class="percentage" x="50%" y="50%" transform="matrix(0, 1, -1, 0, 80, 0)">18</text>
                                <text class="text-sub" x="50%" y="66%" transform="matrix(0, 1, -1, 0, 80, 0)">MESES</text>
                                </svg>
                            </a>
                        </div>
                        <div class="text">
                            <a href="<?php echo get_site_url().'/detalle_sector/pesca/?code_sector=51040'; ?>" class="title">Pesca</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 item">
                    <div class="bloque-indicador-dato">
                        <div class="grafica-circulo red">
                            <a href="<?php echo get_site_url().'/detalle_sector/servicios-sociales-y-de-salud/?code_sector=851110'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
                            <a href="<?php echo get_site_url().'/detalle_sector/servicios-sociales-y-de-salud/?code_sector=851110'; ?>">
                                <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
                                <circle class="complete" cx="40" cy="40" r="35"></circle>
                                <text class="percentage" x="50%" y="50%" transform="matrix(0, 1, -1, 0, 80, 0)">6</text>
                                <text class="text-sub" x="50%" y="66%" transform="matrix(0, 1, -1, 0, 80, 0)">MESES</text>
                                </svg>
                            </a>
                        </div>
                        <div class="text">
                            <a href="<?php echo get_site_url().'/detalle_sector/servicios-sociales-y-de-salud/?code_sector=851110'; ?>" class="title">Servicios Sociales Y De Salud</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 item">
                    <div class="bloque-indicador-dato">
                        <div class="grafica-circulo red">
                            <a href="<?php echo get_site_url().'/detalle_sector/suministro-de-electricidad-gas-y-agua/?code_sector=401011'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
                            <a href="<?php echo get_site_url().'/detalle_sector/suministro-de-electricidad-gas-y-agua/?code_sector=401011'; ?>">
                                <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
                                <circle class="complete" cx="40" cy="40" r="35"></circle>
                                <text class="percentage" x="50%" y="50%" transform="matrix(0, 1, -1, 0, 80, 0)">10</text>
                                <text class="text-sub" x="50%" y="66%" transform="matrix(0, 1, -1, 0, 80, 0)">MESES</text>
                                </svg>
                            </a>
                        </div>
                        <div class="text">
                            <a href="<?php echo get_site_url().'/detalle_sector/suministro-de-electricidad-gas-y-agua/?code_sector=401011'; ?>" class="title">Suministro De Electricidad, Gas Y Agua</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 item">
                    <div class="bloque-indicador-dato">
                        <div class="grafica-circulo red">
                            <a href="<?php echo get_site_url().'/detalle_sector/agricultura-ganaderia-caza-y-silvicultura/?code_sector=11113'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
                            <a href="<?php echo get_site_url().'/detalle_sector/agricultura-ganaderia-caza-y-silvicultura/?code_sector=11113'; ?>">
                                <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
                                <circle class="complete" cx="40" cy="40" r="35"></circle>
                                <text class="percentage" x="50%" y="50%" transform="matrix(0, 1, -1, 0, 80, 0)">9</text>
                                <text class="text-sub" x="50%" y="66%" transform="matrix(0, 1, -1, 0, 80, 0)">MESES</text>
                                </svg>
                            </a>
                        </div>
                        <div class="text">
                            <a href="<?php echo get_site_url().'/detalle_sector/agricultura-ganaderia-caza-y-silvicultura/?code_sector=11113'; ?>" class="title">Agricultura, Ganadería, Caza Y Silvicultura</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-10 offset-xl-1">
                <div class="row owl-desktop justify-content-center">
                    <div class="col-2 col-sm-6 col-lg-3 col-xl-3">
                        <div class="bloque-indicador-dato">
                            <div class="grafica-circulo red">
                                <a href="<?php echo get_site_url().'/detalle_sector/pesca/?code_sector=51040'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
                                <a href="<?php echo get_site_url().'/detalle_sector/pesca/?code_sector=51040'; ?>">
                                    <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
                                    <circle class="complete" cx="40" cy="40" r="35"></circle>
                                    <text class="percentage" x="50%" y="50%" transform="matrix(0, 1, -1, 0, 80, 0)">18</text>
                                    <text class="text-sub" x="50%" y="66%" transform="matrix(0, 1, -1, 0, 80, 0)">MESES</text>
                                    </svg>
                                </a>
                            </div>
                            <div class="text">
                                <a href="<?php echo get_site_url().'/detalle_sector/pesca/?code_sector=51040'; ?>" class="title">Pesca</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-sm-6 col-lg-3 col-xl-3">
                        <div class="bloque-indicador-dato">
                            <div class="grafica-circulo red">
                                <a href="<?php echo get_site_url().'/detalle_sector/servicios-sociales-y-de-salud/?code_sector=851110'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
                                <a href="<?php echo get_site_url().'/detalle_sector/servicios-sociales-y-de-salud/?code_sector=851110'; ?>">
                                    <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
                                    <circle class="complete" cx="40" cy="40" r="35"></circle>
                                    <text class="percentage" x="50%" y="50%" transform="matrix(0, 1, -1, 0, 80, 0)">6</text>
                                    <text class="text-sub" x="50%" y="66%" transform="matrix(0, 1, -1, 0, 80, 0)">MESES</text>
                                    </svg>
                                </a>
                            </div>
                            <div class="text">
                                <a href="<?php echo get_site_url().'/detalle_sector/servicios-sociales-y-de-salud/?code_sector=851110'; ?>" class="title">Servicios Sociales Y De Salud</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-sm-6 col-lg-3 col-xl-3">
                        <div class="bloque-indicador-dato">
                            <div class="grafica-circulo red">
                                <a href="<?php echo get_site_url().'/detalle_sector/suministro-de-electricidad-gas-y-agua/?code_sector=401011'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
                                <a href="<?php echo get_site_url().'/detalle_sector/suministro-de-electricidad-gas-y-agua/?code_sector=401011'; ?>">
                                    <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
                                    <circle class="complete" cx="40" cy="40" r="35"></circle>
                                    <text class="percentage" x="50%" y="50%" transform="matrix(0, 1, -1, 0, 80, 0)">10</text>
                                    <text class="text-sub" x="50%" y="66%" transform="matrix(0, 1, -1, 0, 80, 0)">MESES</text>
                                    </svg>
                                </a>
                            </div>
                            <div class="text">
                                <a href="<?php echo get_site_url().'/detalle_sector/suministro-de-electricidad-gas-y-agua/?code_sector=401011'; ?>" class="title">Suministro De Electricidad, Gas Y Agua</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-sm-6 col-lg-3 col-xl-3">
                        <div class="bloque-indicador-dato">
                            <div class="grafica-circulo red">
                                <a href="<?php echo get_site_url().'/detalle_sector/agricultura-ganaderia-caza-y-silvicultura/?code_sector=11113'; ?>" class="icon-plus"><i class="fal fa-plus"></i></a>
                                <a href="<?php echo get_site_url().'/detalle_sector/agricultura-ganaderia-caza-y-silvicultura/?code_sector=11113'; ?>">
                                    <svg class="radial-full" data-percentage="100" viewBox="0 0 80 80">
                                    <circle class="complete" cx="40" cy="40" r="35"></circle>
                                    <text class="percentage" x="50%" y="50%" transform="matrix(0, 1, -1, 0, 80, 0)">9</text>
                                    <text class="text-sub" x="50%" y="66%" transform="matrix(0, 1, -1, 0, 80, 0)">MESES</text>
                                    </svg>
                                </a>
                            </div>
                            <div class="text">
                                <a href="<?php echo get_site_url().'/detalle_sector/agricultura-ganaderia-caza-y-silvicultura/?code_sector=11113'; ?>" class="title">Agricultura, Ganadería, Caza Y Silvicultura</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN BLOQUE INDICADORES DISTRIBUTIVA -->
    </div>
</div>

<?php
	get_footer();
?>