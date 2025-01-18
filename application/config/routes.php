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
|	https://codeigniter.com/userguide3/general/routing.html
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

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] 									= 'Auth/login';
$route['logout'] 									= 'Auth/logout';
$route['register'] 									= 'Auth/register';
$route['user/register'] 							= 'Auth/store';
$route['dashboard'] 								= 'Backend/Dashboard';

//admin
$route['admin/list_produk'] 						= 'Backend/Produk';
$route['admin/tambah_produk'] 						= 'Backend/Produk/insert';
$route['admin/get_data_produk'] 					= 'Backend/Produk/get_data_produk';
$route['admin/store_produk'] 						= 'Backend/Produk/store';

//admin-bahan baku
$route['admin/list_bahan']							= 'Backend/BahanBaku';
$route['admin/store_bahan']							= 'Backend/BahanBaku/store';
$route['admin/get_data_bahanbaku'] 					= 'Backend/BahanBaku/get_data_bahanbaku';
$route['admin/tambah_bahan_baku'] 					= 'Backend/BahanBaku/store';
$route['admin/get_bahan_by_id']						= 'Backend/BahanBaku/get_bahan_by_id';
$route['admin/update_bahan']						= 'Backend/BahanBaku/update_bahan';
$route['admin/delete_bahan/(:num)']					= 'Backend/BahanBaku/delete_bahan/$1';

//admin-kategori produk
$route['admin/list_kategori']						= 'Backend/Kategori_produk';
$route['admin/store_kategori']						= 'Backend/Kategori_produk/insert';
$route['admin/get_data_kategori'] 					= 'Backend/Kategori_produk/get_data_kategori';
$route['admin/delete_kategori/(:num)']				= 'Backend/Kategori_produk/delete/$1';
$route['admin/update_kategori']						= 'Backend/Kategori_produk/update';
$route['admin/get_kategori_by_id']					= 'Backend/Kategori_produk/get_kategori_by_id';

//admin - transaksi
$route['admin/list_transaksi']						= 'Backend/Transaksi';
$route['admin/update_status_sedang/(:num)']			= 'Backend/Transaksi/update_status_sedang/$1';
$route['admin/update_status_sudah/(:num)']			= 'Backend/Transaksi/update_status_sudah/$1';
$route['admin/update_status_pesanan_dibuat/(:num)'] = 'Backend/Transaksi/update_status_pesanan_dibuat/$1';
$route['admin/update_status_pesanan_diantar/(:num)']= 'Backend/Transaksi/update_status_pesanan_diantar/$1';

//user-pesanan
$route['user/pesanan']								= 'Backend/Pesanan';
$route['user/pesan_sekarang/(:num)']				= 'Backend/Pesanan/insert/$1';

//user-transaksi
$route['user/list_transaksi']						= 'Backend/Transaksi';
$route['user/transaksi']							= 'Backend/Transaksi/insert';
$route['user/get_data_transaksi']					= 'Backend/Transaksi/get_data_transaksi';

//user-reviews
$route['user/submit_review']						= 'Backend/Transaksi/submit_review';

//admin-reviews
$route['admin/get_reviews']							= 'Backend/Transaksi/get_reviews';
