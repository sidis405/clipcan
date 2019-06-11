<?php
Route::get('/', 'HomeController@index')->name('home');


// User - ACL - ROLES/PERMISSIONS
    // perid - univoco
    // ruolo -
// Album
    // Ha tantye foto / video
    // Ha tag
    // appartiente ad un utente
    // pu`o essere privato o meno
// Image - photo
    // hanno tag
    // appartengno a piu album
    // hanno un autore
    // data di scattto
    // pu`o essere privato o meno
// Tag
    // appanrtono a piu Image
    // appartengono a piu album

Auth::routes();
