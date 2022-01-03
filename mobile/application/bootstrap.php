<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT)) {
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
} else {
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('America/Cambridge_Bay');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');
Cookie::$salt = 'Your-Salt-Goes-Here';
//Cookie::$domain = '.callitme.com';

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV'])) {
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(array(
		'base_url'   => 'https://m.amygoz.com/',
		'index_file' => false,
	));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
		'auth' => MODPATH.'auth', // Basic authentication
		// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
		// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
		'database' => MODPATH.'database', // Database access
		'image'    => MODPATH.'image', // Image manipulation
		'orm'      => MODPATH.'orm', // Object Relationship Mapping
		// 'unittest'   => MODPATH.'unittest',   // Unit testing
		'userguide' => MODPATH.'userguide', // User guide and API documentation
		'email'     => MODPATH.'email', // User guide and API documentation
	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

if (empty($_SERVER['HTTP_HOST'])) {

	Route::set('default', '(<controller>(/<action>(/<id>(/<page>))))')
		->defaults(array(
			'controller' => 'cron',
			'action'     => 'index',
		)
	);

} else if (!Auth::instance()->logged_in()) {
	Route::set('default', '(<controller>(/<action>(/<id>(/<page>))))', array('controller' => '(friendsapi|importapi|peoplereviewapi|messageapi|accessapi|roundapi|activityapi|nepalivivahregister|cron|pages|company|careers|matchsingles|socialdating|pp|chat)'))
		->defaults(array(
			'controller' => 'pages',
			'action'     => 'index',
		)
	);

	Route::set('pages', '<action>', array('action' => '(login|forgot_password)'))
		->defaults(array(

			'controller' => 'pages',

		)
	);

	Route::set('staticpages', '<action>', array('action' => '(invalid_search|invalid_member|matchme|match|activity|peoplereview|localpeople|localdating|import|search|register|activity_public|logout|unsubscribe|login)'))
		->defaults(array(
			'controller' => 'pages',
		)
	);

	Route::set('search_results', '<action>', array('action' => '(search_results)'))
		->defaults(array(
			'controller' => 'pages',
		)
	);

	Route::set('username', '<username>')
		->defaults(array(
			'controller' => 'pages',
			'action'     => 'profile',
		)
	);

    Route::set('pp', '<action>', array('action'=>'(index|create)'))
		->defaults(array(
			'controller' => 'pp',
			'action'     => 'index',
		)
	);

	Route::set('commentt', '<action>/<id>', array('action' => '(commentpost)'))
        ->defaults(array(
            'controller' => 'members',
            
        )
	);
	
	Route::set('membersr', 'review/<username>', array('action' => '(review)'))
		->defaults(array(
			'controller' => 'pp',
			'action'  =>'review'
		)
	);

	Route::set('pages', 'post/<id>', array('action' => '(post_detail)'))
		->defaults(array(
			'controller' => 'pages',
			'action'     => 'post_detail',
		)
	);

} else {

	Route::set('main', '(<controller>(/<action>(/<id>(/<page>))))', array('controller' => '(friendsapi|importapi|peoplereviewapi|messageapi|accessapi|roundapi|activityapi|nepalivivahregister|upgrade|company|members|friends|profile|messages|peoplereview|localpeople|pages|import|activity|admin|careers|pp|chat)'))
		->defaults(array(
			'controller' => 'members',
			'action'     => 'index',
		)
	);

	Route::set('members', '<action>', array('action' => '(commentpost|search_results|search_member|activity_notification|navigation)'))
		->defaults(array(
			'controller' => 'members',
		)
	);

	Route::set('staticpages', '<action>', array('action' => '(logout)'))
		->defaults(array(
			'controller' => 'pages',
		)
	);
 Route::set('commentt', '<action>/<id>', array('action' => '(commentpost)'))
        ->defaults(array(
            'controller' => 'members',
            
        )
    );
	Route::set('contactapi', 'contactapi/<action>')
		->defaults(array(
			'controller' => 'import',
		)
	);

	Route::set('profile', '<username>')
		->defaults(array(
			'controller' => 'members',
			'action'     => 'profile',
		)
	);
         Route::set('pp', '<action>', array('action'=>'(index|add_public)'))
		->defaults(array(
			'controller' => 'pp',
			'action'     => 'add_public',
		)
	);
         
	Route::set('friends', '<username>/friends')
		->defaults(array(
			'controller' => 'friends',
			'action'     => 'member',
		)
	);

	Route::set('askphoto', '<username>/askphoto')
		->defaults(array(
			'controller' => 'members',
			'action'     => 'askphoto',
		)
	);

	Route::set('send_success', '<recommend>/send_success')
		->defaults(array(
			'controller' => 'peoplereview',
			'action'     => 'send',
		)
	);

}
Route::set('postdetail', 'post/<id>', array('action' => '(index)'))
	->defaults(array(
		'controller' => 'members',
		'action'  =>'post_detail'
	)
);
Route::set('directory', 'directory/people(/<startswith>)')
	->defaults(array(
		'controller' => 'pages',
		'action'     => 'directory',
	)
);
Route::set('publicdirectory', 'directory/public-personality(/<startswith>)')
	->defaults(array(
		'controller' => 'pages',
		'action'     => 'directory_public',
	)
);
Route::set('membersp', 'public/<username>', array('action' => '(index)'))
	->defaults(array(
		'controller' => 'pp',
                'action'  =>'index'
	)
);
Route::set('membersr', 'review/<username>', array('action' => '(review)'))
	->defaults(array(
		'controller' => 'pp',
                'action'  =>'review'
	)
);
Route::set('member', '<username>/<action>', array('action' => '(edit_profile|change_email|change_username|change_password|email_notification_settings|privacy_settings|subscription_details|email_resend)'))
	->defaults(array(
		'controller' => 'profile',
	)
);

Route::set('error', 'error(/<action>(/<message>))', array('action' => '[0-9]++', 'message' => '.+'))
	->defaults(array(
		'controller' => 'error',
		'action'     => '404',
		'message'    => 'Not found',
	));

Route::set('validate_user', '<version>(/<directory>)/<controller>(.<format>)',
	array(
		'version' => 'v1',
		'format'  => '(json|xml|csv|html)',
	))
	->defaults(array(
		'format' => 'json',
	));