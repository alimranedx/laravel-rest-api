<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{

    public function index()
    {
        $students = Student::all();
        $count = count($students);
        $status = Student::STATUS_NOT_FOUND;
        $message = Student::MESSAGE_NOT_FOUND;
        $data = [];
        if($count >0){
            $status = Student::STATUS_SUCCESS;
            $data = $students;
            $message = Student::MESSAGE_SUCCESS;
        }
        $data = [
            'status' => $status,
            'data' => $data
        ];
        return response()->json($data,$status);
    }
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'email' => 'required|max:30',
            'phone' => 'required|digits:11',
            'course' => 'required'
        ]);
        if($validate->fails()){
            return response()->json([
                'status' => Student::STATUS_INPUT_ERROR,
                'message' => $validate->messages()
            ], Student::STATUS_INPUT_ERROR);
        }else{
            $createResponse = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'course' => $request->course
            ]);
            if($createResponse){
                return response()->json(
                    [
                        'status' => Student::STATUS_SUCCESS,
                        'message' => Student::MESSAGE_SUCCESS
                    ],Student::STATUS_SUCCESS
                );
            }
        }
    }
    public function show($id)
    {
        $student_data = Student::find($id);
        $status = Student::STATUS_NOT_FOUND;
        $message = Student::MESSAGE_NOT_FOUND;
        $data = [];
        if($student_data){
            $status = Student::STATUS_SUCCESS;
            $data = $student_data;
            $message = Student::MESSAGE_SUCCESS;
        }
        $data = [
            'status' => $status,
            'data' => $data
        ];
        return response()->json($data,$status);
    }
    public function edit($id)
    {
        $student_data = Student::find($id);
        $status = Student::STATUS_NOT_FOUND;
        $message = Student::MESSAGE_NOT_FOUND;
        $data = [];
        if($student_data){
            $status = Student::STATUS_SUCCESS;
            $data = $student_data;
            $message = Student::MESSAGE_SUCCESS;
        }
        $data = [
            'status' => $status,
            'data' => $data
        ];
        return response()->json($data,$status);
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $update_res = Student::where('id', $id)
            ->update($data);
        $status = Student::STATUS_NOT_FOUND;
        $message = Student::MESSAGE_NOT_FOUND;
        $data = [];
        if($update_res){
            $status = Student::STATUS_SUCCESS;
            $data = [];
            $message = Student::MESSAGE_SUCCESS;
        }
        $data = [
            'status' => $status,
            'data' => $data
        ];
        return response()->json($data,$status);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if($student){
            $student->delete();

            return response()->json([
                'status' => Student::STATUS_SUCCESS,
                "messge" => Student::MESSAGE_SUCCESS
            ], Student::STATUS_SUCCESS);

        }else{
            return response()->json([
                'status' => Student::STATUS_NOT_FOUND,
                "messge" => Student::MESSAGE_NOT_FOUND
            ], Student::STATUS_NOT_FOUND);
        }
    }

}
