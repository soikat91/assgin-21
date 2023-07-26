<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    function getTodoList(Request $request){

        $id=$request->header('id');
        return TodoList::where('userId','=',$id)->get();       
    }

    function createList(Request $request){
    
     try{
        $userId=$request->header('id');
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:55'                   
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $todo=TodoList::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'userId'=>$userId,
        ]);

        return response()->json([
            'status'=>"success",
            'message'=>"Todo Created Successfully",
            "data"=>$todo
        ],201);
     }catch(Exception $e){
        return response()->json([
            'status'=>"failed",
            'message'=>"Something Went Wrong"
           
        ],400);
     }   
       

    }
    function updateList(Request $request){

        try{
           
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:55'                       
            ]);    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }            
            $id=$request->input('id');
            $userId=$request->header('id');
         
             $updateTodoList=TodoList::where('id',$id)->where('userId',$userId)->update([
                    'title'=>$request->title,
                    'description'=>$request->description
                ]);
                if($updateTodoList){
                    return response()->json([
                        'status'=>"success",
                        'message'=>"Todo Updated Successfully",
                        
                    ],200);             
               
            }else{

                return response()->json([
                    'status' => 'failed',
                     'message' =>'Data Not found'
                    ], 404);

            }
            
        }catch(Exception $e){

            return response()->json([
                'status'=>"failed",
                'message'=>"Something Went Wrong"
               
            ]);
        }
    }

    function deleteList(Request $request){

        try{
            $id=$request->input('id');
            $userId=$request->header('id');
            if( TodoList::where('id',$id)->where('userId',$userId)->delete() ){
                return response()->json([
                    'status'=>"success",
                    'message'=>"Todo Delete Successfully",
                    
                ],200);
            }else{
                return response()->json([
                    'status' => 'failed',
                     'message' =>'Data Not found'
                    ], 404);                
            }         

        }catch(Exception $e){

            return response()->json([
                'status'=>"failed",
                'message'=>"Something Went Wrong"
               
            ]);
        }
       
    }
}
