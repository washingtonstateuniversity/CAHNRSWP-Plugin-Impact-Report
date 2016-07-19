<div id="cahnrswp-ir-page-one" class="cahnrswp-ir-page">
	<div class="cahnrswp-ir-inner-page">
        <header class="cahnrswp-ir-row">
            <div class="cahnrswp-ir-sidebar cahnrswp-ir-column">
                <img class="cahnrswp-ir-extension-logo" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/extension-mark.jpg" />
            </div>
            <div class="cahnrswp-ir-primary-content cahnrswp-ir-column">
            	<div class="cahnrswp-ir-primary-banner cahnrswp-ir-image" style="<?php echo $this->get_bg_image('impact_report_img_pg1_banner');?>">
                	<?php echo $this->get_edit_image_button( 'impact_report_img_pg1_banner' );?>
                </div>
            </div>
        </header>
        <div class="cahnrswp-ir-body cahnrswp-ir-row">
            <div class="cahnrswp-ir-sidebar cahnrswp-ir-column">
            	<h1><?php echo $title;?></h1>
                <div class="cahnrswp-ir-field text-field">
                	<input type="text" name="_impact_report_subtitle" value="<?php echo $this->get_meta_value( '_impact_report_subtitle');?>" placeholder="Subtitle (optional)"/>
                </div>
                <h4>By the Numbers</h4>
                <?php wp_editor( $numbers , '_impact_report_numbers');?>
                <div class="cahnrswp-ir-image"  style="<?php echo $this->get_bg_image('impact_report_img_pg1_sidebar');?>">
                	<?php echo $this->get_edit_image_button( 'impact_report_img_pg1_sidebar' );?>
                </div>
            </div>
            <div class="cahnrswp-ir-primary-content cahnrswp-ir-column">
            	<div class="cahnrswp-ir-field text-field">
                	<input type="text" name="_impact_report_headline" value="<?php echo $this->get_meta_value( '_impact_report_headline');?>" placeholder="Headline (optional)"/>
                </div>
            	<h4>Issue</h4>
                <?php wp_editor( $issue , '_impact_report_issue'  );?>
                <h4>Response</h4>
                <?php wp_editor( $response , '_impact_report_response'  );?>
            </div>
        </div>
        <footer class="cahnrswp-ir-row">
            <div class="cahnrswp-ir-sidebar cahnrswp-ir-column">
            </div>
            <div class="cahnrswp-ir-primary-content cahnrswp-ir-column">
            	<h4>Footer Text</h4>
                <?php wp_editor( $footer , '_impact_report_footer_front' , array( 'editor_height' => 150 ) );?>
            </div>
        </footer>
    </div>
</div>