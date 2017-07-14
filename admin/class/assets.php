<?php

class adminAssets {

    private $jsHandler = 'page-view-data';
    
    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'addJS'));
        add_action('admin_head', array($this, 'addCSS'));
    }
    
    public function addJS () {
        wp_register_script('view-count-date-range', VC_URL.'/admin/assets/js/date-range.js', array('jquery-ui-datepicker'));
        wp_register_script($this->jsHandler, VC_URL.'/admin/assets/js/page-view.js', array('view-count-date-range'));
    }
    
    public function addCSS () {
        echo '<link rel="stylesheet" href="'.VC_URL.'/admin/assets/css/date-range.css" type="text/css" media="all" />';
        echo '<link rel="stylesheet" href="'.VC_URL.'/admin/assets/css/jquery-ui.css" type="text/css" media="all" />';
        echo '<link rel="stylesheet" href="'.VC_URL.'/admin/assets/css/style.css" type="text/css" media="all" />';
    }
    
    public function enqueueAssets () {
        
        wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_enqueue_script( 'view-count-date-range' );
              
        wp_enqueue_script( $this->jsHandler );
        wp_localize_script( $this->jsHandler, 'pageViewData', array('ajaxurl'=>admin_url( 'admin-ajax.php' )));
    }
}

$adminAssets = new adminAssets();