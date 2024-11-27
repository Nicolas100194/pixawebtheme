<?php

function theme_pixaweb_register_assets() {
    wp_enqueue_style('themepixaweb', get_stylesheet_directory_uri().'/assets/sass/main.css');
}

function theme_pixaweb_support(){
    add_theme_support('title-tag');
}


function pixaweb_theme_setup() {
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'pixaweb'),
    ));
}

function pixaweb_menu_link_attributes($attrs){
    $attrs['class'] = 'nav-link';
    return $attrs;
}





add_action('after_setup_theme', 'pixaweb_theme_setup');
add_action('wp_enqueue_scripts', 'theme_pixaweb_register_assets');
add_action('after_setup_theme', 'theme_pixaweb_support');
add_filter('nav_menu_link_attributes', 'pixaweb_menu_link_attributes');
