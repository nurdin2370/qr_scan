<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Scan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ScanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Scan::get();

        return response()->json([
            "status"=> "succes",
            "message"=> "oke",
            "data"=> $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = validator::make(
            $request->all(),
            [
                'title' => 'required',
            ]
        );

        if ($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => "validation error",
                'errors' => $validator->errors(),
                'data' => []

            ]);
        }

        $scan = new scan();
        $scan->title = $request->title;

        $result = $scan->save();

        if ($result){
            return response()->json([
                "status"=>"succes",
                "message"=>"save data sukses",
                "data"=>[]

            ],200);
        } else{
            return response()->json([
                "status" => "error",
                "message" => "save data failed",
            ],200);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data= Scan::find($id);

        return response()->json([
            "status" => "succes",
            "message" => "oke",
            "data" => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $scan = Scan::find($id);

        if ($scan==null){
            return response()->json([
                "status" => "error",
                "message" => "scan not found",
                "data" =>[]
            ],200);

        }
        $scan->title = $request->title;

        $result = $scan->save();

        if ($result){
            return response()->json([
                "status" => "success",
                "message" => "update data success",
                "data" =>[]
            ],200);
        }else{
            return response()->json([
                "status" => "error",
                "message" => "update data failed",
            ],200);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $scan = Scan::find($id);

        if ($scan==null){
            return response()->json([
                "status" => "error",
                "message" => "scan not found",
                "data" =>[]
            ],200);

        }

        $result = $scan->delete();

        if ($result){
            return response()->json([
                "status" => "success",
                "message" => "delete data success",
                "data" =>[]
            ],200);
        }else{
            return response()->json([
                "status" => "error",
                "message" => "delete data failed",
            ],200);
        }
    }
}
