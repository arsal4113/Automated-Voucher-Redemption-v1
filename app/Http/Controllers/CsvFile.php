<?php

namespace App\Http\Controllers;

use App\Voucher;
use App\Imports\CsvImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class CsvFile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Get the index view of Vouchers.
     *
     * @return object view
     */
    public function index(){
        $voucher = Voucher::orderBy('id')->paginate(10);  //view page for displaying vouchers

        return view('voucher_file_csv',compact('voucher'))
        ->with('i',(request()->input('page',1)-1)*10 );

    }

    /**
     * To import the csv from file to DB.
     *
     * @return object view
     */
    public function csv_import(){

        Excel::import(new CsvImport, request()->file('file'));  //function to get csv file and import in db

        return Redirect(route('voucher'))->with('toast_success', 'CSV Added Successfully!');

    }


}
