<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Apply;
use App\Models\Job;
use Illuminate\Support\Facades\Validator;

class ApplyController extends Controller
{
    //

    public function apply(Request $request)
    {



        $rules = [
            'file' => 'required|mimes:pdf,png,jpg,jpeg,gif|max:5048',
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


        return ResponseFormatter::success($apply, 'lamaran anda berhasil di ajukan');
    }

    public function myApply()
    {

        $userID = Auth::user()->id;

        $data = Apply::with(['job', 'user'])->where('id_user', $userID)->get();

        return ResponseFormatter::success($data, 'My Apply Show');
    }

    public function DetailApply($id) {

        $data = Apply::with(['job'])->find($id);

        return ResponseFormatter::success($data, 'Detail MyApply Show');
    }
}
