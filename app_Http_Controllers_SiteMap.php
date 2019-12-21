<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteMap extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $status = 1)
    {
        echo "SiteMap:{$status}";
    }
}
