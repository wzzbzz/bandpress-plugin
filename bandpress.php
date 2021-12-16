<?php
/** 
Plugin Name: Bandpress!  Band collaboration tools
@category tag in file comment
 **/

namespace bandpress;

class BandPressApplication
{
    public function __construct()
    {

        if(wp_get_theme()->name !=="vinepress") {
            return;
        }

        // action hooks
        register_activation_hook(__FILE__, array($this,'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate' ));

        add_action('init', array($this,'init'));
        add_action('admin_init', array($this,'admin_init'));


    }

    public function activate()
    {
        $paths = get_option('root_paths');
        
        if(empty($paths)) {
            return false;
        }
        
        if(array_search(dirname(__FILE__), $paths)) {
            return;
        }
        $paths["bandpress"] = dirname(__FILE__);

        update_option("root_paths", $paths);

    }

    public function deactivate()
    {
        $paths = get_option('root_paths');        
        unset($paths[ array_search(dirname(__FILE__), $paths) ]);
        update_option('root_paths', $paths);
    }

    public function init()
    {

        self::_capabilities();
        self::_rewrites();

        //set up bands
        \bandpress\Controllers\BandsController::init();
        \bandpress\Controllers\SongsController::init();
        \bandpress\Controllers\SessionsController::init();

        add_action("wp", array(self::class, "setPage"));
    }

    public function admin_init()
    {
    }

    private function _rewrites()
    {
        // homepage 
        add_rewrite_rule(
            "^bandpress/?$", 
            "index.php?package=bandpress&pagename=home", 
            "top"
        );

    }

    private function _capabilities()
    {
        
        $role = get_role("administrator");
        $role->add_cap("send_bulletins");
        $role->add_cap("access_admin");


    }
    public function setPage()
    {

        $package = get_query_var('package');
        $pagename = get_query_var('pagename');
                        
        if('bandpress' !== $package) {
            return;
        }

        switch ($pagename){
        case 'session-profile':
            $sessions = new \bandpress\Models\Sessions();
            $session = $sessions->bySlug(get_query_var('name'));
            $view = new \bandpress\Views\PageViews\SessionView( $session );
            app()->setCurrentView($view);
            break;
        case 'song-profile':
            $bands = new \bandpress\Models\Bands();
            $band = $bands->BySlug(get_query_var("band_id"));
            $song = $band->findSongBySlug(get_query_var("song_slug"));
            $view = new \bandpress\Views\PageViews\SongProfilePageView();
            $view->setBand($band);
            $view->setSong($song);
            app()->setCurrentView($view);
            break;
        case 'band-profile':
            $bands = new \bandpress\Models\Bands();
            $band = $bands->bySlug(get_query_var("band_id"));
            $view  = new \bandpress\Views\PageViews\BandProfilePageView($band);
            app()->setCurrentView($view);
            break;
        case 'home':
        default:
            $view = new \bandpress\Views\PageViews\HomePageView($schedule);
            app()->setCurrentView($view);
            break;
        }

        return;
    }
}


$bandpress = new BandPressApplication();

