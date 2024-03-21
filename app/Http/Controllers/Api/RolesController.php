<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;

use Validator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
       {
           try {
               $data = Roles::all();
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
    
           //isikan kode berikut
           try {
               //cek apakah request berisi nama_role atau tidak
               $validator = Validator::make($request->all(), [
                   'name_role' => 'required|string|max:255|unique:roles',
               ]);
    
               //kalau tidak akan mengembalikan error
               if ($validator->fails()) {
                   return response()->json($validator->errors());
               }
    
               //kalau ya maka akan membuat roles baru
               $data = Roles::create([
                   'name_role' => $request->name_role,
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
               $data = Roles::find($id);
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
                   'name_role' => 'required|string|max:255|unique:roles',
               ]);
    
               if ($validator->fails()) {
                   return response()->json($validator->errors());
               }
    
               $data = Roles::find($id);
               $data->name_role = $request->name_role;
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
               $save = Roles::find($id);
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