<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public $DATES;

    public function __construct()
    {
        $this->DATES = include(config_path('dates.php'));
    }
}
