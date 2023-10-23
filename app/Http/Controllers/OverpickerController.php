<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class OverpickerController extends Controller
{
    //
    public $DATES;

    public function __construct()
    {
        $this->DATES = include(config_path('dates.php'));
    }

    public function home(){

        $title = ' - Overwatch tool made to build Composition based in Counter and Synergies';

        return view('calculator',[
            'title' => $title,
            'dates' => $this->DATES,
        ]);
    }

    public function about(){

        $title = ' - About';

        return view('about',[
            'title' => $title,
            'dates' => $this->DATES,
        ]);
    }

    public function sources(){

        $title = ' - Sources';

        return view('sources',[
            'title' => $title,
            'dates' => $this->DATES,
        ]);
    }

    public function privacy(){

        $title = ' - Privacy Policy';

        return view('privacy',[
            'title' => $title,
            'dates' => $this->DATES,
        ]);
    }
}
