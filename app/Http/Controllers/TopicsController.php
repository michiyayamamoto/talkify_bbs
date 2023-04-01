<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Comment;
use App\Http\Requests\CreateTopicRequest;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics     = Topic::latest()->get();
        $context    = [ "topics" => $topics ];
        
        return view("index",$context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTopicRequest $request)
    {
        Topic::create($request->all());
        return redirect(route("topics.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic      = Topic::where("id",$id)->first();
        #ここでコメントされている内容を抜き取る
        $comments   = Comment::where("topic_id",$id)->orderBy("created_at","desc")->get();
        $context    = [ "topic" => $topic,
                    "comments" => $comments];
    return view("show",$context);
    
        // ↓は過去verトピックのみ表示
        // $context            = []; 
        // $context["topics"]  = Topic::where("id",$id)->get();
        // return view("show",$context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topics     = Topic::where("id",$id)->get();
        $context    = [ "topics" => $topics ];

        return view("edit",$context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTopicRequest $request, $id)
    {
        #編集処理のベストプラクティス
        Topic::find($id)->update($request->all());

        #HACK:このやり方ではモデルフィールドが増えると対処しきれない。
        /*
        $topic  = Topic::find($id);
        $topic->name    = $request->name;
        $topic->content = $request->content;
        $topic->save();
        */

        return redirect(route("topics.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        #削除のベストプラクティス
        Topic::destroy($id);

        #HACK:もっと短く書ける
        #Topic::find($id)->delete();

        #HACK:deleteメソッドはつなげ書いても良い。
        /*
        $topic  = Topic::find($id);
        $topic->delete();
        */

        return redirect(route("topics.index"));
    }
    public function comment(CreateTopicRequest $request, $id)
    {
        Comment::create(array_merge( $request->all(), ["topic_id"=>$id] ));
        #↑と↓は等価
    
        /*
        $comment  = new Comment;

        $comment->name      = $request->name;
        $comment->content   = $request->content;
        $comment->topic_id  = $id;
        $comment->save();
        */
        \Log::debug("投稿完了");
    
        return redirect(route("topics.show",$id));
    }
    
    
}
