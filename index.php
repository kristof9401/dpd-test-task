<?php

/** 
 * @package     DPD Test Task
 * @author      Molnár Kristóf <molnarkristof0@gmail.com>
 * @version     1.0.0
 */

/**
 * App directory root.
 */
define('DTT_ROOT', __DIR__);

/**
 * App file path.
 */
define('DTT_FILE', __FILE__);

/**
 * SRC directory root.
 */
define('DTT_SRC_ROOT', DTT_ROOT . DIRECTORY_SEPARATOR . 'src');

/**
 * Load bootstrap file.
 */
if (file_exists(DTT_SRC_ROOT . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'app.php')) {
    require_once DTT_SRC_ROOT . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'app.php';
}
