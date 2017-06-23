<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiSportsController extends Controller
{

  public function index(Request $request){
    $search = $request->query()?$request->query()['search']:"";

    return DB::table('sports')
      ->where('name', 'like', $search.'%')
      ->get();
  }

  public function show($id){
    $sport = DB::table('sport')
      ->where('id', $id)
      ->first();
    return response()->json($sport);
  }

  public function store(Request $request){
    $doc = $request->all(); //data from Form obj State
    DB::table('sport')->insert($doc); //insert with query builder
  }

  public function update(Request $request, $id){
    $doc = $request->all();
    DB::table('sport')
      ->where('id', $id)
      ->update($doc);

      return response()->json("success");
  }

  public function destroy($id){
    return response()->json("delete sport with id= ". $id);
  }

   public function __construct(){
             $this->middleware('jwt.auth');
         }
}
