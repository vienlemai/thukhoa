<?php

/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */
/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */
/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter . By Default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 * 		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 * 		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 * 		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
/*
  set true if new registrations are allowed
 */
if (!defined("SITE_REGISTRATION")) {
    define("SITE_REGISTRATION", true);
}

/*
  set true if you want send registration mail to user
 */
if (!defined("SEND_REGISTRATION_MAIL")) {
    define("SEND_REGISTRATION_MAIL", true);
}

/*
  set true if you want verify user's email id, site will send email confirmation link to user's email id
  sett false you do not want verify user's email id, in this case user becomes active after registration with out email verification
 */
if (!defined("EMAIL_VERIFICATION")) {
    define("EMAIL_VERIFICATION", true);
}


/*
  set email address for sending emails
 */
if (!defined("EMAIL_FROM_ADDRESS")) {
    define("EMAIL_FROM_ADDRESS", 'example@example.com');
}

/*
  set site name for sending emails
 */
if (!defined("EMAIL_FROM_NAME")) {
    define("EMAIL_FROM_NAME", 'User Management Plugin');
}

/*
  set login redirect url, it means when user gets logged in then site will redirect to this url.
 */
if (!defined("LOGIN_REDIRECT_URL")) {
    define("LOGIN_REDIRECT_URL", '/dashboard');
}

/*
  set logout redirect url, it means when user gets logged out then site will redirect to this url.
 */
if (!defined("LOGOUT_REDIRECT_URL")) {
    define("LOGOUT_REDIRECT_URL", '/login');
}

/*
  set true if you want to enable permissions on your site
 */
if (!defined("PERMISSIONS")) {
    define("PERMISSIONS", true);
}

/*
  set true if you want to check permissions for admin also
 */
if (!defined("ADMIN_PERMISSIONS")) {
    define("ADMIN_PERMISSIONS", false);
}

/*
  set default group id here for registration
 */
if (!defined("DEFAULT_GROUP_ID")) {
    define("DEFAULT_GROUP_ID", 2);
}

/*
  set Admin group id here
 */
if (!defined("ADMIN_GROUP_ID")) {
    define("ADMIN_GROUP_ID", 1);
}

/*
  set Guest group id here
 */
if (!defined("GUEST_GROUP_ID")) {
    define("GUEST_GROUP_ID", 3);
}
/*
  set true if you want captcha support on register form
 */
if (!defined("USE_RECAPTCHA")) {
    define("USE_RECAPTCHA", false);
}
/*
  set Admin group id here
 */
if (!defined("PRIVATE_KEY_FROM_RECAPTCHA")) {
    define("PRIVATE_KEY_FROM_RECAPTCHA", '');
}
/*
  set Admin group id here
 */
if (!defined("PUBLIC_KEY_FROM_RECAPTCHA")) {
    define("PUBLIC_KEY_FROM_RECAPTCHA", '');
}
/*
  set login cookie name
 */
if (!defined("LOGIN_COOKIE_NAME")) {
    define("LOGIN_COOKIE_NAME", 'UsermgmtCookie');
}
Configure::write('Dispatcher.filters', array(
    'AssetDispatcher',
    'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
    'engine' => 'FileLog',
    'types' => array('notice', 'info', 'debug'),
    'file' => 'debug',
));
CakeLog::config('error', array(
    'engine' => 'FileLog',
    'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
    'file' => 'error',
));
// load Usermgmt plugin and apply plugin routes. Keep all the other plugins you are using here
CakePlugin::loadAll(array(
    'Usermgmt' => array('bootstrap' => true, 'routes' => true),
));
CakePlugin::load('Facebook');