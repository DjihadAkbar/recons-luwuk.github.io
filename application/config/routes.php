<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'users/login';
$route['404_override'] = 'orang/nyasar';
$route['translate_uri_dashes'] = TRUE;
// $route['dailyInput'] = 'users/dailyInput';
$route['entry'] = 'users/entry';
$route['entry/entryData'] = 'users/entryData';
$route['trip'] = 'users/trip';
$route['trip/inputTrip'] = 'users/inputTrip';
$route['login'] = 'users/login';
$route['login/prosesLogin'] = 'users/prosesLogin';
$route['register'] = 'users/register';
$route['register/prosesInput'] = 'users/prosesInput';
$route['logout'] = 'users/logout';


//DASHBOARD
$route['dashboard/entry'] = 'entry/index';
$route['dashboard/entry/editEntryData'] = 'entry/editEntryData';
$route['dashboard/entry/prosesEditEntryData'] = 'entry/prosesEditEntryData';
$route['dashboard/entry/deleteEntryData'] = 'entry/deleteEntryData';
$route['dashboard/entry/editEntryDestination'] = 'entry/editEntryDestination';
$route['dashboard/entry/prosesEditEntryDestination'] = 'entry/prosesEditEntryDestination';
$route['dashboard/entry/entryData'] = 'entry/entryData';
$route['dashboard/entry/prosesEntry'] = 'entry/prosesEntry';
$route['dashboard/machine'] = 'machine/index';
$route['dashboard/account'] = 'account/index';
$route['dashboard/account/changeAccount'] = 'account/changeAccount';
$route['dashboard/account/changeDetail'] = 'account/changeDetail';
$route['dashboard/account/prosesChangeAccount'] = 'account/prosesChangeAccount';
$route['dashboard/account/prosesChangeDetail'] = 'account/prosesChangeDetail';
$route['dashboard/administrasi/kategori'] = 'kategori/index';
$route['dashboard/administrasi/kategori/create'] = 'kategori/create';
$route['dashboard/administrasi/kategori/simpan'] = 'kategori/simpan';
$route['dashboard/master/pelabuhan'] = 'master/pelabuhan';
$route['dashboard/master/lintasan'] = 'master/lintasan';
$route['dashboard/master/kapal'] = 'master/kapal';
$route['dashboard/master/tarif'] = 'master/tarif';
$route['dashboard/master/tarif/approveTarif'] = 'master/approveTarif';
$route['dashboard/master/tarif/disapproveTarif'] = 'master/disapproveTarif';
$route['dashboard/master/tarif/approveEditTarif'] = 'master/approveEditTarif';
$route['dashboard/master/tarif/disapproveEditTarif'] = 'master/disapproveEditTarif';
$route['dashboard/master/tarif/editDataTarif'] = 'master/editDataTarif';
$route['dashboard/master/pelabuhan/editDataPelabuhan'] = 'master/editDataPelabuhan';
$route['dashboard/master/kapal/editDataKapal'] = 'master/editDataKapal';
$route['dashboard/master/lintasan/editDataLintasan'] = 'master/editDataLintasan';
$route['dashboard/master/tarif/prosesEditTarif'] = 'master/prosesEditTarif';
$route['dashboard/master/pelabuhan/prosesEditPelabuhan'] = 'master/prosesEditPelabuhan';
$route['dashboard/master/kapal/prosesEditKapal'] = 'master/prosesEditKapal';
$route['dashboard/master/lintasan/prosesEditLintasan'] = 'master/prosesEditLintasan';
$route['dashboard/master/tarif/tambahTarif'] = 'master/tambahTarif';
$route['dashboard/master/pelabuhan/tambahPelabuhan'] = 'master/tambahPelabuhan';
$route['dashboard/master/kapal/tambahKapal'] = 'master/tambahKapal';
$route['dashboard/master/lintasan/tambahLintasan'] = 'master/tambahLintasan';
$route['dashboard/master/tarif/prosesTambahTarif'] = 'master/prosesTambahTarif';
$route['dashboard/master/pelabuhan/prosesTambahPelabuhan'] = 'master/prosesTambahPelabuhan';
$route['dashboard/master/kapal/prosesTambahKapal'] = 'master/prosesTambahKapal';
$route['dashboard/master/lintasan/prosesTambahLintasan'] = 'master/prosesTambahLintasan';
$route['dashboard/master/tarif/deleteTarif'] = 'master/deleteTarif';
$route['dashboard/master/pelabuhan/deletePelabuhan'] = 'master/deletePelabuhan';
$route['dashboard/master/lintasan/deleteLintasan'] = 'master/deleteLintasan';
$route['dashboard/master/kapal/deleteKapal'] = 'master/deleteKapal';
$route['dashboard/master/rka/tambahRka'] = 'master/tambahRka';
$route['dashboard/master/rka/prosesTambahRka'] = 'master/prosesTambahRka';
$route['dashboard/master/rka/deleteRka'] = 'master/deleteRka';
$route['dashboard/master/rka/prosesEditRka'] = 'master/prosesEditRka';
$route['dashboard/master/rka'] = 'dashboard/rka';


//Report
$route['dashboard/report'] = 'report/index';
$route['dashboard/report/buktiPenyetoran'] = 'report/buktiPenyetoran';
$route['dashboard/report/downloadBuktiPenyetoran'] = 'report/downloadBuktiPenyetoran';
$route['dashboard/report/dailyReport'] = 'report/dailyReport';
$route['dashboard/report/downloadDailyReport'] = 'report/downloadDailyReport';
$route['dashboard/report/rekapAsuransi'] = 'report/rekapAsuransi';
$route['dashboard/report/downloadRekapAsuransi'] = 'report/downloadRekapAsuransi';

//Admin
$route['dashboard/admin/accountSettings'] = 'admin/accountSettings';

//Archive
$route['dashboard/archive'] = 'archive/index';




