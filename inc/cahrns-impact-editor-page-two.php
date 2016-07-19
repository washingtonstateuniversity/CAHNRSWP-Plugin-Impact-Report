<div class="cahnrswp-ir-page-split">Section 2</div>
<div id="cahnrswp-ir-page-two" class="cahnrswp-ir-page">
	<div class="cahnrswp-ir-inner-page">
        <header class="cahnrswp-ir-row">
            <div class="cahnrswp-ir-sidebar cahnrswp-ir-column column-one">
                <div class="cahnrswp-ir-image"  style="<?php echo $this->get_bg_image('impact_report_img_pg2_sidebar');?>">
                	<?php echo $this->get_edit_image_button( 'impact_report_img_pg2_sidebar' );?>
                </div>
            </div>
            <div class="cahnrswp-ir-primary-content cahnrswp-ir-column column-two" >
            	<div class="cahnrswp-ir-image two-set" style="<?php echo $this->get_bg_image('impact_report_img_pg2_banner_1');?>">
                	<?php echo $this->get_edit_image_button( 'impact_report_img_pg2_banner_1' );?>
                </div>
                <div class="cahnrswp-ir-image two-set"  style="<?php echo $this->get_bg_image('impact_report_img_pg2_banner_2');?>">
                	<?php echo $this->get_edit_image_button( 'impact_report_img_pg2_banner_2' );?>
                </div>
            </div>
        </header>
        <div class="cahnrswp-ir-body cahnrswp-ir-row">
            <div class="cahnrswp-ir-sidebar cahnrswp-ir-column">
                <h4>Quotes</h4>
                <?php wp_editor( $this->get_meta_value( '_impact_report_quotes' ) , '_impact_report_quotes');?>
                <h4>Additional (Optional):</h4>
                <div class="cahnrswp-ir-field text-field">
                	<input type="text" name="_impact_report_additional_title" value="<?php echo $this->get_meta_value( '_impact_report_additional_title');?>" placeholder="Additional Title (optional)"/>
                </div>
                <?php wp_editor( $this->get_meta_value( '_impact_report_additional' ) , '_impact_report_additional'  , array( 'editor_height' => 250 ));?>
            </div>
            <div class="cahnrswp-ir-primary-content cahnrswp-ir-column">
            	<h4>Response Continued (Optional)</h4>
                <?php wp_editor( $this->get_meta_value( '_impact_report_response_continued' ) , '_impact_report_response_continued' , array( 'editor_height' => 250 ));?>
                <h4>Impacts</h4>
                <?php wp_editor( $this->get_meta_value( '_impact_report_impacts' ) , '_impact_report_impacts' );?>
            </div>
        </div>
	</div>
</div>