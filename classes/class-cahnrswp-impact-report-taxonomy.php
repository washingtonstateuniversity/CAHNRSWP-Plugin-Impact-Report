<?php

class CAHNRSWP_Impact_Report_Taxonomy {
	
	public function init(){
		
		add_action( 'init', array( $this, 'register_taxonomy' ), 10 );
		
	}
	
	public function register_taxonomy(){
	
		$programs = array(
			'labels'        => array(
				'name'          => 'Program',
				'singular_name' => 'Program',
				'search_items'  => 'Search Programs',
				'all_items'     => 'All Programs',
				'edit_item'     => 'Edit Program',
				'update_item'   => 'Update Program',
				'add_new_item'  => 'Add New Program',
				'new_item_name' => 'New Program Name',
				'menu_name'     => 'Programs',
			),
			'description'       => 'Impact Report Programs',
			'public'            => true,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_menu'      => true,
			'query_var'         => 'programs',
		);
		
		register_taxonomy( 'programs', 'impact', $programs );
	
	
	} // end register_taxonomy
	
} // end CAHNRSWP_Impact_Report_Taxonomy