<?php

/** 
 * The Dpd Test Project starts here
 * 
 * We define some constants.
 * 
 * @author Molnár Kristóf <molnarkristof0@gmail.com>
 */

/**
 *  App root directory.
 */
define('DTT_APP_DIR', DTT_SRC_ROOT . DIRECTORY_SEPARATOR . 'app');


/**
 * Vendor root directory.
 */
define('DTT_VENDOR_DIR', DTT_APP_DIR . DIRECTORY_SEPARATOR . 'vendor');


/**
 * Asset root url.
 */
define('DTT_ASSET_URL', '/asset/');

/**
 * If composer is not installed then we throw an exception.
 */
if (!file_exists(DTT_VENDOR_DIR . DIRECTORY_SEPARATOR . 'autoload.php')) {
    throw new Exception('First install composer! Composer not found.');
}

require_once DTT_VENDOR_DIR . DIRECTORY_SEPARATOR . 'autoload.php';

$App = \DTT\App::getInstance();

$App->run();
