<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'course'
    ];

    const STATUS_NOT_FOUND = 404;
    const STATUS_SUCCESS = 200;
    const STATUS_SERVER_ERROR = 500;
    const STATUS_INPUT_ERROR = 422;
    const MESSAGE_SUCCESS = "SUCCESS";
    const MESSAGE_NOT_FOUND = "DATA NOT FOUND";
    CONST MESSAGE_ERROR = "ERROR";
    public static function createStudent($request){
        dd($request->all());
    }
}
