<?php

class pageViewMenu {
    public function __construct() {
        add_action( 'admin_menu', array($this, 'page_view_menu') );
    }
    
    function page_view_menu() {
        
        global $pageView;
        
        add_menu_page( 'User View Counts', 'Page Views', 'manage_options', 'page-views', array($pageView, 'loadPageViewData'));
    }
}

new pageViewMenu();