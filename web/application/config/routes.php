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
$route['default_controller'] = 'welcome';
$route['gallery'] = 'welcome/gallery';          
$route['sub-category/(:any)'] = 'welcome/sub_category/$1';
$route['product-list'] = 'welcome/product_list'; 
$route['product-list/(:any)/(:any)'] = 'welcome/product_list/$1/$1'; 
$route['product-list/(:any)'] = 'welcome/product_list/$1'; 
$route['folder-remove/(:any)'] = 'welcome/folder_remove/$1'; 
$route['brand-profile/(:any)'] = 'welcome/brand_profile/$1'; 
$route['brandprofile/(:any)'] = 'welcome/brandprofile/$1'; 
$route['resellers/(:any)'] = 'welcome/resellers/$1'; 
$route['resellers/(:any)/(:any)'] = 'welcome/resellers/$1/$1'; 
$route['wishlist'] = 'welcome/wishlist'; 
$route['moodboard'] = 'welcome/moodboard'; 
$route['register'] = 'welcome/register'; 
$route['add-user'] = 'welcome/add_user'; 
$route['login'] = 'welcome/login'; 
$route['login-user'] = 'welcome/login_user'; 
$route['my-account'] = 'welcome/my_account'; 
$route['brand-list'] = 'welcome/brand_list'; 
$route['logout'] = 'welcome/logout'; 
$route['blog'] = 'welcome/blog'; 
$route['blog-info/(:any)'] = 'welcome/blog_info/$1';
$route['get-number/(:any)/(:any)'] = 'welcome/get_number/$1/$1';
$route['get-number-re/(:any)/(:any)'] = 'welcome/get_number_re/$1/$1';
$route['request-call-back'] = 'welcome/number_request';
$route['request-call-back-re'] = 'welcome/number_request_re';
$route['add-wishlist/(:any)/(:any)'] = 'welcome/add_wishlist/$1/$1';
$route['add-product-wishlist/(:any)/(:any)'] = 'welcome/add_product_wishlist/$1/$1';
$route['remove-wishlist/(:any)/(:any)'] = 'welcome/remove_wishlist/$1/$1';
$route['remove-product-wishlist/(:any)/(:any)'] = 'welcome/remove_product_wishlist/$1/$1';
$route['wishlist-remove/(:any)'] = 'welcome/wishlist_remove/$1';
$route['wishlist-folder/(:any)'] = 'welcome/wishlist_folder/$1';
$route['brand-request'] = 'welcome/brand_request'; 




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
