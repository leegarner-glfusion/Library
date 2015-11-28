<?php
/**
*   Configuration defaults for the Library plugin for glFusion.
*
*   @author     Lee Garner <lee@leegarner.com>
*   @copyright  Copyright (c) 2009 Lee Garner <lee@leegarner.com>
*   @package    library
*   @version    0.0.1
*   @license    http://opensource.org/licenses/gpl-2.0.php 
*               GNU Public License v2 or later
*   @filesource
*/


// This file can't be used on its own
if (!defined ('GVERSION')) {
    die ('This file can not be used on its own.');
}

/** Paypal plugin configuration defaults
*   @global array */
global $_LIB_DEFAULTS;
$_LIB_DEFAULTS = array();

// Show on the plugin menu?
$_LIB_DEFAULTS['menuitem'] = 1;

// Days to keep an item on hold if it's on a waiting list
$_LIB_DEFAULTS['daysonhold'] = 3;

// Items shown per page when browsing the library
$_LIB_DEFAULTS['items_per_page'] = 10;

// Image-related values
$_LIB_DEFAULTS['max_images'] = 3;
$_LIB_DEFAULTS['image_dir'] = $_CONF['path'] . 'data/library/images/items';
$_LIB_DEFAULTS['max_thumb_size'] = 100;
$_LIB_DEFAULTS['img_max_width'] = 800;
$_LIB_DEFAULTS['img_max_height'] = 600;
$_LIB_DEFAULTS['max_image_size'] = 4194304;

// Comments supported?
$_LIB_DEFAULTS['ena_comments'] = 1;

// Enable ratings?
$_LIB_DEFAULTS['ena_ratings'] = 1;

// Which blocks to show with the library- default both
$_LIB_DEFAULTS['displayblocks'] = 3;

// Default maximum number of days an item can be checked out.
$_LIB_DEFAULTS['maxcheckout'] = 21;

$_LIB_DEFAULTS['notify_checkout'] = 1;

/**
*  Initialize Paypal plugin configuration
*
*  Creates the database entries for the configuation if they don't already
*  exist. Initial values will be taken from $_CONF_LIB if available (e.g. from
*  an old config.php), uses $_LIB_DEFAULTS otherwise.
*
*  @param  integer $group_id   Group ID to use as the plugin's admin group
*  @return boolean             true: success; false: an error occurred
*/
function plugin_initconfig_library($group_id = 0)
{
    global $_CONF, $_CONF_LIB, $_LIB_DEFAULTS;

    if (is_array($_CONF_LIB) && (count($_CONF_LIB) > 1)) {
        $_LIB_DEFAULTS = array_merge($_LIB_DEFAULTS, $_CONF_LIB);
    }

    // Use configured default if a valid group ID wasn't presented
    if ($group_id == 0)
        $group_id = $_LIB_DEFAULTS['defgrp'];

    $c = config::get_instance();

    if (!$c->group_exists($_CONF_LIB['pi_name'])) {

        $c->add('sg_main', NULL, 'subgroup', 0, 0, NULL, 0, true, 
                $_CONF_LIB['pi_name']);
        $c->add('fs_main', NULL, 'fieldset', 0, 0, NULL, 0, true, 
                $_CONF_LIB['pi_name']);

        $c->add('menuitem', $_LIB_DEFAULTS['menuitem'],
                'select', 0, 0, 2, 10, true, $_CONF_LIB['pi_name']);
        $c->add('daysonhold', $_LIB_DEFAULTS['daysonhold'],
                'text', 0, 0, 0, 20, true, $_CONF_LIB['pi_name']);
        $c->add('items_per_page', $_LIB_DEFAULTS['items_per_page'],
                'text', 0, 0, 0, 30, true, $_CONF_LIB['pi_name']);
        $c->add('ena_comments', $_LIB_DEFAULTS['ena_comments'],
                'select', 0, 0, 2, 40, true, $_CONF_LIB['pi_name']);
        $c->add('ena_ratings', $_LIB_DEFAULTS['ena_ratings'],
                'select', 0, 0, 2, 50, true, $_CONF_LIB['pi_name']);
        $c->add('displayblocks', $_LIB_DEFAULTS['displayblocks'],
                'select', 0, 0, 13, 60, true, $_CONF_LIB['pi_name']);
        $c->add('maxcheckout', $_LIB_DEFAULTS['maxcheckout'],
                'text', 0, 0, 0, 70, true, $_CONF_LIB['pi_name']);

        $c->add('fs_paths', NULL, 'fieldset', 0, 10, NULL, 0, true, 
                $_CONF_LIB['pi_name']);
        $c->add('max_images', $_LIB_DEFAULTS['max_images'],
                'text', 0, 10, 0, 10, true, $_CONF_LIB['pi_name']);
        $c->add('max_image_size', $_LIB_DEFAULTS['max_image_size'],
                'text', 0, 10, 0, 20, true, $_CONF_LIB['pi_name']);
        $c->add('max_thumb_size', $_LIB_DEFAULTS['max_thumb_size'],
                'text', 0, 10, 0, 30, true, $_CONF_LIB['pi_name']);
        $c->add('img_max_width', $_LIB_DEFAULTS['img_max_width'],
                'text', 0, 10, 0, 40, true, $_CONF_LIB['pi_name']);
        $c->add('img_max_height', $_LIB_DEFAULTS['img_max_height'],
                'text', 0, 10, 0, 50, true, $_CONF_LIB['pi_name']);
        $c->add('image_dir', $_LIB_DEFAULTS['image_dir'],
                'text', 0, 10, 0, 60, true, $_CONF_LIB['pi_name']);

        $c->add('fs_notifications', NULL, 'fieldset', 0, 20, NULL, 0, true,
                $_CONF_LIB['pi_name']);
        /*$c->add('grpcontest', $_LIB_DEFAULTS['grp_librarians'], 'select',
                0, 4, 0, 10, true, $_CONF_LIB['pi_name']);*/
        $c->add('notify_checkout', $_LIB_DEFAULTS['notify_checkout'],
                'select', 0, 0, 2, 10, true, $_CONF_LIB['pi_name']);
     }

    return true;

}

?>
