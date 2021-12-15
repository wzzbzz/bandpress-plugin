<?php

namespace bandpress\Controllers;

class SessionsController
{
    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function init()
    {
        self::rewrites();
        self::register_post_type();
    }

    private function register_post_type()
    {
        register_post_type(
            'session',
            array(
                'labels'                => array(
                    'name'                     => _x('Sessions', 'post type general name'),
                    'singular_name'            => _x('Session', 'post type singular name'),
                    'add_new'                  => _x('Add New', 'Session'),
                    'add_new_item'             => __('Add new Session'),
                    'new_item'                 => __('New Session'),
                    'edit_item'                => __('Edit Session'),
                    'view_item'                => __('View Session'),
                    'all_items'                => __('All Sessions'),
                    'search_items'             => __('Search Sessions'),
                    'not_found'                => __('No Sessions found.'),
                    'not_found_in_trash'       => __('No Sessions found in Trash.'),
                    'filter_items_list'        => __('Filter Sessions list'),
                    'items_list_navigation'    => __('Sessions list navigation'),
                    'items_list'               => __('Sessions list'),
                    'item_published'           => __('Session published.'),
                    'item_published_privately' => __('Session published privately.'),
                    'item_reverted_to_draft'   => __('Session reverted to draft.'),
                    'item_scheduled'           => __('Session scheduled.'),
                    'item_updated'             => __('Session updated.'),
                ),
                'public'                => false,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'rewrite'               => false,
                //'show_in_rest'          => true,
                //'rest_base'             => 'blocks',
                //'rest_controller_class' => 'WP_REST_Blocks_Controller',
                //'capability_type'       => 'block',
                /*'capabilities'          => array(
                    // You need to be able to edit posts, in order to read blocks in their raw form.
                    'read'                   => 'edit_posts',
                    // You need to be able to publish posts, in order to create blocks.
                    'create_posts'           => 'publish_posts',
                    'edit_posts'             => 'edit_posts',
                    'edit_published_posts'   => 'edit_published_posts',
                    'delete_published_posts' => 'delete_published_posts',
                    'edit_others_posts'      => 'edit_others_posts',
                    'delete_others_posts'    => 'delete_others_posts',
                ),*/
                //'map_meta_cap'          => true,
                'supports'              => array(
                    'title',
                    'editor',
                    'revisions',
                ),
            )
        );
    }

    private function rewrites()
    {
        add_rewrite_rule("^bandpress/session/([^\/]+)?$", "index.php?package=bandpress&pagename=session-profile&name=\$matches[1]", "top");
    }
}
