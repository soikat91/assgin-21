<?php

namespace App\Http\Controllers;


use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    function getTodoList(Request $request){

        $id=$request->header('id');
        return TodoList::where('userId','=',$id)->get();
        //return DB::table('todo_lists')->where('userId','=',$id)->get();

        // return response()->json([
            
        //     'status'=>'success',
        //     'message'=>''
        // ])
    }

    function createList(Request $request){

        $userId=$request->header('id');
        return TodoList::create([
            'title'=>$request->title,
            'userId'=>$userId
        ]);

    }
    function updateList(Request $request){

        $id=$request->input('id');
        $userId=$request->header('id');
        return TodoList::where('id',$id)->where('userId',$userId)->update([
            'title'=>$request->title
        ]);
    }

    function deleteList(Request $request){

        $id=$request->input('id');
        $userId=$request->header('id');
        return TodoList::where('id',$id)->where('userId',$userId)->delete();
    }
}
