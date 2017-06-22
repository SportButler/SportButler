<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

  public function index(Request $request){
    $search = $request->query()?$request->query()['search']:"";

    return DB::table('question')
      ->where('title', 'like', $search.'%')
      ->orwhere('description', 'like', $search.'%')
      ->get();
  }

  public function show($id){
    $question = DB::table('question')
      ->where('id', $id)
      ->first();
    return response()->json($question);
  }

  public function store(Request $request){
    $doc = $request->all(); //data from Form obj State
    DB::table('question')->insert($doc); //insert with query builder
  }

  public function update(Request $request, $id){
    $doc = $request->all();
    DB::table('question')
      ->where('id', $id)
      ->update($doc);

      return response()->json("success");
  }

  public function destroy($id){
    return response()->json("delete question with id= ". $id);
  }

  // public function __construct(){
  //           $this->middleware('jwt.auth');
  //       }
}
