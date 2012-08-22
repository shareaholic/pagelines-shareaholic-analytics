<?php
/*
  Section: Shareaholic Publisher Analytics
  Author: Shareaholic
  Author URI: http://shareaholic.com
  Version: 1.0.1
  Description: Get free access to Shareaholic’s simple-to-use publisher analytics dashboard, which shows you your top traffic sources, most influential readers and helps you track your progress on traffic growth.  Shareaholic is trusted by hundreds of thousands of websites and touches over 300 million people each month.
  Class Name: ShrAnalyticsSection
  Cloning: false
  Demo: http://www.shareaholic.com/publishers/analytics
  Workswith: main
 */

/*
 * PageLines Headers API
 * 
 *  Sections support standard WP file headers (http://codex.wordpress.org/File_Header) with these additions:
 *  -----------------------------------
 * 	 - Section: The name of your section.
 * 	 - Class Name: Name of the section class goes here, has to match the class extending PageLinesSection.
 * 	 - Cloning: (bool) Enable cloning features.
 * 	 - Depends: If your section needs another section loaded first set its classname here.
 * 	 - Workswith: Comma seperated list of template areas the section is allowed in.
 * 	 - Failswith: Comma seperated list of template areas the section is NOT allowed in.
 * 	 - Demo: Use this to point to a demo for this product.
 * 	 - External: Use this to point to an external overview of the product
 * 	 - Long: Add a full description, used on the actual store page on http://www.pagelines.com/store/
 *
 */

/**
 *
 * Section Class Setup
 * 
 * Name your section class whatever you want, just make sure it matches the 
 * "Class Name" in the section meta (above)
 * 
 * File Naming Conventions
 * -------------------------------------
 *  section.php 		  - The primary php loader for the section.
 *  style.css 			  - Basic CSS styles contains all structural information, no color (autoloaded)
 *  images/				    - Image folder. 
 *  thumb.png			    - Primary branding graphic (300px by 225px - autoloaded)
 *  screenshot.png		- Primary Screenshot (300px by 225px)
 *  screenshot-1.png 	- Additional screenshots: (screenshot-1.png -2 -3 etc...optional).
 *  icon.png			    - Portable icon format (16px by 16px)
 * 	color.less			  - Computed color control file (autoloaded)
 *
 */
class ShrAnalyticsSection extends PageLinesSection {

  function section_styles() {
    if ((isset($_GET['sb_debug']) || isset($_POST['sb_debug']))) {
      $script = 'http://www.spreadaholic.com/media/js/jquery.shareaholic-publishers-rd.js';
    }
    else
      $script = 'https://dtym7iokkjlif.cloudfront.net/dough/1.0/recipe.js';
    
    wp_enqueue_script('shareaholic-analytics-js', $script);
  }

  function section_head() {
  }

  function section_template() {
  }

  function section_optionator($settings) {
    
    $settings = wp_parse_args($settings, $this->optionator_default);
    $options = array(
      'shr-recomm-terms'  => array(
            'type'        => 'text_content',
            'inputlabel'  => 'By activating Shareaholic you agree to our <a href="http://www.shareaholic.com/terms/" target="_blank">Terms of Service</a> and <a href="http://www.shareaholic.com/privacy/" target="_blank">Privacy Policy</a>.',
            'title'       => 'See your analytics dashboard by filling in your website under "live report" on <a href="http://www.shareaholic.com/publishers/analytics/?utm_source=Pagelines" target="_blank">Shareaholic.com</a>.',
            'shortexp'    => '',
            'exp'         => '',
        )
    );
    $tab_settings = array(
        'id'        => 'shr-analytics-options',
        'name'      => 'Shareaholic Publisher Analytics Settings',
        'icon'      => $this->icon,
        'clone_id'  => $settings['clone_id'],
        'active'    => $settings['active']
    );
    register_metatab($tab_settings, $options, $this->class_name);
  }
}