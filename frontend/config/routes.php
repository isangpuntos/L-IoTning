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

$route['default_controller'] = "pages";
$route['404_override'] = '';

$route['profile-detail'] = 'pages/profile_detail/';
$route['profile-password'] = 'pages/profile_password/';
$route['profile-history'] = 'pages/profile_order/';
$route['profile-history-detail/([0-9]+)'] = 'pages/profile_order_detail/$1';
$route['profile-history-invoice/([0-9]+)'] = 'pages/profile_order_invoice/$1';
$route['profile-download'] = 'pages/profile_download/';
$route['profile-extension'] = 'pages/profile_extension/';
$route['ajax/addcomment'] = 'pages/extension_addcomment/';
$route['extension-download'] = 'pages/extension_download/';
$route['extension/([0-9]+)/([a-zA-Z0-9-]+)'] = 'pages/extension_detail/$1/$2';
$route['checkout/([0-9]+)/([a-zA-Z0-9-]+)'] = 'pages/extension_checkout/$1/$2';
$route['checkout'] = 'pages/extension_checkout/';
$route['delivery'] = 'pages/delivery/';
$route['payment'] = 'pages/extension_payment/';
$route['category/([0-9]+)/([a-zA-Z0-9-]+)'] = 'pages/extension_category/$1/$2';
$route['category'] = 'pages/extension_category/';
$route['contact'] = 'pages/contact/';
$route['contact/([0-9]+)/([a-zA-Z0-9-]+)'] = 'pages/contact_seller/$1/$2';

$route['success'] = 'pages/success/';
$route['feature'] = 'pages/features/';
$route['module/currency'] = 'pages/currency/';
$route['demo'] = 'pages/demo/';
$route['download'] = 'pages/download/';
$route['documentation'] = 'pages/documentation/';
$route['support'] = 'pages/support/';
$route['partner'] = 'pages/partner/';
$route['sendemail'] = 'pages/sendemail/';
$route['item'] = 'pages/item/';
$route['ajax_signup'] = 'pages/ajax_signup/';
$route['ajax_shipping'] = 'pages/ajax_shipping/';
$route['add-cart'] = 'pages/add_cart/';
$route['error'] = 'pages/error/';
$route['article/([0-9]+)/([a-zA-Z0-9-]+)'] = 'pages/article/$1/$2';
$route['like/([0-9]+)/([0-9]+)'] = 'pages/like/$1/$2';
$route['dislike/([0-9]/([0-9]+)+)'] = 'pages/dislike/$1/$2';
$route['profile-update-extension'] = 'pages/profile_editextension/';
$route['profile-update-extension/([0-9]+)'] = 'pages/profile_editextension/$1/';
$route['profile/sale'] = 'pages/profile_sale/';
$route['profile'] = 'pages/profile/';
$route['profile-list/([0-9]+)/([a-zA-Z0-9-]+)'] = 'pages/profile_list/$1/$2';
$route['profile/transaction'] = 'pages/profile_transaction/';
$route['profile/address'] = 'pages/profile_address/';
$route['profile/address/edit'] = 'pages/profile_editaddress/';
$route['profile/address/edit/([0-9]+)'] = 'pages/profile_editaddress/$1/';
$route['profile/address/delete/([0-9]+)'] = 'pages/profile_deleteaddress/$1/';
$route['(.*)']= $route['default_controller']."/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */