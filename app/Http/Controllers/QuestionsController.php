<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionCreate;
use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{

    protected $questionRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(QuestionRepository $repository)
    {
        $this->middleware('auth',['expect'=>['index','show']]);
        $this->questionRepository=$repository;
    }



    public function index()
    {
        $questions= $this->questionRepository->getAll();

       return view('questions.index',compact('questions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'questions.publish' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( QuestionCreate $request )
    {

//        $rules=[
//            'title'=>"required|min:10|max:20",
//            'body'=>"required|min:10",
//
//        ];
//        $message=[
//          'title.required'=>'标题不能为空',
//            'title.min'=>'标题最小长度为10',
//            'title.min'=>'标题最大长度为20',
//            'body.required'=>'正文不能为空',
//            'body.min'=>'正文最小为10',
//        ];
//        $this->validate($request,$rules,$message);
         $relationData=$this->questionRepository->getRelationData($request->get('topics'));

        $data = [
            'user_id' => Auth::id(),
            'title'   => $request->get( 'title' ),
            'body'    => $request->get( 'body' )
        ];


       $question= $this->questionRepository->addQuestion($data);

        $question->topics()->attach( $relationData );

        return redirect()->route( 'questions.show', [ $question->id ] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $question = $this->questionRepository->getShowData($id);
        return view( 'questions.show', compact( 'question') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question=$this->questionRepository->getShowData($id);

         //判断问题发布的人和登陆的是不是同一个人
        if(!Auth::user()->owner($question)) redirect()->route('questions.create');

       return view('questions.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update( QuestionCreate $request, $id )
    {


        $question= $this->questionRepository->getShowData($id);


       $relationData=$this->questionRepository->getRelationData($request->get('topics'));


        $question->update(['title'=>$request->get('title'),'body'=>$request->get('body')]);

        $question->topics()->sync($relationData);

        return redirect()->route('questions.show',[$question->id]);




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        //
    }
}
