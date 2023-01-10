<?php

use Jeybin\Packagename\App\Http\Controllers\Controller;

Route::prefix('api/package')
     ->middleware('api')
     ->group(function() {

        Route::get('sample',Controller::class)->name('sample-name');
});