<?php

// Action  scripts dans notre thème
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles(){
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css'); 
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/Plantytheme.css', array(), filemtime(get_stylesheet_directory() . '/css/Plantytheme.css'));
}
 // Ajout de menu admin  si utilisateurs connectés
add_filter('wp_nav_menu_items', 'Planty_add_admin_link_to_menu', 10, 2);
function Planty_add_admin_link_to_menu($items, $args) {
    //  si l'utilisateur est connecté
    if ($args->theme_location == 'primary' && is_user_logged_in()) {
        // Le lien "Admin"
        $admin_link = '<li><a href="http://localhost/Planty/wp-admin/">Admin</a></li>';
        
        // Insérer "Admin" apre "NOUS RENCONTRER"
        $items_array = explode('</li>', $items); // Convertir en tableau
        array_splice($items_array, 1, 0, $admin_link); // Insérer le lien
        
        //  caractères pour le menu
        $items = implode('</li>', $items_array);
    }
    return $items;
}
function register_footer_menu() {
    register_nav_menus(array(
        'footer-menu' => __('Menu de Footer', 'text_domain')
    ));
}
add_action('init', 'register_footer_menu');