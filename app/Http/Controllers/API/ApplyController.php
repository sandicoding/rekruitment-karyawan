<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apply;
use Illuminate\Support\Facades\Validator;

class ApplyController extends Controller
{
    //

    public function apply(Request $request)
    {
        $rules = [
            'id_user' => 'required|exists:users,id',
            'id_job' => 'required|exists:jobs,id',
            'status' => 'required',
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf,png,jpg,jpeg,gif|max:5048'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $data['file'] = $request->file('file')->store('assets/file', 'public');
        $data['id_user'] = Auth::user()->id;


        $apply = Apply::create($data);


        return ResponseFormatter::success($apply,'lamaran anda berhasil di ajukan');

    }

    public function myApply($id) {



    }
}
