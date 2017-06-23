<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Field;
use Response;

class ApiFieldsController extends Controller
{

  //** Show All fields

    public function index(Request $request)
    {
        $search_term = $request->input('search');
        $limit = $request->input('limit')?$request->input('limit'):999;

        if ($search_term)
        {
            $fields = Field::orderBy('id', 'DESC')->where('name', 'LIKE', "%$search_term%")->with(
            array('User'=>function($query){
                $query->select('id','email');
            })
            )->select('id', 'name', 'user_id')->paginate($limit);

            $fields->appends(array(
                'search' => $search_term,
                'limit' => $limit
            ));
        }
        else
        {
            $fields = Field::orderBy('id', 'DESC')->with(
            array('User'=>function($query){
                $query->select('id','email');
            })
            )->select('id', 'name', 'user_id')->paginate($limit);

            $fields->appends(array(
                'limit' => $limit
            ));
        }

        return Response::json($this->transformCollection($fields), 200);
    }

  //** Show single field

  public function show($id)
      {
          $field = Field::with(
              array('User'=>function($query){
                  $query->select('id','email');
              })
              )->find($id);

          if(!$field){
              return Response::json([
                  'error' => [
                      'message' => 'Field does not exist'
                  ]
              ], 404);
          }

           // get previous field id
          $previous = Field::where('id', '<', $field->id)->max('id');

          // get next field id
          $next = Field::where('id', '>', $field->id)->min('id');

          return Response::json([
              'previous_field_id'=> $previous,
              'next_field_id'=> $next,
              'data' => $this->transform($field)
          ], 200);
      }

  //** Create field

  public function store(Request $request)
        {

            if(! $request->name or ! $request->user_id){
                return Response::json([
                    'error' => [
                        'message' => 'Please Provide Both name and user_id'
                    ]
                ], 422);
            }
            $field = Field::create($request->all());

            return Response::json([
                    'message' => 'Field Created Succesfully',
                    'data' => $this->transform($field)
            ]);
        }

  //** edit field

    public function update(Request $request, $id)
        {
            if(! $request->name or ! $request->user_id){
                return Response::json([
                    'error' => [
                        'message' => 'Please Provide Both name and user_id'
                    ]
                ], 422);
            }

            $field = Field::find($id);
            $field->name = $request->name;
            $field->user_id = $request->user_id;
            $field->save();

            return Response::json([
                    'message' => 'Field Updated Succesfully'
            ]);
        }

  //** delete field

  public function destroy($id)
    {
      Field::destroy($id);
    }


  //** Format String

  private function transformCollection($fields){
        $fieldsArray = $fields->toArray();
        return [
            'total' => $fieldsArray['total'],
            'per_page' => intval($fieldsArray['per_page']),
            'current_page' => $fieldsArray['current_page'],
            'last_page' => $fieldsArray['last_page'],
            'next_page_url' => $fieldsArray['next_page_url'],
            'prev_page_url' => $fieldsArray['prev_page_url'],
            'from' => $fieldsArray['from'],
            'to' =>$fieldsArray['to'],
            'data' => array_map([$this, 'transform'], $fieldsArray['data'])
        ];
    }

  private function transform($field){
          return [
                  'field_id' => $field['id'],
                  'field' => $field['name'],
                  'submitted_by' => $field['user']['email']
          ];
      }


  public function __construct(){
            $this->middleware('jwt.auth');
        }

}
