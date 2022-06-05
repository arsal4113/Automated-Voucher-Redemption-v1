<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Product;
use DB;
use PhpParser\Node\Expr\Array_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Get all the services which are related to the offer in User screen for Vue components.
     *
     * @return array $totalServiceIds
     */
    public function getallservices(){
        $productID = auth()->user()->product_id;
        $offers = DB::select("SELECT * FROM offers WHERE product_id = $productID");
        if(isset($offers))
        {
            $services = $offers[0]->service_id;
        }
        if(isset($services))
        {
            $services =explode(",",$services);
        }
        $totalServiceIds = array();
        foreach($services as $service)
        {
            $totalServiceIds[] = DB::select("SELECT * FROM services WHERE id = $service");

        }
        return $totalServiceIds;

    }

    /**
     * Get all the specified offered record for the product logged in for Vue components.
     *
     * @return object $offers
     */
    public function getalloffers(){
        $productID = auth()->user()->product_id;
        return $offers = DB::table('offers')
            ->join('users', 'offers.product_id', '=', 'users.product_id')
            ->where('offers.product_id', $productID)
            ->get();
    }
}

