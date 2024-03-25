<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SettingRoles;
use Illuminate\Http\Request;
use Validator;
use Exception;

class SettingRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = SettingRoles::all();
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data tersedia',
            ];
 
            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //cek apakah request berisi nama_role atau tidak
            $validator = Validator::make($request->all(), [
                'users_id' => 'required',
                'roles_id' => 'required',
            ]);
 
            //kalau tidak akan mengembalikan error
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
 
            //kalau ya maka akan membuat roles baru
            $data = SettingRoles::create([
                'users_id' => $request->users_id,
                'roles_id' => $request->roles_id,
            ]);
 
            //data akan di kirimkan dalam bentuk response list
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data berhasil di simpan',
            ];
 
            //jika berhasil maka akan mengirimkan status code 200
            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            //jika error maka akan mengirimkan status code 500
            return response()->json($response, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = SettingRoles::find($id);
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data tersedia',
            ];
 
            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'users_id' => 'required',
                'roles_id' => 'required',
            ]);
 
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
 
            $data = SettingRoles::find($id);
            $data->users_id = $request->users_id;
            $data->users_id = $request->roles_id;
            $data->save();
 
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data berhasil di ubah',
            ];
 
            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            return response()->json($response, 500);
        }
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $save = SettingRoles::find($id);
            if ($save == null) {
                return response()->json(['success' => false, 'message' => 'Periksa kembali data yang akan di hapus'], 404);
            }
            $save->delete();
            $response = [
                'success' => true,
                'message' => 'Sukses menghapus data',
            ];
            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            return response()->json($response, 500);
        }
    }
}
