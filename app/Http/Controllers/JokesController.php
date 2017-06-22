<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Joke;
use Response;

class JokesController extends Controller
{

  //** Show All Jokes

    public function index(Request $request)
    {
        $search_term = $request->input('search');
        $limit = $request->input('limit')?$request->input('limit'):999;

        if ($search_term)
        {
            $jokes = Joke::orderBy('id', 'DESC')->where('body', 'LIKE', "%$search_term%")->with(
            array('User'=>function($query){
                $query->select('id','email');
            })
            )->select('id', 'body', 'user_id')->paginate($limit);

            $jokes->appends(array(
                'search' => $search_term,
                'limit' => $limit
            ));
        }
        else
        {
            $jokes = Joke::orderBy('id', 'DESC')->with(
            array('User'=>function($query){
                $query->select('id','email');
            })
            )->select('id', 'body', 'user_id')->paginate($limit);

            $jokes->appends(array(
                'limit' => $limit
            ));
        }

        return Response::json($this->transformCollection($jokes), 200);
    }

  //** Show single Joke

  public function show($id)
      {
          $joke = Joke::with(
              array('User'=>function($query){
                  $query->select('id','email');
              })
              )->find($id);

          if(!$joke){
              return Response::json([
                  'error' => [
                      'message' => 'Joke does not exist'
                  ]
              ], 404);
          }

           // get previous joke id
          $previous = Joke::where('id', '<', $joke->id)->max('id');

          // get next joke id
          $next = Joke::where('id', '>', $joke->id)->min('id');

          return Response::json([
              'previous_joke_id'=> $previous,
              'next_joke_id'=> $next,
              'data' => $this->transform($joke)
          ], 200);
      }

  //** Create Joke

  public function store(Request $request)
        {

            if(! $request->body or ! $request->user_id){
                return Response::json([
                    'error' => [
                        'message' => 'Please Provide Both body and user_id'
                    ]
                ], 422);
            }
            $joke = Joke::create($request->all());

            return Response::json([
                    'message' => 'Joke Created Succesfully',
                    'data' => $this->transform($joke)
            ]);
        }

  //** edit Joke

    public function update(Request $request, $id)
        {
            if(! $request->body or ! $request->user_id){
                return Response::json([
                    'error' => [
                        'message' => 'Please Provide Both body and user_id'
                    ]
                ], 422);
            }

            $joke = Joke::find($id);
            $joke->body = $request->body;
            $joke->user_id = $request->user_id;
            $joke->save();

            return Response::json([
                    'message' => 'Joke Updated Succesfully'
            ]);
        }

  //** delete Joke

  public function destroy($id)
    {
      Joke::destroy($id);
    }


  //** Format String

  private function transformCollection($jokes){
        $jokesArray = $jokes->toArray();
        return [
            'total' => $jokesArray['total'],
            'per_page' => intval($jokesArray['per_page']),
            'current_page' => $jokesArray['current_page'],
            'last_page' => $jokesArray['last_page'],
            'next_page_url' => $jokesArray['next_page_url'],
            'prev_page_url' => $jokesArray['prev_page_url'],
            'from' => $jokesArray['from'],
            'to' =>$jokesArray['to'],
            'data' => array_map([$this, 'transform'], $jokesArray['data'])
        ];
    }

  private function transform($joke){
          return [
                  'joke_id' => $joke['id'],
                  'joke' => $joke['body'],
                  'submitted_by' => $joke['user']['email']
          ];
      }


  public function __construct(){
            $this->middleware('jwt.auth');
        }

}
