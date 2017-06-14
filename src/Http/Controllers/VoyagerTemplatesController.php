<?php

namespace akazorg\VoyagerTemplates\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;

class VoyagerTemplatesController extends VoyagerBreadController
{
    public function index(){
    	echo 'VoyagerTemplatesController';
    }
}
