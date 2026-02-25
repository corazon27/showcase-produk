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
$route['default_controller'] = 'home';
$route['cara-order'] = 'cara_order';
$route['tentang-kami'] = 'tentang';
$route['kontak-kami'] = 'kontak';
$route['testimoni-admin'] = 'testimoni_admin';
$route['testimoni-admin/kelola'] = 'testimoni_admin/kelola';
// Route untuk menangkap ID dan Status
$route['testimoni-admin/verifikasi/(:num)/(:any)'] = 'testimoni_admin/verifikasi/$1/$2';
$route['testimoni-admin/hapus/(:num)'] = 'testimoni_admin/hapus/$1';
$route['testimoni-admin/hapus_foto/(:num)'] = 'testimoni_admin/hapus_foto/$1';
// Mengarahkan alamat utama ke index
$route['input-produk'] = 'input_produk';
$route['input-produk/get_ajax_produk/(:num)'] = 'input_produk/get_ajax_produk/$1';
$route['input-produk/get_galeri_by_id/(:num)'] = 'input_produk/get_galeri_by_id/$1';
$route['input-produk/get_produk_by_id/(:num)'] = 'input_produk/get_produk_by_id/$1'; // Tambahkan ini secara spesifik
$route['input-produk/edit/(:num)'] = 'input_produk/edit/$1';
$route['input-produk/hapus/(:num)'] = 'input_produk/hapus/$1';
$route['input-produk/hapus_galeri/(:num)'] = 'input_produk/hapus_galeri/$1';
$route['input-produk/(:any)'] = 'input_produk/$1'; // Ini harus selalu paling bawah
$route['detail/(:any)/(:num)'] = 'home/detail/$2';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;