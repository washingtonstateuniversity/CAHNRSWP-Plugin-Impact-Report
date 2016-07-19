<div class="cahnrs-impact-report <?php echo $is_pdf;?>">
	<div class="cir-page cir-page-one">
    	<header class="cir-row">
        	<div class="cir-column cir-column-one">
            	<img class="cahnrswp-ir-extension-logo" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/extension-mark.jpg" />
            </div>
            <div class="cir-column cir-column-two">
            	<img class="cahnrswp-ir-primary-banner" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/blank.gif" style="background-image:url(<?php echo $this->get_meta_value('impact_report_img_pg1_banner');?>);" />
            </div>
        </header>
        <div class="cir-body cir-row">
        	<div class="cir-column cir-column-one">
            	<h1><?php echo $this->get_title();?></h1><?php if ( ! $is_pdf && $this->get_meta_value('_impact_report_pdfs') ):?><div class="cir-download"><a href="<?php echo $this->get_pdf_link( $this->get_meta_value('_impact_report_pdfs') );?>">Download as PDF</a></div><?php endif;?>
                <?php if ( $this->get_meta_value('_impact_report_subtitle') ):?><h2><?php echo $this->get_meta_value('_impact_report_subtitle');?></h2><?php endif;?>
                 <?php if ( $this->get_meta_value('_impact_report_numbers') ):?>
                    <section class="by-the-numbers">
                        <h4>By The Numbers</h4>
                        <?php echo  $this->get_meta_value('_impact_report_numbers') ;?>
                    </section>
                <?php endif;?>
            </div><div class="cir-column cir-column-two">
				<?php if ( $this->get_meta_value('_impact_report_headline') ):?>
                    <h2><?php echo $this->get_meta_value('_impact_report_headline');?></h2>
                <?php endif;?>
                <?php if ( $this->get_meta_value('_impact_report_issue') ):?>
                    <section class="issue">
                        <h4>Issue</h4>
                        <?php echo $this->get_meta_value('_impact_report_issue');?>
                    </section>
                <?php endif;?>
                <?php if ( $this->get_meta_value('_impact_report_response') ):?>
                    <section class="response">
                        <h4>Response</h4>
                        <?php echo $this->get_meta_value('_impact_report_response');?> 
                        <?php if ( ! $is_pdf ) echo $this->get_meta_value('_impact_report_response_continued');?>
                    </section>
                <?php endif;?>
            </div></div><footer class="cir-row">
        	<div class="cir-column cir-column-one">
            	<?php if ( $this->get_meta_value('impact_report_img_pg1_sidebar') ):?>
                	<div class="cir-sidebar-img"><img class="cahnrswp-ir-primary-banner" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/blank.gif" style="background-image:url(<?php echo $this->get_meta_value('impact_report_img_pg1_sidebar');?>);" /></div>
                <?php endif;?>
                <?php if ( $is_pdf ):?><a href="http://extension.wsu.edu/impact">extension.wsu.edu/impact/</a><?php endif;?>
            </div>
            <div class="cir-column cir-column-two">
            	<?php if ( $is_pdf ):?><?php echo $this->get_meta_value('_impact_report_footer_front');?><?php endif;?>
            </div>
        </footer>
    </div>
    <div class="cir-page cir-page-two">
    	<header class="cir-row">
        	<div class="cir-column cir-column-one">
            	<img class="cahnrswp-ir-primary-banner" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/blank.gif" style="background-image:url(<?php echo $this->get_meta_value('impact_report_img_pg2_sidebar');?>);" />
            </div>
            <div class="cir-column cir-column-two">
            	<img class="cahnrswp-ir-primary-banner" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/blank.gif" style="background-image:url(<?php echo $this->get_meta_value('impact_report_img_pg2_banner_1');?>);" /><img class="cahnrswp-ir-primary-banner" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/blank.gif" style="background-image:url(<?php echo $this->get_meta_value('impact_report_img_pg2_banner_2');?>);" />
            </div>
        </header>
        <div class="cir-body cir-row">
        	<div class="cir-column cir-column-one">
				<?php if ( $this->get_meta_value('_impact_report_quotes') ):?>
                    <section class="quotes">
                        <h4>Quotes</h4>
                        <?php echo wpautop( $this->get_meta_value('_impact_report_quotes') );?>
                    </section>
                <?php endif;?>
                <?php if ( $this->get_meta_value('_impact_report_additional') ):?>
                    <section class="quotes">
                        <?php if ( $this->get_meta_value('_impact_report_additional_title') ):?><h4><?php echo wpautop( $this->get_meta_value('_impact_report_additional_title') );?></h4><?php endif;?>
                        <?php echo wpautop( $this->get_meta_value('_impact_report_additional') );?>
                    </section>
                <?php endif;?>
            </div>
            <div class="cir-column cir-column-two">
            	<?php if ( $this->get_meta_value('_impact_report_impacts') ):?>
                    <section class="impacts">
                        <h4>Impacts</h4>
                        <?php echo wpautop( $this->get_meta_value('_impact_report_impacts') );?>
                    </section>
                <?php endif;?>
            </div></div>
        <footer class="cir-row">
        	<div class="cir-column cir-column-single">
            	<?php if ( $is_pdf ):?>
                	<?php if ( ! is_wp_error( $program ) && ! empty( $program ) ):?>
                        <img class="cahnrswp-ir-extension-logo" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/<?php echo $program[0];?>-wsu-logo.jpg" />
                    <?php else:?>
                        <img class="cahnrswp-ir-extension-logo" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/extension-wsu-logo.jpg" />
                    <?php endif;?>
                <?php else:?>
                	<?php echo $this->get_meta_value('_impact_report_footer_front');?>
                <?php endif;?>
            </div></footer>
    </div>
</div>