<?php
// Asegúrate de que esta constante esté definida antes de usarla
if ( ! defined( 'WP_EIA_PLUGIN_DIR' ) ) {
    // Esto es un fallback, si se incluye directamente, pero debería venir del archivo principal
    define( 'WP_EIA_PLUGIN_DIR', plugin_dir_path( dirname( __FILE__ ) ) . '/' );
}

add_action( 'admin_menu', 'eia_register_admin_menus' );

function eia_register_admin_menus() {
    // Menú Principal
    add_menu_page(
        'WP EIA',
        'EIA DEV',
        'manage_options',
        'wp-eia',
        'render_main', // Función callback para la página principal
        'dashicons-admin-plugins',
        1
    );

    // Submenú para Listar Elementos
    add_submenu_page(
        'wp-eia',
        'Gestion De Imágenes',
        'Gestion De Imágenes',
        'manage_options',
        'images',
        'render_images' // Función callback para listar
    );

    // Submenú para Añadir Nuevo Elemento
    add_submenu_page(
        'wp-eia',
        'Gestion de Documentos',
        'Gestion de Documentos',
        'manage_options',
        'documents',
        'render_documents' // Función callback para añadir
    );
}

// --- Funciones de renderizado (simplemente incluyen el archivo de la vista) ---

function render_main() {
    require_once WP_EIA_PLUGIN_DIR . 'includes/views/main.php';
}

function render_images() {
    require_once WP_EIA_PLUGIN_DIR . 'includes/views/images.php';
}

function render_documents() {
    require_once WP_EIA_PLUGIN_DIR . 'includes/views/documents.php';
}