<?php 


//CBC News BD Basic setup

function cbcnews_theme_basic(){
    add_theme_support( 'title-tag' );
    add_theme_support( 'feature-image' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'cbcnews_theme_basic' );

//CBC NEWS BD styles and JS files

function cbcnewsbd_styles_scripts_register(){
    wp_enqueue_style( 'bootstrap-icons', get_template_directory_uri() . '/assets/css/bootstrap-icons.css' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'boxicons', get_template_directory_uri() . '/assets/css/boxicons.min.css' );
    wp_enqueue_style( 'fencybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css' );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css' );
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/style.css' );

    wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'swiper-script', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'marquee', get_template_directory_uri() . '/assets/js/jquery.marquee.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'cbcnewsbd_styles_scripts_register' );


//Nav Menus Register
if ( ! function_exists( 'cbcnews_register_nav_menu' ) ) {

	function cbcnews_register_nav_menu(){
		register_nav_menus( array(
	    	'primary_menu' => __( 'Main Menu', 'cbcnewsbd' ),
	    	'footer_menu'  => __( 'Footer Menu', 'cbcnewsbd' ),
		) );
	}
	add_action( 'after_setup_theme', 'cbcnews_register_nav_menu', 0 );
}

class Bootstrap_Navwalker extends Walker_Nav_Menu {
    // Add classes to ul sub-menus
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu\">\n";
    }

    // Add main level classes to li elements and anchor tags
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        // Add Bootstrap classes
        $classes[] = ($args->walker->has_children) ? 'nav-item dropdown' : 'nav-item';
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )       ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )       ? $item->url        : '';
        
        // Add Bootstrap-specific classes for links
        $atts['class']  = ( $args->walker->has_children ) ? 'nav-link dropdown-toggle' : 'nav-link';
        if ( $args->walker->has_children ) {
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['aria-expanded'] = 'false';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}


function cbcnewsbd_news_post_type() {
    $labels = array(
        'name'               => 'News',
        'singular_name'      => 'News',
        'menu_name'          => 'News',
        'name_admin_bar'     => 'News',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New News',
        'new_item'           => 'New News',
        'edit_item'          => 'Edit News',
        'view_item'          => 'View News',
        'all_items'          => 'All News',
        'search_items'       => 'Search News',
        'parent_item_colon'  => 'Parent News:',
        'not_found'          => 'No News found.',
        'not_found_in_trash' => 'No News found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'news' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'taxonomies'         => array( 'news_category' ),
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'       => true, // Enable Gutenberg editor
        'show_in_nav_menus'  => true,
    );

    register_post_type( 'news', $args );

    // CBCNEWSBD Editorial Post Type
    $labels = array(
        'name'               => 'Editorial',
        'singular_name'      => 'Editorial',
        'menu_name'          => 'Editorial',
        'name_admin_bar'     => 'Editorial',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Editorial',
        'new_item'           => 'New Editorial',
        'edit_item'          => 'Edit Editorial',
        'view_item'          => 'View Editorial',
        'all_items'          => 'All Editorials',
        'search_items'       => 'Search Editorial',
        'parent_item_colon'  => 'Parent Editorial:',
        'not_found'          => 'No Editorial found.',
        'not_found_in_trash' => 'No Editorial found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'editorial' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'       => true, // Enable Gutenberg editor
        'show_in_nav_menus'  => true,
    );

    register_post_type( 'cbcnewsbd_editorial', $args );
}
add_action( 'init', 'cbcnewsbd_news_post_type' );

//CBCNEWSBD Custom Taxonomy for News Post Type
function cbcnewsbd_news_taxonomy() {
    $labels = array(
        'name'              => 'News Categories',
        'singular_name'     => 'Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'parent_item'       => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Category',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'news-category' ),
        'show_in_rest'      => true, 
        'show_in_nav_menus' => true,
    );

    register_taxonomy( 'news_category', array( 'news' ), $args );
}
add_action( 'init', 'cbcnewsbd_news_taxonomy' );

//Registering Widgets

function cbcnewsbd_widgets_register(){
    register_sidebar(
        array(
            'name'          => __( 'CBC News BD Right Sidebar', 'cbcnews' ),
            'id'            => 'cbcnews-right-sidebar',
            'before_widget' => '<div class="sidebar-card">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>'
        )
    );
}
add_action( 'widgets_init', 'cbcnewsbd_widgets_register' );


function modify_category_archive_query( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_category() ) {
        $query->set( 'posts_per_page', 6 ); // Limit posts per page
        $query->set( 'orderby', 'date' );   // Order by date
        $query->set( 'order', 'DESC' );     // Set descending order
    }
}
add_action( 'pre_get_posts', 'modify_category_archive_query' );
