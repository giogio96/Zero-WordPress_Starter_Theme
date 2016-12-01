<?php 

/* TASSONOMIE */
add_action( 'init', 'custom_taxonomy', 0 );

function custom_taxonomy() {	
  // DISCIPLINE
  register_taxonomy('tax_eventi', array('eventi'), array(
    'hierarchical' => true,
    'labels' => array(
        'name' => _x( 'Categorie', 'nomi delle tassonomie' ),
        'singular_name' => _x( 'Categoria', 'nome della tassonomia' ),
        'search_items' =>  __( 'Cerca Categoria' ),
        'all_items' => __( 'Tutte le Categorie' ),
        'parent_item' => __( 'Genitore' ),
        'parent_item_colon' => __( 'Genitore:' ),
        'edit_item' => __( 'Modifica Categoria' ), 
        'update_item' => __( 'Aggiorna Categoria' ),
        'add_new_item' => __( 'Aggiungi Nuova Categoria' ),
        'new_item_name' => __( 'Nome Categoria' ),
        'menu_name' => __( 'Categoria' ),
    ),
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'categorie/eventi' ),
  ));
    
}

// Our custom post type function
function custom_post_type() {
    // Eventi
	register_post_type( 'eventi',
	    // CPT Options
		array( 'labels' => array(
			'name'        		  =>  'Eventi',
			'singular_name'       =>  'Evento',
			'menu_name'           =>  'Eventi', 
			'parent_item_colon'   =>  'Genitore', 
			'all_items'           =>  'Tutti gli Eventi', 
			'view_item'           =>  'Visualizza Eventi', 
			'add_new_item'        =>  'Nuovo Evento',
            'add_new'             =>  'Nuovo Evento',
			'edit_item'           =>  'Modifica Evento', 
			'update_item'         =>  'Aggiorna Evento', 
			'search_items'        =>  'Cerca Evento', 
			'not_found'           =>  'Nessun Risultato', 
			'not_found_in_trash'  =>  'Nessun Risultato', 
			),
			'description'         => '',
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 4,
			'menu_icon'           => 'dashicons-calendar',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite' => array('slug' => 'eventi'),
			'taxonomies' => array('tax_eventi'),
            'supports' => array( 'title', 'tax_eventi', 'editor', 'thumbnail', 'custom-fields', 'revisions', 'sticky', 'page-attributes')
		)
	);
    
	flush_rewrite_rules();
}
// Hooking up our function to theme setup
add_action( 'init', 'custom_post_type' );

// Rename Posts
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Nuova News';
    echo '';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Nuova News';
    $labels->add_new_item = 'Aggiungi Nuova News';
    $labels->edit_item = 'Modifica News';
    $labels->new_item = 'News';
    $labels->view_item = 'Visualizza';
    $labels->search_items = 'Cerca News';
    $labels->not_found = 'Nessun Risultato';
    $labels->not_found_in_trash = 'Nessun Risultato';
    $labels->all_items = 'Tutte le News';
    $labels->menu_name = 'News Società';
    $labels->name_admin_bar = 'News Società';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );

// Remove tags support from posts
function unregister_tag() {
    //unregister_taxonomy_for_object_type('post_tag', 'post');
    //unregister_taxonomy_for_object_type('category', 'post');
    //unregister_taxonomy_for_object_type('tribe_events_cat', 'tribe_events');
    //unregister_taxonomy_for_object_type('post_tag', 'tribe_events');
}
add_action('init', 'unregister_tag');

?>
