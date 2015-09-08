<?php
/**
 * Background Music Player Lite
 *
 * @package   Background_Music_Player_Lite
 * @author    Circlewaves Team <support@circlewaves.com>
 * @license   GPL-2.0+
 * @link      http://circlewaves.com
 * @copyright 2014 Circlewaves Team <support@circlewaves.com>
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `background-music-player-admin.php`
 *
 *
 * @package   Background_Music_Player_Lite
 * @author    Circlewaves Team <support@circlewaves.com>
 */
class Background_Music_Player_Lite {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'background-music-player-lite';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;
	
	/**
	 * Background Music Player Taxonomy
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const MAIN_TAXONOMY = 'bmplayer_track';		
	
	/**
	 * Plugin Settings, used on Plugin Settings page
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	public static $pluginSettings=array(
		array(
			'name'=>'bmplayer-plugin-version',
			'hidden'=>1
		),	
		array(
			'name'=>'bmplayer-plugin-html',
			'hidden'=>1
		),			
		array(
			'name'=>'bmplayer-include-method', // how to include
			'title'=>'Include method',
			'section'=>'main-section',
			'field'=>array(
				'type'=>'dropdown',
				'options'=>array(
					'disabled'=>'Disable Player',
					'auto'=>'Auto Include (Recommended)',
					'manual'=>'Manual Mode (For advanced users)'
				)
			)
		),
		array(
			'name'=>'bmplayer-include-option', // where to include
			'title'=>'Include player on',
			'section'=>'main-section',
			'field'=>array(
				'type'=>'radio',
				'options'=>array(
					'all_pages'=>'All Pages',
					'homepage_exclude'=>'All Pages, exclude homepage'
				)
			)			
		),
		array(
			'name'=>'bmplayer-continue-play-mode', // experimental feature - mode
			'hidden'=>1			
		),
		array(
			'name'=>'bmplayer-continue-play-nav-selector',  // experimental feature - navigation selector
			'hidden'=>1
		),			
		array(
			'name'=>'bmplayer-continue-play-content-selector',  // experimental feature - content selector
			'hidden'=>1
		),		
		array(
			'name'=>'bmplayer-autoplay', 
			'title'=>'Enable autoplay',
			'section'=>'main-section',
			'field'=>array(
				'type'=>'checkbox',
				'description'=>'Play music automatically when page loads'
			)			
		),			
		array(
			'name'=>'bmplayer-playlist-repeat', 
			'title'=>'Repeat playlist',
			'section'=>'playlist-section',
			'field'=>array(
				'type'=>'checkbox',
				'description'=>'Automatically repeat playlist'
			)
		),
		array(
			'name'=>'bmplayer-playlist-order', 
			'title'=>'Playlist sort order',
			'section'=>'playlist-section',
			'field'=>array(
				'type'=>'dropdown',
				'options'=>array(
					'ASC'=>'Asc',
					'DESC'=>'Desc'
				),
				'description'=>'Sort tracks in accordance to "Sort Order" parameter. Shuffle is available in the <a href="http://codecanyon.net/item/background-music-player/7312865?ref=circlewaves" target="_blank">Full version</a>'
			)			
		),		
		array(
			'name'=>'bmplayer-style-skin', 
			'title'=>'Choose player style',
			'section'=>'style-section',
			'field'=>array(
				'type'=>'radio-image',
				'options'=>array(
					'bmplayer-style-1'=>array('Left Side','style_left.png'),
					'bmplayer-style-2'=>array('Right Side','style_right.png'),
					'bmplayer-style-3'=>array('Basic Box','style_box.png'),
					'bmplayer-style-4'=>array('Branded Circle','style_circle.png')
				)
			)					
		),
		array(
			'name'=>'bmplayer-style-color-main', 
			'title'=>'Buttons color',
			'section'=>'style-section',
			'field'=>array(
				'type'=>'colorpicker',
				'default-color'=>'#f4f4f4'
			)	
		),			
		array(
			'name'=>'bmplayer-style-color-background', 
			'title'=>'Background color',
			'section'=>'style-section',
			'field'=>array(
				'type'=>'colorpicker',
				'default-color'=>'#c1272d'
			),	
		),
		array(
			'name'=>'bmplayer-position-style', 
			'title'=>'Position type',
			'section'=>'position-section',
			'field'=>array(
				'type'=>'dropdown',
				'options'=>array(
					'fixed'=>'Fixed',
					'absolute'=>'Absolute',
					'static'=>'Static'
				),
				'description'=>'See <a href="http://docs.circlewaves.com/background-music-player/" target="_blank" title="See plugin documentation">plugin documentation</a> for more information'
			)		
		),		
		array(
			'name'=>'bmplayer-position-x-type', 
			'title'=>'Position X side',
			'section'=>'position-section',
			'field'=>array(
				'type'=>'dropdown',
				'options'=>array(
					'left'=>'Left',
					'right'=>'Right'
				),
				'description'=>'Only for Fixed and Absolute position'
			)				
		),	
		array(
			'name'=>'bmplayer-position-x-value', 
			'title'=>'Position X value',
			'section'=>'position-section',
			'field'=>array(
				'type'=>'text',
				'class'=>'small-text',
				'description'=>'Include units (em/px/%), eg: 10px'
			)				
		),		
		array(
			'name'=>'bmplayer-position-y-type', 
			'title'=>'Position Y side',
			'section'=>'position-section',
			'field'=>array(
				'type'=>'dropdown',
				'options'=>array(
					'top'=>'Top',
					'bottom'=>'Bottom'
				),
				'description'=>'Only for Fixed and Absolute position'
			)				
		),	
		array(
			'name'=>'bmplayer-position-y-value', 
			'title'=>'Position Y value',
			'section'=>'position-section',
			'field'=>array(
				'type'=>'text',
				'class'=>'small-text',
				'description'=>'Include units (em/px/%), eg: 10px'
			)	
		)		
	);		
	
	/**
	 * Plugin Settings Values
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	public static $pluginDefaultSettings=array(
		'plugin-version'=>array(
			'name'=>'bmplayer-plugin-version',
			'value'=>'1.0.0'
		),
		'plugin-html'=>array(
			'name'=>'bmplayer-plugin-html',
			'value'=>'
								<div class="bmplayer-container" id="bmplayer-container">
									<div class="bmplayer-container-content">
											<div class="bmplayer-controls-primary">
												<i class="bmplayer-btn-play fa fa-play"></i>
											</div>
											<div class="bmplayer-controls-secondary">
												<i class="bmplayer-btn-prev fa fa-backward"></i>
												<i class="bmplayer-btn-next fa fa-forward"></i>
											</div>
									</div>
								</div>
			'
		),
		'plugin-continue-play-nav-selector'=>array(
			'name'=>'bmplayer-continue-play-nav-selector',
			'value'=>'nav a'
		),
		'plugin-continue-play-content-selector'=>array(
			'name'=>'bmplayer-continue-play-content-selector',
			'value'=>'#main'
		),			
		'plugin-include-method'=>array(
			'name'=>'bmplayer-include-method',
			'value'=>'disabled'
		),	
		'plugin-include-option'=>array(
			'name'=>'bmplayer-include-option',
			'value'=>'all_pages'
		),		
		'plugin-autoplay'=>array(
			'name'=>'bmplayer-autoplay',
			'value'=>1
		),	
		'plugin-playlist-repeat'=>array(
			'name'=>'bmplayer-playlist-repeat',
			'value'=>1
		),
		'plugin-playlist-order'=>array(
			'name'=>'bmplayer-playlist-order',
			'value'=>'ASC'
		),
		'plugin-style-skin'=>array(
			'name'=>'bmplayer-style-skin',
			'value'=>'bmplayer-style-4'
		),
		'plugin-style-skin'=>array(
			'name'=>'bmplayer-style-skin',
			'value'=>'bmplayer-style-4'
		),		
		'plugin-style-color-main'=>array(
			'name'=>'bmplayer-style-color-main',
			'value'=>'#f4f4f4'
		),	
		'plugin-style-color-background'=>array(
			'name'=>'bmplayer-style-color-background',
			'value'=>'#c1272d'
		)
	);

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_and_scripts' ) );
		
		/*
		 *	Actions and filters for main plugin taxonomy and taxonomy metabox
		 */
		add_action( 'init', array( $this, 'create_plugin_post_type' ) );		
		add_action( 'save_post', array($this,'main_taxonomy_save_post') );
		add_action( 'admin_notices', array( $this, 'main_taxonomy_notice' ) );
		add_filter( 'enter_title_here', array( $this, 'backend_change_default_title') );
		// Change Admin Columns for Tracks post type
		add_filter( 'manage_edit-bmplayer_track_columns', array( $this, 'bmplayer_track_edit_columns') );
		add_action( 'manage_bmplayer_track_posts_custom_column', array( $this, 'bmplayer_track_columns'), 10, 2 );		
		// Make Admin Columns sortable
		add_filter( 'manage_edit-bmplayer_track_sortable_columns', array( $this, 'bmplayer_track_sortable_columns') );
		add_action( 'pre_get_posts', array( $this, 'bmplayer_track_orderby') );  		
		
