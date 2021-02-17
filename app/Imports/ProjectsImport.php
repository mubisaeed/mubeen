<?php

namespace App\Imports;

use App\CodesData;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class ProjectsImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation

{
    use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */



    public function rules(): array
    {
        return [
            'name'             => 'required|max:35',
            'email'            => 'required|email|unique:users,email',
            'phone'            => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'admission_date'   => 'required',
            'gender'           => 'required',
            'address'           => 'required',
            'rollno'           => 'required',
            'class'           => 'required',
            'alergy'           => 'required|max:80',
            'diabetes'         => 'required|max:15',
     
        ];
 
    }
 
    public function customValidationMessages()
    {
    return [


            #All Email Validation for Student Email
        'email.required'    => 'Student  Email must not be empty!',
        'email.email'       => 'Incorrect Student email address!',
        'email.unique'      => 'The Student email has already been used.',


        #Max Lenght Validation
        'name.required'               => 'Student name must not be empty!',
        'name.max'                    => 'The maximun length of The Student name must not exceed :max',
        'admission_date.required'              => 'Student admission must not be empty!',
        'class.required'              => 'Student class must not be empty!',
        'rollno.required'              => 'Student roll no is compulsory!',
        'address.required'            => 'Address  must not be empty!',
        'address.max'                 => 'The maximun length of The Address must not exceed :max',


        #Max Length with Contact Numeric Student
        'phone.required'      => 'Student contact must not be empty!',
        'phone.regex'         => 'Incorrect format of Student Contact',

       ];
  }

    public function model(array $row)
    {
        $excl_stds = array(
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => $row['password'],
        );
        $excel_student = DB::table('users')->insertGetId($excl_stds);
        return new CodesData([
            'father_name'     => $row['father_name'],
            's_u_id'     => $excel_student,
             'phone'   => $row['phone'],
             'cnic'   => $row['cnic'],
             'address'   => $row['address'],
             'class'   => $row['class'],
             'rollno'   => $row['rollno'],
             'diabetes'   => $row['diabetes'],
             'alergy'   => $row['alergy'],
             'admission_date'   => $row['admission_date'],
             'gender'   => $row['gender'],
        ]);
    }
    public function onError(Throwable $error)
    {

    }
}
