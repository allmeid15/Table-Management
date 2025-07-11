<?php

namespace App\Controllers;

use App\Models\Invoice;
use \Core\Controller;
use \Core\View;

class InvoiceController extends Controller 
{

    public function index()
    {
        $invoices= Invoice::all();

        View::renderTemplate('Invoice/Index.html',['invoice'=>$invoices]);
    }

}