		/*
		*		Init Player on the frontend
		*/
		add_action('wp_footer', array($this,'bmplayer_init_frontend'));

	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
			//Add plugin options (it does nothing if option already exists)
			foreach(self::$pluginDefaultSettings as $k=>$v){
				add_option( self::$pluginDefaultSettings[$k]['name'], self::$pluginDefaultSettings[$k]['value'] );	
			}		
			
			//Always update plugin version
			update_option( self::$pluginDefaultSettings['plugin-version']['name'], self::$pluginDefaultSettings['plugin-version']['value'] );
			update_option( self::$pluginDefaultSettings['plugin-html']['name'], self::$pluginDefaultSettings['plugin-html']['value'] );

			flush_rewrite_rules();
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
			flush_rewrite_rules();
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

	}


	/**
	 * Register and enqueues public-facing JavaScript files and styles.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles_and_scripts() {
		$bmplayer_options=self::bmplayer_get_settings();		
		
		if($bmplayer_options['bmplayer-include-method']!='disabled'){
			$bmplayer_enqueue_script=0;
			global $post;
			$post_id=$post->ID;
			
			//add custom variables to public.js, use plugin_options.var_name 
			$plugin_options = self::bmplayer_get_settings(1);				
			$tracks_args=array(
				'order'=>$bmplayer_options['bmplayer-playlist-order']
			);					
								
		
			switch($bmplayer_options['bmplayer-include-option']){
				case 'all_pages':
					$bmplayer_enqueue_script=1;
				break;
				case 'homepage_exclude':
					if(!is_front_page() || !is_home()){
						$bmplayer_enqueue_script=1;
					}
				break;
			}
			
			if($bmplayer_enqueue_script){
				$plugin_options['bmplayer_playlist']=self::bmplayer_get_tracks($tracks_args);		
				$plugin_options['bmplayer_plugin_url']=plugins_url('', dirname(__FILE__) );		
				wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
				wp_enqueue_style( $this->plugin_slug . '-font-awesome', plugins_url( 'assets/css/font-awesome.min.css', __FILE__ ), array(), self::VERSION );
				wp_enqueue_script( $this->plugin_slug . '-soundmanager2-script', plugins_url( 'soundmanager/soundmanager2-nodebug-jsmin.js', dirname(__FILE__) ), array( 'jquery' ), self::VERSION,true );				
				wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'assets/js/public.min.js', __FILE__ ), array( 'jquery',$this->plugin_slug . '-soundmanager2-script' ), self::VERSION,true );
				wp_localize_script( $this->plugin_slug . '-plugin-script', 'plugin_options', $plugin_options );				
			}
			
		}
	}
	
	/**
	 * Get plugin settings
	 *
	 * @since    1.0.0
	 */	
 	function bmplayer_get_settings($is_js_friendly=0) {
		$bmplayer_options=array();
		foreach(self::$pluginSettings as $setting){
			$option_key=$is_js_friendly?(str_replace('-','_',$setting['name'])):$setting['name']; // Replace "-" to "_" in array key to make array js friendly (to use it in localize_script)
			$bmplayer_options[$option_key] = get_option( $setting['name'] );
		}
		return $bmplayer_options;
	}	 
	
	/**
	 * Get all tracks
	 * 
	 * Params:
	 * $args['order'] - tracks sort order
	 * $args['tracklist'] - array of tracks ID's that should be returned, used with posts playlists
	 *
	 * @since    1.0.0
	 */	
 	function bmplayer_get_tracks($args=null) {
//		global $post;
	//	global $wp_query;
		$bmplayer_playlist=array();
		
		// WP_Query arguments
		$query_args = array (
			'post_type'              => self::MAIN_TAXONOMY,
			'post_status'            => 'publish',
			'nopagging' 							=> true,
			'posts_per_page' => 			'-1',
			'meta_query'             => array(
																					array(
																						'key'       => 'bmplayer_track_url',
																					)
			)				
		);	
		
		$args['order']=$args['order']?$args['order']:'ASC';
		if($args['order']=='rand'){
			$query_args['orderby']='rand';
		}else{
			$query_args['order']=$args['order'];
			$query_args['orderby']='menu_order';			
		}
		if((isset($args['tracklist']))&&(is_array($args['tracklist']))){
			$query_args['post__in']=$args['tracklist'];
		}
		// The Query
		$tracks_query = new WP_Query( $query_args );

		// The Loop
		if ( $tracks_query->have_posts() ) {
			while ( $tracks_query->have_posts() ) {
				$tracks_query->the_post();
				$post_id=get_the_ID();
				$track_url=get_post_meta( $post_id, 'bmplayer_track_url', true );
				$track_title='undefined';
				$track_artist='undefined';
				array_push($bmplayer_playlist,array('id'=>$post_id,'title'=>$track_title,'track'=>$track_url,'artist'=>$track_artist));
			}
		} else {
			// no posts found
		}

		// Restore original Post Data
		wp_reset_postdata();	
		
		return $bmplayer_playlist;
	}	 	
		
	
	/**
	 * Create plugin post type
	 *
	 * @since    1.0.0
	 */
	public function create_plugin_post_type() {
	
			$labels = array(
					'name' => 'BG Tracks',
					'singular_name' => 'Track',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New Track',
					'edit_item' => 'Edit Track',
					'new_item' => 'New Track',
					'view_item' => 'View Track',
					'search_items' => 'Search Tracks',
					'not_found' =>  'No Tracks found',
					'not_found_in_trash' => 'No Tracks in the trash',
					'parent_item_colon' => '',
			);
	 
			register_post_type( self::MAIN_TAXONOMY, array(
					'labels' => $labels,
					'public' => false,
					'publicly_queryable' => false,
					'show_ui' => true,
					'exclude_from_search' => true,
					'query_var' => false,
					'capability_type' => 'post',
					'has_archive' => false,
					'hierarchical' => false,
					'menu_position' => 100,
					'menu_icon' => 'dashicons-format-audio',
					'supports' => array( 'title','page-attributes'),
		      'register_meta_box_cb' => array($this, 'tracks_taxonomy_metabox') // Callback function for custom metaboxes
					) 
			);
			
		// refresh rewrite rules to solve 404 error (use soft flush)
			flush_rewrite_rules(false);
	}
	
	/**
	 * Add metabox to Projects
	 *
	 * @since    1.0.0
	 */
	public function tracks_taxonomy_metabox() {
			add_meta_box( 'background_music_player_track_metabox', __('Track Details',$this->plugin_slug), array($this,'main_taxonomy_metabox_form'), self::MAIN_TAXONOMY, 'normal', 'high' );
	}		
	
	/**
	 * Render metabox
	 *
	 * @since    1.0.0
	 */
	function main_taxonomy_metabox_form() {
    $post_id = get_the_ID();
		$the_post = get_post($post_id );
		$current_user = wp_get_current_user();
		
    $track_url = get_post_meta( $post_id, 'bmplayer_track_url', true );
		$track_url = isset( $track_url ) ? esc_attr( $track_url ) : '';  
		
		$track_artist = get_post_meta( $post_id, 'bmplayer_track_artist', true );
		$track_artist = isset( $track_artist ) ? esc_attr( $track_artist ) : '';  
 
    wp_nonce_field( 'bmplayer_track_save', 'bmplayer_track_nonce' );
    ?>
    <p>
        <label for="bmplayer_track_url"><?php _e('Track URL',$this->plugin_slug);?><br /><small><?php _e('If you want to stream online radio, you should put "/;" at the end of your stream URL after port number, eg: <strong>http://example.com:80/;</strong>',$this->plugin_slug);?></small></label><br />
        <input id="bmplayer_track_url" type="text" value="<?php echo $track_url; ?>" name="bmplayer_track_url" size="40" placeholder="<?php _e('http://example.com/tracks/new-track.mp3',$this->plugin_slug);?>" />
				<input id="upload_track_button" type="button" class="button" value="<?php _e( 'Upload Track',$this->plugin_slug ); ?>" />
    </p>	
		<div id="bmplayer-track-preview-wrapper" class="<?php echo $track_url?'bmplayer-visible':'bmplayer-hidden'?>">
			<ul class="graphic"><li><a id="bmplayer-track-preview" class="sm2_link" href="<?php echo $track_url;?>" type="audio/mpeg"><?php _e('Play',$this->plugin_slug);?></a></li></ul>		
		</div>
    <p>
        <label for="bmplayer_track_artist"><?php _e('Artist',$this->plugin_slug);?></label><br />
        <input id="bmplayer_track_artist" type="text" value="<?php echo $track_artist; ?>" name="bmplayer_track_artist" size="40" placeholder="<?php _e('Artist Name',$this->plugin_slug);?>" />
    </p>


    <?php
	}	
	
	/**
	 * Save track metabox data
	 *
	 * @since    1.0.0
	 */
	function main_taxonomy_save_post( $post_id ) {
		global $wpdb;
				
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
 
    if ( !isset($_POST['bmplayer_track_nonce']) || !wp_verify_nonce( $_POST['bmplayer_track_nonce'], 'bmplayer_track_save' ) )
        return;
 
    if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return;
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) )
            return;
    }
 
 
		// Handle post saving
    if ( ! wp_is_post_revision( $post_id ) && get_post_type( $post_id )==self::MAIN_TAXONOMY ) {
			remove_action( 'save_post', array($this, 'main_taxonomy_save_post') ); 	
			
				// Track title
				$track_title=$_POST['post_title']?$_POST['post_title']:__('Track',$this->plugin_slug).' '.$post_id;	
				// Menu Order
				$menu_order=$_POST['menu_order']?$_POST['menu_order']:$wpdb->get_var("SELECT MAX(`menu_order`)+1 AS `menu_order` FROM `".$wpdb->posts."` WHERE post_type='".self::MAIN_TAXONOMY."'");				
				
				wp_update_post( array(
					'ID' => $post_id,
					'post_title' =>$track_title,
					'menu_order'=>$menu_order
				) );	
				
				
				if(empty( $_POST['bmplayer_track_url'] )){
					// set a transient to show the users an admin message
					set_transient( 'bmplayer_track_message', 'track_url_error' );
					
					// update the post set it to draft
						wp_update_post( array(
							'ID' => $post_id,
							'post_status' => 'draft'				
						) );						
						add_filter('redirect_post_location',array($this,'hide_default_post_save_message'));
							
				}else{
					delete_transient( 'bmplayer_track_message' );
				}
			
			add_action( 'save_post', array($this,'main_taxonomy_save_post') );
		}
		
		if ( !empty( $_POST['bmplayer_track_url'] ) ) {
			$track_url=(isset($_POST['bmplayer_track_url']))?esc_attr($_POST['bmplayer_track_url']):'';
			update_post_meta( $post_id, 'bmplayer_track_url', $track_url );
		} else {
			delete_post_meta( $post_id, 'bmplayer_track_url' );
		}
		
		if ( !empty( $_POST['bmplayer_track_artist'] ) ) {
			$track_artist=(isset($_POST['bmplayer_track_artist']))?esc_attr($_POST['bmplayer_track_artist']):'';
			update_post_meta( $post_id, 'bmplayer_track_artist', $track_artist );
		} else {
			delete_post_meta( $post_id, 'bmplayer_track_artist' );
		}		
		
	}	
	
	/**
	 * Show admin notice 
	 *
	 * @since    1.0.0
	 */
	function main_taxonomy_notice() {
		if ( get_transient( 'bmplayer_track_message' ) == 'track_url_error' ) {
			?>
			<div class="error">
				<p><?php _e( 'Please enter Track URL',$this->plugin_slug); ?></p>
			</div>	
			<?php 
			delete_transient( 'bmplayer_track_message' );
		}
		?>
			<?php
	}	

	/**
	 * Hide default message function
	 *
	 * @since    1.0.0
	 */	
	function hide_default_post_save_message($loc) {
	 return add_query_arg( 'message', 999, $loc );
	}  	
	
	/**
	 * Change Post Title placeholder for plugin taxonomy
	 *
	 * @since    1.0.0
	 */
	public function backend_change_default_title( $title ){
			$screen = get_current_screen();
			if ( $screen->post_type==self::MAIN_TAXONOMY ){
					$title = 'Track Title';
			}
			return $title;
	}	

	/**
	 * Customize tracks list view (column titles)
	 *
	 * @since    1.0.0
	 */
	function bmplayer_track_edit_columns( $columns ) {
			$columns = array(
					'cb' => '<input type="checkbox" />',
					'title' => 'Title',
					'track-url' => 'Track',
					'track-artist' => 'Artist',
					'menu-order' => 'Sort Order'
			);
	 
			return $columns;
	}	
	
	/**
	 * Customize tracks list view (table content)
	 *
	 * @since    1.0.0
	 */
	function bmplayer_track_columns( $column, $post_id ) {
			$track_url = get_post_meta( $post_id, 'bmplayer_track_url', true );
			$track_artist = get_post_meta( $post_id, 'bmplayer_track_artist', true );
			$the_post = get_post($post_id );
			switch ( $column ) {						
					case 'track-url':
							if ( ! empty( $track_url ) ){?>
								<ul class="graphic"><li><a class="sm2_link" href="<?php echo $track_url;?>#id=<?php echo $post_id?>" type="audio/mpeg"><?php _e('Play',$this->plugin_slug);?></a></li></ul>
								<?php	
							}					
					break;
					case 'track-artist':
							if ( ! empty( $track_artist ) ){
								echo $track_artist;
							}					
					break;		
					case 'menu-order':
							echo (int)$the_post->menu_order;
					break;						
			}
	}
	
	/**
	 * Define sortable columns
	 *
	 * @since    1.0.0
	 */
	function bmplayer_track_sortable_columns( $columns ) {
		$columns = array(
				'menu-order' => 'menu-order',
				'title' => 'title'
		);
		return $columns;
	}
	
	/**
	 * Handle sortable columns
	 *
	 * @since    1.0.0
	 */
 	function bmplayer_track_orderby( $query ) {  
		if(!is_admin()){
			return;  
		}
		$post_type = $query->query['post_type'];

    if ( $post_type == self::MAIN_TAXONOMY) {
			$orderby = $query->get('orderby'); 

			if((!$orderby)||($orderby=='menu-order')){  
					$query->set('orderby','menu_order');  
					if(!$orderby){
						$query->set('order','ASC');  
					}
			}
		}  		
	}  		
	
	/**
	 * Init Player on FrontEnd
	 *
	 * @since    1.0.0
	 */
 	function bmplayer_init_frontend() {  
		$bmplayer_options=self::bmplayer_get_settings();
		if($bmplayer_options['bmplayer-include-method']=='auto'){
			echo $bmplayer_options['bmplayer-plugin-html'];
		}
	}  

	/**
	 * Init Player by Shortcode
	 *
	 * @since    1.0.0
	 */
 	function bmplayer_shortcode_init() {  
		$bmplayer_options=self::bmplayer_get_settings();
		if($bmplayer_options['bmplayer-include-method']=='manual'){
			return $bmplayer_options['bmplayer-plugin-html'];
		}
	} 	

}

//Register shortcode [bmplayer]
add_shortcode('bmplayer', array( 'Background_Music_Player_Lite','bmplayer_shortcode_init'));
