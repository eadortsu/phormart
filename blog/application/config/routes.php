<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_404';
$route['translate_uri_dashes'] = FALSE;
$route['index'] = 'home/index';
$route['error-404'] = 'home/error_404';

$route['post/(:any)'] = 'home/post/$1';

$route['gallery'] = 'home/gallery';
$route['contact'] = 'home/contact';
$route['category/(:any)'] = 'home/category/$1';
$route['profile/(:any)'] = 'home/profile/$1';
$route['tag/(:any)'] = 'home/tag/$1';
$route['reading-list'] = 'home/reading_list';
$route['search'] = 'home/search';

//rss routes
$route['rss-feeds'] = 'home/rss_feeds';
$route['rss/posts'] = 'rss/rss_all_posts';
$route['rss/popular-posts'] = 'rss/rss_popular_posts';
$route['rss/category/(:any)'] = 'rss/rss_by_category/$1';

//auth routes
$route['login'] = 'auth/login';
$route['admin/login'] = 'auth/admin_login';
$route['register'] = 'auth/register';
$route['profile-update'] = 'auth/update_profile';
$route['change-password'] = 'auth/change_password';
$route['reset-password'] = 'auth/reset_password';
$route['logout'] = 'auth/logout';

//admin routes
$route['admin'] = 'admin/index';

require APPPATH . 'config/routes_lang.php';
$route['(:any)'] = 'home/get_page/$1';
