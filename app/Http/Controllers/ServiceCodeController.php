<?php

namespace App\Http\Controllers;
use App\Code;

use App\Voucher;
use App\Service;
use App\Product;
use DB;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class ServiceCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    /**
     * Get the index view of Service Code page.
     *
     * @return object view
     */
    public function index(){

        $servicecodes = Code::all();
        return view('servicecode.code_index',compact('servicecodes'));

    }

    /**
     * Get the list of unconsumed voucher and products
     * and upload them in enum list
     *
     * @return object view
     */
    public function create(){
        //$vouchers = Voucher::all();
        //$services = Service::all();
        //$servicecodes = Code::all();
        // $products = Product::all();


        //sql query for getting vouchers if not already present in servicecode-table
      $vouchers = DB::select('SELECT * FROM vouchers WHERE  NOT EXISTS (SELECT 1 FROM codes WHERE  codes.voucher_id = vouchers.id)');

        //sql query for getting services if not already present in servicecode-table
      $services = DB::select('SELECT * FROM services WHERE  NOT EXISTS (SELECT 1 FROM codes WHERE  codes.service_id = services.id)');

      return view('servicecode.code_create',compact('vouchers','services'));

    }

    /**
     * Get the voucher and product and consume them in the service.
     *
     * @return object view
     */
    public function store(Request $request){

        $data = array();
        $data['service_code']=$request->service_code;
        $data['voucher_id']=$request->voucher_id;
        $data['service_id']=$request->service_id;
        DB::table('codes')->insert($data);    //Insert into ServiceCodes

         //code for matching table
        $serviceId = $request->service_id;
        $getservice = DB::table('services')->where('id',$serviceId)->first();

        $productId = $getservice->product_id;
        $product = DB::table('products')->where('id',$productId)->first();
        $voucherId = $request->voucher_id;
        $voucher = DB::table('vouchers')->where('id',$voucherId)->first();

        $valueformatch = array();
        $valueformatch['productitem']=$product->productitem;
        $valueformatch['vouchercode']=$voucher->VoucherCode;
        DB::table('matchings')->insert($valueformatch);

        $valueformatch['voucher_id']=$voucherId;
        $valueformatch['product_id']=$productId;
        //product-item re-declaring for hashing
        $valueformatch['productitem']= Hash::make($product->productitem);
        $valueformatch['email']= $product->productitem;
        $valueformatch['name']= $voucher->VoucherCode;
        //for login-Users table
        DB::table('users')->insert($valueformatch);

        //redirect  to index
      return Redirect(route('servicecode.index'))->with('toast_success', 'ServiceCode Created Successfully!');

    }

    /**
     * To edit the Service Code view.
     *
     * @return object view
     */
    public function edit($id){
        $vouchers = Voucher::all();
        $services = Service::all();
        // $products = Product::all();

        $servicecodes = Code::find($id);


        return view('servicecode.code_edit',compact('vouchers','services','servicecodes'));

    }

    /**
     * To update the Service Code view.
     *
     * @return object view
     */
    public function update(Request $request,$id){

        $data = array();
        $data['service_code']=$request->service_code;
        $data['voucher_id']=$request->voucher_id;
        $data['service_id']=$request->service_id;

        DB::table('codes')->where('id',$id)->update($data);

        return Redirect(route('servicecode.index'))->with('toast_success', 'ServiceCode Updated Successfully!');

    }

    public function delete($id){
        DB::table('codes')->where('id',$id)->delete();

        return Redirect(route('servicecode.index'))->with('toast_info', 'ServiceCode Deleted !');



    }

}
