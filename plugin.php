<?php
/*
Plugin Name: CAHNRSWP Impact Report Generator
Plugin URI: http://cahnrs.wsu.edu/communications
Description: Builds custom impact reports
Author: Danial Bleile
Version: 0.0.1
*/

class CAHNRSWP_Impact_Reports {
	
	public static $version = '0.0.1';
	
	protected static $instance = false;
	
	public static function get_instance(){
		
		if ( ! self::$instance ){
			
			self::$instance = new self;
			
			self::$instance->init();
			
		} // end if
		
		return self::$instance;
		
	} // end get instance
	
	
	protected function init(){
		
		require_once 'dbwp-library/dbwp-post.php';
		
		require_once 'classes/class-impact-report.php';
		$impact_report = new CAHNRSWP_Impact_Report();
		$impact_report->init();
		
		require_once 'classes/class-cahnrswp-impact-report-taxonomy.php';
		$programs = new CAHNRSWP_Impact_Report_Taxonomy();
		$programs->init();
		
		add_filter( 'template_include', array( $this, 'template_include' ), 1 );
		
		add_action( 'wp_ajax_nopriv_extension_impacts_request', array( $this, 'ajax_post_request' ) );
		
		add_action( 'wp_ajax_extension_impacts_request', array( $this, 'ajax_post_request' ) );
		
		add_filter( 'json_prepare_post', array( $this, 'json_prepare_post' ), 10, 3 );
		
	} // end init
	
	public function template_include( $template ){
		
		if ( is_post_type_archive( 'impact' ) ) {
			
			$template = plugin_dir_path( __FILE__ ) . 'index.php';
			
		} // end if
		
		return $template;
		
	}
	
	
	/**
	 * AJAX post requests.
	 */
	public function ajax_post_request() {

		$ajax_args = array(
			'post_type' => 'impact',
			'status'    => 'publish',
		);

		if ( $_POST['page'] ) {
			$ajax_args['paged'] = $_POST['page'];
			$ajax_args['posts_per_page'] = 12;
		}

		if ( $_POST['type'] ) {
			$ajax_args['tax_query'] = array(
				array(
					'taxonomy' => $_POST['type'],
					'field'    => 'slug',
					'terms'    => $_POST['term'],
				),
			);
			$ajax_args['posts_per_page'] = -1;
		}

		if ( $_POST['reset'] ) {
			$posts = (int) $_POST['reset'] * 12;
			$ajax_args['posts_per_page'] = $posts;
		}

		$posts = new WP_Query( $ajax_args );
    if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) : $posts->the_post();
				load_template( dirname( __FILE__ ) . '/post.php', false );
      endwhile;
		} else {
			echo 'Sorry, no Impact Reports match the criteria.';
		}

		exit;
	}

	
	
}

$cahnrswp_impact_reprots = CAHNRSWP_Impact_Reports::get_instance();