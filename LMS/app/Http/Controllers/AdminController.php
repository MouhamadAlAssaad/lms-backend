<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class AdminController extends Controller
{
   public function getAllAdmin(Request $req){
      try{
      $admin = Admin::get();
      return response()->json([
         "message" => $admin
      ]);
   } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
   }


   public function getAdmin(Request $req, $id){
      try{
      $admin = Admin::where("id", $id)->get();
      return response()->json([
         "message" => $admin
      ]);
   } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
   }


   public function addAdmin(Request $req){
      try{
      $admin = new Admin();
      $username = $req->input("username");
      $email = $req->input("email");
      $password = hash::make($req->input('password'));
      $admin->username = $username;
      $admin->email = $email;
      $admin->password = $password;
      $admin->save();
      return response()->json([
         "message" => "Success"
      ]);
   } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
   }

   public function deleteAdmin(Request $req, $id){
      try{
         $admin = Admin::find($id);
         $admin->delete();
         return response()->json([
             'message' => 'Admin deleted Successfully!',
         ]);
      } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
     }
     public function editAdmin(Request $req, $id){
      try{
      $admin =  Admin::find($id);
      $inputs= $req->all();
      $admin->update($inputs);
      return response()->json([
          'message' => 'Admin edited successfully!',
          'Admin' => $admin,
      ]);
   } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
  }

}