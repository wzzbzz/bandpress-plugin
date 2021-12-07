<?php
namespace bandpress\Controllers;

class BandsController{

    public function init(){
        self::rewrites();
        self::register_taxonomy();
        add_filter('query_vars', array(self::class, 'queryVars'));
    }

    private function register_taxonomy(){
        $labels = array(
            'name' => _x( 'Bands', 'taxonomy general name' ),
            'singular_name' => _x( 'Band', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Bands' ),
            'all_items' => __( 'All Bands' ),
            //'parent_item' => __( 'Parent Subject' ),
            //'parent_item_colon' => __( 'Parent Subject:' ),
            'edit_item' => __( 'Edit Band' ), 
            'update_item' => __( 'Update Band' ),
            'add_new_item' => __( 'Add New Band' ),
            'new_item_name' => __( 'New Band Name' ),
            'menu_name' => __( 'Bands' ),
          );    
        
        // Now register the taxonomy
          register_taxonomy('band',array('users', 'song'), array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'band' ),
          ));
    }

    private function rewrites(){
      add_rewrite_rule("^bandpress/band/([^\/]+)/?$", "index.php?package=bandpress&pagename=band-profile&band_id=\$matches[1]", "top");
    }

    public function queryVars( $vars ){
        $vars[] = 'band_id';
        $vars[] = 'song_slug';
        return $vars;
    }
    
    public function addBand( $bandName ){
        $result = wp_insert_term($bandName,'band');
        if( is_wp_error( $result ) ){
            return $result;
        }
        else{
            $term = get_term($result['term_id']);
            return new \bandpress\Models\Band( $term );
        }
    }

}