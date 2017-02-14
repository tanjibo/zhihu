<?php
namespace App\Repositories;
use App\Question;
use App\Topic;

/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 2017/2/10
 * Time: 上午10:59
 */

class QuestionRepository{



    /**
     * 获取展示数据
     */
    public function getShowData($id){
//        return Question::where('id',$id)->with(['topics','answer'])->first();
        return  Question::with(['topics','answer'])->findOrFail( $id );
    }


    /**
     * @param array $data
     *
     * @return array 获取中间表数据
     */
    public function getRelationData(Array $data){

       return  collect($data)->map( function ( $topic ) {
            if (is_numeric( $topic )) {

                $obj = Topic::find( $topic );
                if ($obj) {
                    $obj->increment( 'questions_count' );
                }

                return $topic;
            }
            $topic = Topic::create( [ 'name' => $topic, 'questions_count' => 1 ] );

            return $topic->id;
        } )->toArray();
    }


    /**
     * @param $data
     *
     * @return static 添加一个问题
     */
    public function addQuestion($data){
        return Question::create( $data );
    }

    public function getAll(){
      return Question::with('user')->get();
    }
}