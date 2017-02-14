<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AnswerRepository;

class AnswerController extends Controller
{
    protected $answerRepo;

    public function __construct(AnswerRepository $answerRepo)
    {
        $this->answerRepo=$answerRepo;
    }

    public function store(Request $request,$question_id)
    {
        $data=[
            'question_id'=>$question_id,
            'body'=>$request->get('body'),
            'user_id'=>Auth::id()
        ];

       $answer= $this->answerRepo->createAnswer($data);
       $answer->question()->increment('answers_counts');
        return back();
    }
}
