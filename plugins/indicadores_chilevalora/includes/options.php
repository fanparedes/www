<?php

    add_action( 'admin_menu', 'ind_options_page' );

    function ind_options_page() {
        add_menu_page(
            'Indicadores',
            'Indicadores Chilevalora',
            'manage_options',        
            IND_RUTA . 'admin/configuration.php',
            null,
            plugin_dir_url(__FILE__) . 'images/icon_wporg.png',
            20
        );
    }

    add_action('admin_menu', 'ind_submenu_administrador' );

    function ind_submenu_administrador(){

        add_submenu_page(IND_RUTA . 'admin/configuration.php','AFC','AFC','manage_options', admin_url('admin.php') . '?page=indicadores_chilevalora/admin/origen_datos.php&origen=AFC', null, 21);

        add_submenu_page(IND_RUTA . 'admin/configuration.php','Casen','Casen','manage_options',admin_url('admin.php') . '?page=indicadores_chilevalora/admin/origen_datos.php&origen=CASEN', null, 22);

        add_submenu_page(IND_RUTA . 'admin/configuration.php','Observatorio','Observatorio','manage_options',admin_url('admin.php') . '?page=indicadores_chilevalora/admin/origen_datos.php&origen=ENADEL', null, 23);

        add_submenu_page(IND_RUTA . 'admin/configuration.php','Indicadores','','manage_options' , IND_RUTA . 'admin/origen_datos.php', null, 24);

        add_submenu_page(IND_RUTA . 'admin/configuration.php','Añadir indicador','','manage_options' , IND_RUTA . 'admin/create_ind.php', null, 26);
    }

    

    add_action( 'admin_enqueue_scripts', 'my_enqueue_script' );

    function my_enqueue_script( $hook ) {
        wp_enqueue_style( 'indicadores-chilevalora-style', get_template_directory_uri() . '/css/bootstrap.min.css');
        wp_enqueue_style( 'indicadores-chilevalora-sweetalert2-style', get_template_directory_uri() . '/css/sweetalert2.min.css');
        wp_enqueue_style( 'tempusdominus-style', get_template_directory_uri() . '/css/tempusdominus.min.css');

        wp_enqueue_style( 'datatables', plugin_dir_url(dirname(__FILE__)) . 'css/datatables.css'); 
        wp_enqueue_style( 'main-chilevalora-style', plugin_dir_url(dirname(__FILE__)) . 'css/main.css'); 

        wp_enqueue_script('indicadores-chilevalora', get_template_directory_uri(). '/js/bootstrap.min.js', array(), '20151215', true);

        wp_enqueue_script('indicadores-chilevalora-sweetalert2', get_template_directory_uri(). '/js/sweetalert2.min.js', array(), '20151215', true);

        wp_enqueue_script('datatables', plugin_dir_url(dirname(__FILE__)) . '/js/datatables.min.js', array(), '20151215', true);

        wp_enqueue_script('tempusdominus-script', get_template_directory_uri(). '/js/tempusdominus.min.js', array(), '20151215', true);

        wp_enqueue_script('moments', get_template_directory_uri(). '/js/moment.min.js', array(), '20151215', true);

        wp_enqueue_script( 'ajax-script',
            plugins_url( '../js/scripts.js', __FILE__ ),
            array( 'jquery' )
        );

        $indicador_nonce = wp_create_nonce( 'indicador' );

        wp_localize_script('ajax-script', 'ajax_var', array(
            'url' => admin_url('/admin-ajax.php'),
            
        )); 
    }

    add_action( 'wp_ajax_get_types_indicator', 'get_types_indicator' );

    function get_types_indicator() {
        global $wpdb;
        check_ajax_referer( 'indicador' );
        
        if(isset($_POST['id'])){
            $result = $wpdb->get_results('SELECT * FROM cl_indicator_type where id_indicator_section = '.$_POST['id'].'', OBJECT);
        }

        // $response = update_ind($_POST['id'], $estatus);
        echo json_encode($result);
        wp_die();
    }

    function update_ind($id, $status){
        global $wpdb;
        $respuesta = $wpdb->update( 'cl_indicators', 
            // Datos que se remplazarán
            array( 
                'status' => $status
            ),
            // Cuando el ID del campo es igual al número 1
            array( 'id_indicator' => $id )
        );

        return $respuesta;
    }

    

 
?>



