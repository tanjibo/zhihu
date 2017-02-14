<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 2017/2/13
 * Time: 下午4:37
 */

namespace App\Repositories;


use App\Answer;

class AnswerRepository
{

    public function createAnswer(array $data){

       return Answer::create($data);
    }
}