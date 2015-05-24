<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'pages/view';

//change admins to secret location later

$route['login'] = 'admin/login/view'; 
$route['login/pass'] ='admin/login/checkLogin';
$route['login/admin'] ='admin/dashboard/view';

//reviews page
$route['specials'] = 'front/specials/view';
$route['reviews'] = 'front/reviews/view';

//category pages

$route['(film)'] = 'front/category/view/$1';
$route['(art_music)'] = 'front/category/view/$1';
$route['(festivals)'] = 'front/category/view/$1';
$route['(tv)'] = 'front/category/view/$1';
$route['(books_comics)'] = 'front/category/view/$1';
$route['(chronicle_cast)'] ='front/category/view/$1';
$route['(top)'] = 'front/category/view/$1';
$route['(misc)'] = 'front/category/view/$1';
$route['(culture_corner)'] = 'front/category/view/$1';

//for load more ajax on category pages
$route['category']  = 'front/category/view';

$route['rss'] = 'front/feed';

//posts
$route['(:num)/(:num)/(:num)/(:any)'] = 'front/posts/load/$4';

//home and static pages
$route['(ideas)'] = 'pages/view/$1';
$route['(archive)'] = 'pages/view/$1';
$route['(whats-this)'] = 'pages/view/$1';
$route['(contact)'] = 'pages/view/$1';

$route['(:any)'] = 'error/error_404';
/* End of file routes.php */
/* Location: ./application/config/routes.php */