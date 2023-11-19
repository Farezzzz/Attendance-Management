<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login/guru', 'Login::index');
$routes->post('guru/login/auth', 'Login::auth');
$routes->get('/logout', 'Login::logout', ['filter' => 'auth']);
$routes->get('/guru/home', 'Home::homeGuru', ['filter' => 'auth']);
$routes->get('guru/clockin', 'Home::checkin', ['filter' => 'auth']);
$routes->get('/guru/listabsen', 'Home::listabsen', ['filter' => 'auth']);
$routes->get('/guru/datasiswa', 'Home::datasiswa', ['filter' => 'auth']);
$routes->get('/rekapabsen', 'Home::rekapabsen', ['filter' => 'auth']);
$routes->get('/rekapabsentabel', 'Home::rekapabsentabel', ['filter' => 'auth']);
$routes->get('guru/historyabsen', 'Home::historyabsen', ['filter' => 'auth']);
$routes->get('guru/rekapabsen', 'Home::rekapabsen', ['filter' => 'auth']);
$routes->get('/clockout', 'Home::checkout', ['filter' => 'auth']);
$routes->post('/clockin/save', 'Absen::clockin', ['filter' => 'auth']);
$routes->post('/clockout/save', 'Absen::clockout', ['filter' => 'auth']);
$routes->add('guru/editstatussiswa/(:segment)', 'editStatusSiswa::editstatus/$1', ['filter' => 'auth']);
$routes->add('guru/editstatussiswa', 'editStatusSiswa::editstatusfailed', ['filter' => 'auth']);
$routes->post('/user/update', 'editStatusSiswa::update', ['filter' => 'auth']);


$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/register', 'Register::index');
$routes->post('/register/save', 'Register::save');
$routes->get('/logout', 'Login::logout', ['filter' => 'auth']);
$routes->get('/home', 'Home::home', ['filter' => 'auth']);

$routes->group('', ['filter' => 'CekSiswa'], function ($routes) {
    $routes->get('/siswa/home', 'SiswaHome::home', ['filter' => 'auth']);
  
    $routes->get('/siswa/listabsen', 'SiswaHome::listabsen', ['filter' => 'auth']);
    $routes->get('/siswa/historyabsen', 'SiswaHome::historyabsen', ['filter' => 'auth']);
    $routes->get('/siswa/clockout', 'SiswaHome::checkout', ['filter' => 'auth']);
    $routes->post('/siswa/clockin/save', 'Absen::clockin', ['filter' => 'auth']);
    $routes->post('/siswa/clockout/save', 'Absen::clockout', ['filter' => 'auth']);
    $routes->match(['get', 'post'], '/siswa/gantipassword', 'SiswaHome::gantipassword', ['filter' => 'auth']);
    $routes->post('/siswa/gantipassword/save', 'SiswaHome::aksigantipassword', ['filter' => 'auth']);

    $routes->group('',['filter'=>'CekAbsen'],function($routes){
        $routes->get('/siswa/clockin', 'SiswaHome::checkin', ['filter' => 'auth']);
        $routes->get('/siswa/clockout', 'SiswaHome::checkout', ['filter' => 'auth']);
        $routes->post('/siswa/clockin/save', 'Absen::clockin', ['filter' => 'auth']);
        $routes->post('/siswa/clockout/save', 'Absen::clockout', ['filter' => 'auth']);
    });
});

