<?php
function get_enclosure($path) {
    global $wpdb;

    // Escapar la cadena para REGEXP (por si contiene caracteres especiales)
    $pattern = preg_quote($path, '/');

    $sql = $wpdb->prepare(
        "SELECT pm.post_id 
         FROM {$wpdb->postmeta} pm
         INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
         WHERE pm.meta_key = 'enclosure'
           AND pm.meta_value REGEXP %s
           AND p.post_status IN ('publish','private','draft')
           AND p.post_type IN (
            'post','page','custom_post_type','lp_course','service','portfolio',
            'gva_event','gva_header','footer','team','elementskit_template',
            'elementskit_content','elementor_library'
          )
         LIMIT 1",
        $pattern
    );
    $result = $wpdb->get_var($sql);
    return $result ? true : false;
}
