<div class="page" id="page-one">
    <header class="row header">
        <div class="column column-one">
        	<img class="cahnrswp-ir-extension-logo" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/extension-mark.jpg" />
        </div>
        <div class="column column-two">
        	<div class="cahnrswp-ir-primary-banner" style="background-image:url(<?php echo $this->get_meta_value('impact_report_img_pg1_banner');?>);">
            </div>
        </div>
    </header>
    <div class="row content-row">
        <div class="column column-one">
        	<h1><?php echo $this->get_title();?></h1>
            <?php if ( $this->get_meta_value('_impact_report_subtitle') ):?><h2><?php echo $this->get_meta_value('_impact_report_subtitle');?></h2><?php endif;?>
            <?php if ( $this->get_meta_value('_impact_report_numbers') ):?>
                <section class="by-the-numbers">
                    <h4>By The Numbers</h4>
                    <?php echo wpautop( $this->get_meta_value('_impact_report_numbers') );?>
                </section>
            <?php endif;?>
        </div>
        <div class="column column-two">
        	<?php if ( $this->get_meta_value('_impact_report_headline') ):?>
				<h2><?php echo $this->get_meta_value('_impact_report_headline');?></h2>
            <?php endif;?>
        	<?php if ( $this->get_meta_value('_impact_report_issue') ):?>
                <section class="issue">
                    <h4>Issue</h4>
                    <?php echo wpautop( $this->get_meta_value('_impact_report_issue') );?>
                </section>
            <?php endif;?>
            <?php if ( $this->get_meta_value('_impact_report_response') ):?>
                <section class="response">
                    <h4>Response</h4>
                    <?php echo wpautop( $this->get_meta_value('_impact_report_response') );?>
                </section>
            <?php endif;?>
        </div></div>
    <footer class="row">
    	<div class="column column-one">
        	<?php if ( $this->get_meta_value('impact_report_img_pg1_sidebar') ):?>
        	<div class="cahnrswp-ir-img cahnrswp-ir-banner-sidebar">
            	<img src="<?php echo $this->get_meta_value('impact_report_img_pg1_sidebar');?>" />
            </div>
            <?php endif;?>
        	<a href="http://extension.wsu.edu/impact">extension.wsu.edu/impact/</a>
        </div>
        <div class="column column-two content-column">
        	<section class="footer-front">
                <?php echo wpautop( $this->get_meta_value('_impact_report_footer_front') );?>
            </section>
        </div></footer>
</div>
<div class="page" id="page-two">
	<header class="row header">
        <div class="column column-one">
        	<div class="cahnrswp-ir-img cahnrswp-ir-banner-sidebar" style="background-image:url(<?php echo $this->get_meta_value('impact_report_img_pg2_sidebar');?>);"></div>
        </div>
        <div class="column column-two">
        	<div class="cahnrswp-ir-img cahnrswp-ir-banner-sidebar" style="background-image:url(<?php echo $this->get_meta_value('impact_report_img_pg2_banner_1');?>);">
            </div><div class="cahnrswp-ir-img cahnrswp-ir-banner-sidebar" style="background-image:url(<?php echo $this->get_meta_value('impact_report_img_pg2_banner_2');?>);">
            </div>
        </div>
    </header>
    <div class="row content-row">
        <div class="column column-one">
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
        <div class="column column-two">
        	<?php if ( $this->get_meta_value('_impact_report_response_continued') ):?>
                <section class="response">
                    <?php echo wpautop( $this->get_meta_value('_impact_report_response_continued') );?>
                </section>
            <?php endif;?>
             <?php if ( $this->get_meta_value('_impact_report_impacts') ):?>
                <section class="impacts">
                    <h4>Impacts</h4>
                    <?php echo wpautop( $this->get_meta_value('_impact_report_impacts') );?>
                </section>
            <?php endif;?>
        </div>
    </div>
    <footer class="row">
        <div class="column column-single">
        	<section class="footer-back">
            	<?php if ( ! is_wp_error( $program ) && ! empty( $program ) ):?>
                	<?php var_dump( $program );?>
                	<img class="cahnrswp-ir-extension-logo" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/<?php echo $program[0];?>-wsu-logo.jpg" />
                <?php else:?>
                	<img class="cahnrswp-ir-extension-logo" src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>/images/extension-wsu-logo.jpg" />
                <?php endif;?>
            </section>
        </div>
    </footer>
</div>