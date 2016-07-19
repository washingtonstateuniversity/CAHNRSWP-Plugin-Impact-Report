<?php
/*
 * Class for post_type
 * @author Danial Bleile
 * @version 0.0.1
 */

class DBWP_Post {
	
	protected $plugin_path;
	
	protected $plugin_url;
	
	protected $slug = false;
	
	protected $labels = false;
	
	protected $post_type_args = false;
	
	protected $title;
	
	protected $id;
	
	protected $link;
	
	protected $wp_post;
	
	protected $content;
	
	protected $excerpt;
	
	protected $meta_fields = array();
	
	protected $meta = array();
	
	protected $taxonomies = array();
	
	/************************/
	
	public function get_plugin_path() { return $this->plugin_path; }
	
	public function get_plugin_url() { return $this->plugin_url; }
	
	public function get_slug(){ return $this->slug; }
	
	public function get_labels(){ return $this->labels; }
	
	public function get_post_type_args(){ return $this->post_type_args; }
	
	public function set_title( $title ){ $this->title = $title; }
	public function get_title(){ return $this->title; }
	
	public function set_id( $id ){ $this->id = $id; }
	public function get_id(){ return $this->id; }
	
	public function set_link( $link ){ $this->link = $link; }
	public function get_link(){ return $this->link; }
	
	public function set_content( $content ){ $this->content = $content; }
	public function get_content(){ return $this->content; }
	
	public function set_excerpt( $excerpt ){ $this->excerpt = $excerpt; }
	public function get_excerpt(){ return $this->excerpt; }
	
	public function set_wp_post( $wp_post ){ $this->wp_post = $wp_post; }
	public function get_wp_post(){ return $this->wp_post; }
	
	public function set_meta_fields( $meta_fields ){ $this->meta_fields = $meta_fields; }
	public function get_meta_fields(){ return $this->meta_fields; }
	
	public function set_meta( $meta ){ $this->meta = $meta; }
	public function get_meta(){ return $this->meta; }
	
	public function set_taxonomies( $taxonomies ){ $this->taxonomies = $taxonomies; }
	public function get_taxonomies(){ return $this->taxonomies; }
	
	
	public function __construct( $plugin_path = false , $plugin_url = false  ){
		
		if ( $plugin_path ){
			
			$this->plugin_path = $plugin_path;
			
		} else {
			
			$this->plugin_path = plugin_dir_path( dirname( __FILE__ ) );
			
		} // end if
		
		if ( $plugin_url ){
			
			$this->plugin_url = $plugin_url;
			
		} else {
			
			$this->plugin_url = plugin_dir_url( dirname( __FILE__ ) );
			
		} // end if
		
	} // end if
	
	
	public function init(){
		
		if ( $this->get_post_type_args() ){
			
			add_action( 'init' , array( $this , 'register_type' ) );
			
		} // end if
		
		if ( method_exists( $this , 'edit_form_after_title' ) ){
			
			add_action( 'edit_form_after_title' , array( $this , 'get_edit_form' ) );
			
		} // end if
		
		if ( method_exists( $this , 'wp_enqueue_scripts' ) ) {
			
			add_action( 'wp_enqueue_scripts' , array( $this , 'wp_enqueue_scripts' ) );
			
		} // end if
		
		if ( method_exists( $this , 'admin_enqueue_scripts' ) ) {
			
			add_action( 'admin_enqueue_scripts' , array( $this , 'admin_enqueue_scripts' ) );
			
		} // end if
		
		if ( $this->get_meta_fields() ) {
			
			add_action( 'save_post_' . $this->get_slug() , array( $this , 'save' ) );
			
		} // end if
		
		if ( method_exists( $this , 'the_content_single' ) ){
			
			add_filter( 'the_content' , array( $this , 'get_the_content_single'), 99 );
			
		} // end if
		
		if ( isset( $_POST['post_type'] ) && ( $this->get_slug() == $_POST['post_type'] ) && method_exists( $this , 'get_save_content' ) ){
			
			add_filter( 'content_save_pre' , array( $this , 'get_filter_save_content' ) , 99 );
			
		} // end if
		
		if ( method_exists( $this , 'get_pdf_filter_content' ) ){
			
			add_filter( 'cahnrswp_pdf' , array( $this , 'get_pdf_filter_content' ) , 99 , 2 );
			
		} // end if
		
		if ( $this->get_taxonomies() ){
			
			add_action( 'init' , array( $this , 'add_post_type_taxonomies' ) , 99 );
			
		} // end if
		
	} // end init
	