$routes->group('', ['filter' => 'CekAdmin'],  function ($routes) {
    $routes->get('/admin/home', 'Admin::admin', ['filter' => 'auth']);
    $routes->post('report/pdf', 'ReportController::generatePDF',['filter' => 'auth']);
    $routes->get('/admin/siswa', 'Siswa::siswa', ['filter' => 'auth']);
    $routes->get('/admin/siswa/createSiswa', 'Siswa::buatsiswa', ['filter' => 'auth']);
    $routes->post('/admin/siswa/aksiCreateSiswa', 'Siswa::aksiBuatSiswa', ['filter' => 'auth']);
    $routes->get('/admin/siswa/edit/(:num)', 'Siswa::editsiswa/$1', ['filter' => 'auth']);
    $routes->post('/admin/siswa/aksiEditsiswa/(:num)', 'Siswa::aksiEditSiswa/$1', ['filter' => 'auth']);
    $routes->add('/admin/siswa/delete/(:num)', 'Siswa::deletesiswa/$1', ['filter' => 'auth']);
    $routes->get('/admin/siswa/import', 'Siswa::import', ['filter' => 'auth']);
    $routes->post('/admin/siswa/importExcel', 'Siswa::importExcel', ['filter' => 'auth']);
    $routes->get('/download-template', 'Siswa::downloadTemplate', ['filter' => 'auth']);


    $routes->get('/admin/guru', 'Guru::index', ['filter' => 'auth']);
    $routes->get('/admin/guru/Create', 'Guru::buatguru', ['filter' => 'auth']);
    $routes->post('/admin/guru/aksiCreateguru', 'Guru::aksiBuatguru', ['filter' => 'auth']);
    $routes->get('/admin/guru/edit/(:num)', 'Guru::editguru/$1', ['filter' => 'auth']);
    $routes->post('/admin/guru/aksiEditguru/(:num)', 'Guru::aksiEditguru/$1', ['filter' => 'auth']);
    $routes->add('/admin/guru/delete/(:num)', 'Guru::deleteguru/$1', ['filter' => 'auth']);
    $routes->get('/admin/guru/import', 'Guru::import', ['filter' => 'auth']);
    $routes->post('/admin/guru/importExcel', 'Guru::importExcel', ['filter' => 'auth']);
    $routes->get('/download-templateGuru', 'Guru::downloadTemplateGuru', ['filter' => 'auth']);


    $routes->get('/admin/kelas', 'Kelas::kelas', ['filter' => 'auth']);
    $routes->get('/admin/kelas/createKelas', 'Kelas::buatkelas', ['filter' => 'auth']);
    $routes->post('/admin/kelas/aksiCreateKelas', 'Kelas::aksiBuatKelas', ['filter' => 'auth']);
    $routes->get('/admin/kelas/edit/(:num)', 'Kelas::editkelas/$1', ['filter' => 'auth']);
    $routes->post('/admin/kelas/aksiEditkelas/(:num)', 'Kelas::aksiEditKelas/$1', ['filter' => 'auth']);
    $routes->add('/admin/kelas/delete/(:num)', 'Kelas::deletekelas/$1', ['filter' => 'auth']);
    $routes->get('/admin/kelas/data/(:num)', 'Kelas::datasiswa/$1', ['filter' => 'auth']);

    $routes->get('/admin/walikelas', 'Walikelas::walikelas', ['filter' => 'auth']);
    $routes->get('/admin/walikelas/createWalikelas', 'Walikelas::buatWalikelas', ['filter' => 'auth']);
    $routes->post('/admin/walikelas/aksiCreatewalikelas', 'Walikelas::aksiBuatwalikelas', ['filter' => 'auth']);
    $routes->get('/admin/walikelas/edit/(:num)', 'Walikelas::editwalikelas/$1', ['filter' => 'auth']);
    $routes->post('/admin/walikelas/aksiEditwalikelas/(:num)', 'Walikelas::aksiEditwalikelas/$1', ['filter' => 'auth']);
    $routes->add('/admin/walikelas/delete/(:num)', 'Walikelas::deletewalikelas/$1', ['filter' => 'auth']);

    $routes->get('/admin/user', 'User::index', ['filter' => 'auth']);

    $routes->get('/admin/user/validasi', 'User::validasi', ['filter' => 'auth']);
    $routes->post('/admin/user/aksiValidasi', 'User::aksiValidasi', ['filter' => 'auth']);

    $routes->get('/admin/user/Createguru', 'User::buatuserguru', ['filter' => 'auth']);
    $routes->post('/admin/user/aksiCreateuserguru', 'User::aksiBuatuserguru', ['filter' => 'auth']);

    $routes->get('/admin/user/Createsiswa', 'User::buatusersiswa', ['filter' => 'auth']);
    $routes->post('/admin/user/aksiCreateusersiswa', 'User::aksiBuatusersiswa', ['filter' => 'auth']);

    $routes->get('/admin/user/edit/(:num)', 'User::edituser/$1', ['filter' => 'auth']);
    $routes->post('/admin/user/aksiEdituser/(:num)', 'User::aksiEdituser/$1', ['filter' => 'auth']);


    $routes->add('/admin/user/delete/(:num)', 'User::deleteuser/$1', ['filter' => 'auth']);

    $routes->get('/admin/rekapabsen', 'Rekap::index', ['filter' => 'auth']);
    $routes->get('/admin/rekapabsen/edit/(:num)', 'Rekap::editrekap/$1', ['filter' => 'auth']);
    $routes->post('/admin/rekapabsen/aksiEditRekap/(:num)', 'Rekap::aksiEditRekap/$1', ['filter' => 'auth']);
    $routes->add('/admin/rekapabsen/delete/(:num)', 'Rekap::deleterekap/$1', ['filter' => 'auth']);

    $routes->get('/report/pdf', 'ReportController::generatePDF', ['filter' => 'auth']);

    $routes->get('/qrscanner', 'QRCode::index');
    $routes->get('/qrscanner/scan', 'QRCode::scan');
    $routes->get('/qrscanner/validateqr', 'QRCode::validate_qr');


    $routes->get('generateQRcode', 'QRCode::generateQrCode');
    $routes->get('QRcode', 'QRCode::showQrCode');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
