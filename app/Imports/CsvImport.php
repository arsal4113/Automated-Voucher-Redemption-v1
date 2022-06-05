<?php

namespace App\Imports;

use App\Voucher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class CsvImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Voucher([
            
            
            'id' => $row['id'],
            'VoucherCode' => $row['vouchercode'],

        ]);
        
    }
    
    public function onError(throwable $error){  
    
    }

    public function rules(): array
    {
        return [
            '*.id' => 'unique:vouchers,id'
        ];
    }
    
    public function onFailure(Failure ...$failure)
    {
        return Redirect(route('voucher'))->with('toast_info', 'Skipped duplicate enteries');   
    }
    



}
