<?php
function like_install() {
    global $wpdb;
    $structure = "CREATE TABLE lk (
    lk_id int(2) NOT NULL AUTO_INCREMENT,
    lk_text varchar(32) NOT NULL,
    lktime int(3) NOT NULL,
    UNIQUE KEY lk_id (lk_id))";

    exit($wpdb->query($structure));
    //$wpdb->query("INSERT INTO screen_saver(ss_text, ss_bg_color, ss_text_color, ss_time) VALUES('Screen Saver', 'Black', 'White', '15')");
}

function like_uninstall() {
    global $wpdb;
    $structure = "drop table if exists lk";
    $wpdb->query($structure);
}

global $wpdb;
register_activation_hook(__FILE__, 'like_install');
register_deactivation_hook(__FILE__, 'like_uninstall');
