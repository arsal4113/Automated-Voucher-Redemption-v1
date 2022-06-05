<?php

namespace App\Http\Controllers;

use App\Product;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ProductItems extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Get the index view of Products page.
     *
     * @return object view
     */
    public function index(){

        $productitem = Product::orderBy('id')->paginate(10);  //view page for displaying products

        return view('productitem_file_csv',compact('productitem'))
        ->with('i',(request()->input('page',1)-1)*10 );

    }

    /**
     * To import the csv files and uploading them in view.
     *
     * @return object view
     */
    public function csvimport(){

        Excel::import(new ProductImport, request()->file('file')); //function to get csv file and import in db

        return Redirect(route('productitem'))->with('toast_success', 'CSV Added Successfully!');

    }


}
