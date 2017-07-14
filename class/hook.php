<?php

class viewCountHooks {
    
    public function __construct() {
        // ... //
        register_activation_hook( VC_PATH.VC_PLUGIN_FILE, array($this, 'activate') );
        
        if(version_compare(get_option(VC_OPTION_NAME), '1.1.0') == '-1') {
            $this->upgradeTo110();
        }
        
    }
    
    private function update_version() {
        update_option(VC_OPTION_NAME, VC_VERSION);
    }
    
    public function activate() {

        global $wpdb;
        
        $table_name = $wpdb->prefix . VC_TABLENAME;
        
        $sql = "CREATE TABLE ". $table_name  ." (
              `nHistoryID` INT(11) NOT NULL AUTO_INCREMENT,
              `nUserID` INT(11) NOT NULL DEFAULT 0,
              `nPostID` INT(11) NOT NULL,
              `sPostType` VARCHAR(256) NOT NULL DEFAULT 'post',
              `sIPAddress` VARCHAR(28) NOT NULL,
              `sBrowserInfo` TEXT NULL,
              `sReferralURL` VARCHAR(512) NULL DEFAULT NULL,
              `dDateAdded` DATETIME NOT NULL,
              PRIMARY KEY (`nHistoryID`));";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        
        dbDelta($sql);
        
        $this->update_version();
        
    }
    
    
    public function upgradeTo110() {
        $this->update_version();
    }
    
}

new viewCountHooks();

