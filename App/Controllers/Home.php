<?php

namespace App\Controllers;

use App\Helpers\Session;
use \Core\View;
use \Core\Controller;
use App\Models\User;

/**
 * Home controller
 */
class Home extends Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function index()
    {

        $sessionData = Session::getGlobals();

        View::renderTemplate('Dashboard/index.html', [
            'user_id' => $sessionData['session']['user_id'] ?? null,
            'user_role' => $sessionData['session']['user_role'] ?? null,
        ]);  
        var_dump($_SESSION);  
    }
}
