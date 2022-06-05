<?php

namespace App\Http\Controllers;
use App\Service;
use App\Product;
use App\offer;
use App\Voucher;
use DB;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class OffersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Get all the offers in the view.
     *
     * @return object view
     */
    public function index(){

        $offers = offer::all();
        return view('offers.offer_index',compact('offers'));

    }

    /**
     * Get the create view for offers.
     *
     * @return object view
     */
    public function create(){
        return view('offers.offer_create');
    }

    /**
     * Store all the offers in the db by randomly attaching a product, .
     * voucher and offered services based on the integer number given
     *
     * @return object view
     */
    public function store(Request $request){
        //if check for counting the number of services atleast 3
        $totalServices = DB::select('SELECT count(id) as id FROM services');
        $totalServices = $totalServices[0]->id;

        if($totalServices >=  $request->service_number) {
            $data = array();
            $data['offer_name'] = $request->offer_name;

            //random voucher-id
            $minV = DB::select('SELECT min(id) as id FROM vouchers ORDER BY id ASC LIMIT 1');
            $maxV = DB::select('SELECT max(id) as id FROM vouchers ORDER BY id DESC LIMIT 1');
            $minV = $minV[0]->id;
            $maxV = $maxV[0]->id;
            $data['voucher_id'] = mt_rand($minV, $maxV); //function to calculate random voucher id
            $voucher = DB::table('vouchers')->where('id', $data['voucher_id'])->first();
            while (!isset($voucher)) {
                $data['voucher_id'] = mt_rand($minV, $maxV); //function to calculate random voucher id
                $voucher = DB::table('vouchers')->where('id', $data['voucher_id'])->first();
            }
            $data['vouchercode'] = $voucher->VoucherCode;

            //random product-id
            $minP = DB::select('SELECT min(id) as id FROM products ORDER BY id ASC LIMIT 1');
            $maxP = DB::select('SELECT max(id) as id FROM products ORDER BY id DESC LIMIT 1');
            $minP = $minP[0]->id;
            $maxP = $maxP[0]->id;
            $data['product_id'] = mt_rand($minP, $maxP); //function to calculate random product id
            $product = DB::table('products')->where('id', $data['product_id'])->first();
            while (!isset($product)) {
                $data['product_id'] = mt_rand($minP, $maxP); //function to calculate random product id
                $product = DB::table('products')->where('id', $data['product_id'])->first();
            }
            $data['productitem'] = $product->productitem;

            //getting random-service
            $minS = DB::select('SELECT min(id) as id FROM services ORDER BY id ASC LIMIT 1');
            $maxS = DB::select('SELECT max(id) as id FROM services ORDER BY id DESC LIMIT 1');
            $minS = $minS[0]->id;
            $maxS = $maxS[0]->id;
            $allServices = DB::select('SELECT id FROM services ');
            $allServices = json_decode(json_encode($allServices), true);

            foreach($allServices as $ser)
            {
                $totalServiceIds[] = $ser['id'];

            }
           shuffle($totalServiceIds);
            $service = array();
            for ($i = 0; $i < $request->service_number; $i++) {
                $value = $totalServiceIds[$i];
                array_push($service, $value);
            }

            // $integer_arr = array(1,2,3);
            $integer_arr = implode(',', $service);
            $data['service_id'] = $integer_arr;

            DB::table('offers')->insert($data);

            $valueformatch = array();  //for insert data into users table for login purpose
            $valueformatch['voucher_id'] = $data['voucher_id'];
            $valueformatch['product_id'] = $data['product_id'];
            $valueformatch['vouchercode'] = $data['vouchercode'];
            $valueformatch['productitem'] = Hash::make($data['productitem']);
            $valueformatch['email'] = $data['productitem'];
            $valueformatch['name'] = $data['vouchercode'];
            DB::table('users')->insert($valueformatch);

            DB::table('vouchers')->where('id', $data['voucher_id'])->delete(); //deleting the entry of voucher
            DB::table('products')->where('id', $data['product_id'])->delete(); //deleting the entry of product

            return Redirect(route('offers.index'))->with('toast_success', 'Offer Created Successfully!');
        }
        else
        {
            return Redirect(route('offers.create'))->with('toast_error', 'Services are not sufficient.');
        }

    } //end of store method

    /**
     * To edit the offers.
     *
     * @return object view
     */
    public function edit($id){

        $offers = Offer::find($id);
        return view('offers.offer_edit',compact('offers'));
    }

    /**
     * To update the offers.
     *
     * @return object view
     */
    public function update(Request $request,$id){
        $data = array();
        $data['offer_name']=$request->offer_name;
        $minS = DB::select('SELECT id FROM services ORDER BY id ASC LIMIT 1');
        $maxS = DB::select('SELECT id FROM services ORDER BY id DESC LIMIT 1');
        $minS = $minS[0]->id;
        $maxS = $maxS[0]->id;
        $service = array();
        for ($i = 0; $i < $request->service_number ; $i++) {
               $value = mt_rand($minS,$maxS);
               array_push($service,$value);
          }

        // $integer_arr = array(1,2,3);
        $integer_arr = implode(',',$service);
        $data['service_id'] = $integer_arr;


        DB::table('offers')->where('id',$id)->update($data);
        return Redirect(route('offers.index'))->with('toast_success', 'Offer has been updated Successfully!');
    }

        public function delete($id){
         DB::table('offers')->where('id',$id)->delete();
         return Redirect(route('offers.index'))->with('toast_info', 'Offer has been deleted!');
        }

}