	/************************/
	
	public function get_meta_value( $key ){
		
		$meta = $this->get_meta();
			
		if ( array_key_exists( $key , $meta ) ){
			
			return $meta[ $key ];
			
		} else {
			
			return '';
			
		} // end if
		
	} // end get_meta
	
	public function get_edit_form( $post ){
		
		if ( $post->post_type == $this->get_slug() ){
			
			$this->edit_form_after_title( $post );
			
		} // end if
		
	} // end get_edit_form
	
	
	public function get_the_content_single( $content ){
		
		if ( is_singular( $this->get_slug() ) ){
			
			$content = $this->the_content_single( $content );
			
		} // end if
		
		return $content;
		
	} // end $content
	
	
	public function get_filter_save_content( $content ){
		
		if ( is_admin() ){
			
			// If this is an autosave, our form has not been submitted, so we don't want to do anything.
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	
				return $content;
	
			} // end if
			
			$content = $this->get_save_content( $content );
			
		} // end if
		
		return $content;
		
	} // end get_filter_save_content
	
	/************************/
	
	public function set_by_wp_post( $post ){
		
		$this->set_title( $post->post_title );
		
		$this->set_id( $post->ID );
		
		$this->set_link( get_permalink( $post->ID ) );
		
		$this->set_content( $post->post_content );
		
		$this->set_excerpt( $post->post_excerpt );
		
		$this->set_wp_post( $post );
		
		if ( $this->get_meta_fields() ){
			
			$this->set_meta_by_post_id( $post->ID );
			
		} // end if
		
	} // end set_by_wp_post
	
	
	public function set_meta_by_post_id( $post_id ){
		
		$fields = $this->get_meta_fields();
		
		$meta = array();
		
		foreach( $fields as $key => $info ){
			
			$meta_value = get_post_meta( $post_id , $key , true );
			
			if ( ! $meta_value ){
				
				$meta_value = $info['default'];
				
			} // end if
			
			$meta[ $key ] = $meta_value;
			
		} // end foreach
		
		$this->set_meta( $meta );
		
	} // end set_meta_by_post_id
	
	
	public function set_by_form_post(){
		
		$this->set_title( sanitize_text_field( $_POST['post_title'] ) );
		
		$this->set_meta_by_post();
		
	} // end set_meta_by_save
	
	
	public function set_meta_by_post(){
		
		$meta = array();
		
		$fields = $this->get_meta_fields();
		
		foreach( $fields as $key => $info ){
			
			if ( isset( $_POST[ $key ] ) && $_POST[ $key ] ){
				
				$meta[ $key ] = $_POST[ $key ];
				
			} // end if			
			
		} // end foreach
		
		if ( method_exists( $this , 'clean_meta' ) ){
			
			$clean_meta = $this->clean_meta( $meta );
			
		} else {
			
			$clean_meta = array();
			
		} // end if
		
		$this->set_meta( $clean_meta );
		
	} // end set_meta_by_save
	
	
	public function set_by_id( $post_id ){
		
		$post = get_post( $post_id );
		
		$this->set_by_wp_post( $post );
		
	} // end set_by_id
	
	
	/************************/
	
	
	public function register_type(){
		
		$post_type = $this->get_slug();
		
		$args = $this->get_post_type_args();
		
		$labels = $this->get_labels();
		
		if ( is_array( $labels ) ){
			
			$args['labels'] = $labels;
			
		} else {
			
			$args['label'] = $labels;
			
		} // end if
		
		register_post_type( $post_type, $args );
		
	} // end register
	
	
	public function save( $post_id ){
		
		if ( ! $this->check_can_save( $post_id ) ) return;
		
		$this->set_meta_by_post();
		
		$meta = $this->get_meta();
		
		foreach( $meta as $key => $value ){
			
			update_post_meta( $post_id , $key , $value );
			
		} // end foreach
		
	} // end save
	
	
	private function check_can_save( $post_id ){
		
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

			return false;

		} // end if

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {

				return false;

			} // end if

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {

				return false;

			} // end if

		} // end if
		
		return true;
		
	} // end check_can_save
	
	
	public function add_post_type_taxonomies(){
		
		foreach( $this->get_taxonomies() as $taxonomy ){
		
			register_taxonomy_for_object_type( $taxonomy, $this->get_slug() );
		
		}// end if
		
	}
	
	
	
}
