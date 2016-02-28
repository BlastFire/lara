<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CrownController extends Controller
{
    /**
     * Test function for various shits
     *
     **/
    public function index($post_id, $increment)
    {
    	// if(Request::ajax()) {
     //  		// $data = Input::all();
     //  		// print_r($data);die;
     //  		return "yes";
    	// }
    	// return "no";

    	//return Request::json(array("name" => "velizar"));
    	return $post_id . ' ' . $increment;
    }

    public function testview() {
    	$testdata1 = [
    		'firstname' => 'ivan',
    		'lastname' => 'ivanov'
		];

    	$testdata2 = [
    		'firstname' => 'dragan',
    		'lastname' => 'draganov'
		];

		$testdata3 = array();
		array_push($testdata3, $testdata1);
		array_push($testdata3, $testdata2);

		$testdata = json_encode($testdata3);
		return view('wadapp.testview', compact('testdata'));
    }
}
