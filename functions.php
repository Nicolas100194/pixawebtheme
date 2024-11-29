<?php

function theme_pixaweb_register_assets() {
    wp_enqueue_style('themepixaweb', get_stylesheet_directory_uri().'/assets/sass/main.css');
    wp_enqueue_script('swiperjs-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
    wp_enqueue_script('slide', get_stylesheet_directory_uri().'/assets/js/slide.js', array(), null, true);
    wp_enqueue_script('swiper', get_stylesheet_directory_uri().'/assets/js/swiper.js', array(), null, true);
}

function theme_pixaweb_support(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
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

function pixaweb_projets(){
    register_post_type('projets',[
       'label' => 'Projets',
       'public' => true,
       'has_archive' => true,
       //'show_in_rest' => true,
       'supports' => ['title', 'thumbnail', 'editor']
    ]);
}


function pixaweb_projets_images_shortcode($atts) {
    // Récupère les attributs (facultatif, pour personnaliser si nécessaire)
    $atts = shortcode_atts(
        [
            'posts_per_page' => 10, // Nombre de projets à afficher
            'size' => 'medium',    // Taille des images (thumbnail, medium, large, full)
        ],
        $atts,
        'projets_images'
    );

    // Requête pour récupérer les projets
    $args = [
        'post_type' => 'projets',
        'posts_per_page' => (int) $atts['posts_per_page'],
    ];

    $query = new WP_Query($args);

    // Contenu du shortcode
    $output = '<div class="swiper"><div class="swiper-wrapper">';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // Vérifie et récupère l'image mise en avant
            if (has_post_thumbnail()) {
                $output .= '<div class="swiper-slide">'.get_the_post_thumbnail(get_the_ID(), $atts['size']).'</div>';
            } else {
                // Image par défaut si aucune image mise en avant
                $output .= '<img src="' . esc_url(get_template_directory_uri() . '/images/default-thumbnail.jpg') . '" alt="Image par défaut">';
            }
        }
        wp_reset_postdata();
    } else {
        $output .= '<p>Aucun projet trouvé.</p>';
    }

    $output .= '</div></div>';

    return $output;
}
add_shortcode('projets_images', 'pixaweb_projets_images_shortcode');
add_action('init','pixaweb_projets');
add_action('after_setup_theme', 'pixaweb_theme_setup');
add_action('wp_enqueue_scripts', 'theme_pixaweb_register_assets');
add_action('after_setup_theme', 'theme_pixaweb_support');
add_filter('nav_menu_link_attributes', 'pixaweb_menu_link_attributes');
