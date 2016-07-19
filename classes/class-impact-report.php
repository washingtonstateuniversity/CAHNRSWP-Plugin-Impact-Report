<?php

class CAHNRSWP_Impact_Report extends DBWP_Post {
	
	protected $slug = 'impact';
	
	protected $labels = array(
		'name'               => 'Impact Reports',
		'singular_name'      => 'Impact Report',
		'menu_name'          => 'Impact Report',
		'name_admin_bar'     => 'Impact Report',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Impact Report',
		'new_item'           => 'New Impact Report',
		'edit_item'          => 'Edit Impact Report',
		'view_item'          => 'View Impact Report',
		'all_items'          => 'All Impact Reports',
		'search_items'       => 'Search Impact Reports',
		'parent_item_colon'  => 'Parent Impact Reports:',
		'not_found'          => 'No impact reports found.',
		'not_found_in_trash' => 'No impact reports found in Trash.'
	);
	
	protected $post_type_args= array(
		//'labels'           => $labels, // set this later
        'description'        => 'Description.', 'your-plugin-textdomain',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'with_front' => false, 'slug' => 'impact-reports' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', )
	);
	
	protected $meta_fields = array(
		'_impact_report_numbers'            => array( 'default' => '' ),
		'_impact_report_issue'              => array( 'default' => '' ),
		'_impact_report_response'           => array( 'default' => '' ),
		'_impact_report_footer_front'       => array( 'default' => '' ),
		'_impact_report_response_continued' => array( 'default' => '' ),
		'_impact_report_impacts'            => array( 'default' => '' ),
		'_impact_report_quotes'             => array( 'default' => '' ),
		'_impact_report_additional'         => array( 'default' => '' ),
		'impact_report_img_pg1_sidebar'    => array( 'default' => '' ),
		'impact_report_img_pg1_banner'     => array( 'default' => '' ),
		'impact_report_img_pg2_sidebar'    => array( 'default' => '' ),
		'impact_report_img_pg2_banner_1'   => array( 'default' => '' ),
		'impact_report_img_pg2_banner_2'   => array( 'default' => '' ),
		'_impact_report_headline'           => array( 'default' => '' ),
		'_impact_report_subtitle'           => array( 'default' => '' ),
		'_impact_report_additional_title'   => array( 'default' => '' ),
		'_impact_report_pdfs'               => array( 'default' => array() ),
	);
	
