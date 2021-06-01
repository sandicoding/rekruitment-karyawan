<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    //

    public function index() {

        $job = Job::all();

        return ResponseFormatter::success($job,'Data profile user berhasil diambil');
    }

    public function detail($id) {

        $data = Job::find($id);


        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'mentor not found'
            ], 404);
        }

        return ResponseFormatter::success($data,'Detail data job berhasil ditampilkan');
    }

}
