<?php

namespace App\Http\Controllers;
use App\Service;
use App\Product;
use DB;
use App\Traits\ImageUploader;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    use ImageUploader;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Get the index view of Services.
     *
     * @return object view
     */
    public function index(){

        $services = Service::all();

        return view('services.index',compact('services'));

    }

    /**
     * Get the create view of Services.
     *
     * @return object view
     */
    public function create(){

         //only products are shown which are not already in services
       //  $products = DB::select('SELECT * FROM products WHERE  NOT EXISTS (SELECT 1 FROM services WHERE  services.product_id = products.id)');


        return view('services.create');
    }

    /**
     * To store the services and related entries in the db.
     *
     * @return object view
     */
    public function store(Request $request){

        foreach($request->name as $key=>$name ){

            $data = array();
            $data['name']=$request->name[$key];
            $data['link1']=$request->link1;
            $data['link2']=$request->link2;
            $data['link3']=$request->link3;
            $data['photos']=$request->photos;
            $data['photos'] = $this->ImageUpload($data['photos']);

            DB::table('services')->insert($data);

        }

        return Redirect(route('service.index'))->with('toast_success', 'Service Created Successfully!');

    }

    /**
     * Get the edit view of Services.
     *
     * @return object view
     */
    public function edit($id){
        $service = Service::find($id);

        $products = Product::all();

        return view('services.edit',compact('products','service'));

    }

    /**
     * To update the Service records.
     *
     * @return object view
     */
    public function update(Request $request,$id){

        $data = array();
        $data['name']=$request->name;
        $data['link1']=$request->link1;
        $data['link2']=$request->link2;
        $data['link3']=$request->link3;
        if(isset($request->photos)) {
            $data['photos'] = $request->photos;
        }
        if(isset($data['photos'])){
            $data['photos'] = $this->ImageUpload($data['photos']);
        }
        DB::table('services')->where('id',$id)->update($data);

        return Redirect(route('service.index'))->with('toast_success', 'Service Updated Successfully!');

    }

    /**
     * To delete the service records.
     *
     * @return object view
     */
    public function delete($id){
        DB::table('services')->where('id',$id)->delete();

        return Redirect(route('service.index'))->with('toast_info', 'Service Deleted !');
    }

}