	protected $taxonomies = array('cahnrs_unit' , 'topic' , 'wsuwp_university_location' );
	
	
	public function get_pdf_filter_content( $content , $post ){
			
		$this->set_by_wp_post( $post );
			
		$program = wp_get_post_terms( $post->ID, 'programs', array( 'fields' => 'slugs' ) ); 
			
		ob_start();
			
		include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/impact-report-pdf.php';
			
		$content = ob_get_clean();
		
		return $content; 
		
	} // end the_content
	
	
	public function wp_enqueue_scripts(){ 
		
		wp_enqueue_style( $this->get_slug() . '_public_cs' , plugin_dir_url( dirname( __FILE__ ) ) . 'css/public.css' , array(), CAHNRSWP_Impact_Reports::$version ) ;
		
		if ( is_post_type_archive( 'impact' ) ) {
			wp_enqueue_style( 'impact-report-archive', plugins_url( 'css/impact-report-archive.css', dirname(__FILE__) ), array( 'spine-theme' ) );
			wp_enqueue_script( 'impact-report-archive', plugins_url( 'js/impact-report-archive.js', dirname(__FILE__) ), array( 'jquery' ), '', true );
			wp_localize_script( 'impact-report-archive', 'impacts', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		}
		
	}
	
	
	public function admin_enqueue_scripts(){
		
		wp_enqueue_style( $this->get_slug() . '_admin_cs' , plugin_dir_url( dirname( __FILE__ ) ) . 'css/admin.css' , array(), CAHNRSWP_Impact_Reports::$version ) ;
		
		wp_enqueue_script( $this->get_slug() . '_admin_js' , plugin_dir_url( dirname( __FILE__ ) ) . 'js/admin.js' , array(), CAHNRSWP_Impact_Reports::$version , true ) ;
		
	} // end admin_enqueue_scripts
	
	
	public function edit_form_after_title( $post ){
		
		$this->set_by_wp_post( $post );
		
		$pdf_versions = '';
		
		foreach(  $this->get_meta_value('_impact_report_pdfs') as $year => $link ){
			
			$pdf_versions .= '<input type="text" name="_impact_report_pdfs[' . $year . ']" value="' . $link . '" />';
			
		} // end foreach
		
		var_dump( $this->get_pdf_link( $this->get_meta_value('_impact_report_pdfs') ) );
		
		$pages = $this->get_edit_form_page_one();
		
		$pages .= $this->get_edit_form_page_two();
		
		include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/cahnrs-impact-editor.php';
		
	} // end edit_form_after_title
	
	
	public function get_edit_form_page_one(){
		
		$title = $this->get_title();
		
		$banner_bg = '';
		
		$banner_img = $this->get_meta_value( 'impact_report_img_pg1_banner' );
		if ( $banner_img ) $banner_img = 'background-image: url(' . $banner_img . ')';
		
		$sidebar_img = $this->get_meta_value( 'impact_report_img_pg1_sidebar' );
		if ( $sidebar_img  ) $sidebar_img  = 'background-image: url(' . $sidebar_img  . ')';
		
		$numbers = $this->get_meta_value( '_impact_report_numbers' );
		
		$issue = $this->get_meta_value( '_impact_report_issue' );
		
		$response = $this->get_meta_value( '_impact_report_response' );
		
		$footer = $this->get_meta_value( '_impact_report_footer_front' );
		
		ob_start();
		
		include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/cahrns-impact-editor-page-one.php';
		
		return ob_get_clean();
		
	} // end get_edit_form_page_one
	
	
	public function get_edit_form_page_two(){
		
		ob_start();
		
		include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/cahrns-impact-editor-page-two.php';
		
		return ob_get_clean();
		
	} // end get_edit_form_page_two
	
	
	public function get_edit_image_button( $field ){
		
		$html = '<a href="#" class="cahnrs-ir-edit-image">Edit</a><input type="hidden" name="' . $field . '" value="' . $this->get_meta_value( $field ) .'" />';
		
		return $html;
		
	} // end get_edit_image_button
	
	
	public function get_bg_image( $field ){
		
		$img = $this->get_meta_value( $field );
		
		if ( $img ){
			
			return 'background-image:url(' . $img . ')';
			
		} else {
			
			return '';
			
		} // end if
		
		
	} // end get_bg_image
	
	public function get_pdf_link( $pdf_array ){
		
		$most_recent = max( array_keys( $pdf_array ) );
		
		return $pdf_array[ $most_recent ];
		
	} // end $pdf_array
	
	
	public function get_save_content( $content ){
		
		$this->set_by_form_post();
		
		ob_start();
		
		include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/cahnrs-impact-report-public.php';
		
		return ob_get_clean();
		
		
	} // end get_save_content
	
	

	public function clean_meta( $meta ){
		
		$clean = array();
		
		$wp_editors = array(
			'_impact_report_numbers',
			'_impact_report_issue',
			'_impact_report_response',
			'_impact_report_footer_front',
			'_impact_report_response_continued',
			'_impact_report_impacts',
			'_impact_report_quotes',
			'_impact_report_additional',
		);
		
		foreach( $wp_editors as $wp_editor ){
			
			if ( isset( $meta[ $wp_editor ] ) ) {
				
				$clean[ $wp_editor ] = wp_kses_post( $meta[ $wp_editor ] );
				
			} // end if
			
		} // end foreach
		
		$txt_fields = array( 
			'impact_report_img_pg1_sidebar', 
			'impact_report_img_pg1_banner',
			'impact_report_img_pg2_sidebar',
			'impact_report_img_pg2_banner_1',
			'impact_report_img_pg2_banner_2',
			'_impact_report_headline',
			'_impact_report_subtitle',
			'_impact_report_additional_title'
		);
		
		foreach( $txt_fields as $txt_key ){
			
			if ( isset( $meta[ $txt_key ] ) ) {
				
				$clean[ $txt_key ] = sanitize_text_field( $meta[ $txt_key ] );
				
			} // end if
			
		} // end foreach*/
		
		if ( ! empty( $meta[ '_impact_report_pdfs' ] ) ){
			
			$clean[ '_impact_report_pdfs' ] = array();
			
			foreach( $meta[ '_impact_report_pdfs' ] as $year => $link ){
				
				$clean[ '_impact_report_pdfs' ][ $year ] = sanitize_text_field( $link );
				
			} // end foreach
			
		} // end if
		
		$clean = $meta;
		
		//var_dump( $clean );  
		
		return $clean;
		
	} // end clean_meta
	
}