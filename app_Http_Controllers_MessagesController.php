<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Validator;
use App\Category;
use Auth;
class MessagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $messages = Message::where('id', '>=', 1)->orderBy('id', 'desc')->paginate(10);  
        return view('message.index', compact('messages'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('message.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer|between:1,5',
            'title' => 'required|string|max:50',
            'body' => 'required|string|max:500'
        ]);
        if ($validator->fails()) {
            return redirect('messages/create')->withErrors($validator)->withInput();
        }
        $message = new Message();
        // 認証済ユーザーIDを入れる
        $message->user_id = Auth::id();
        $message->category_id = $request->category_id;
        $message->title = $request->title;
        $message->body = $request->body;
        $message->save();
        return redirect('messages');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('message.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        $categories = Category::all();
        return view('message.edit', compact('message', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer|between:1,5',
            'title' => 'required|string|max:50',
            'body' => 'required|string|max:500'
        ]);
        // 認証済ユーザーのメッセージでない場合
        if($message->user_id !== Auth::id()){
            $validator->errors()->add('field', 'field id');
            return redirect("messages/{$message->id}/edit")->withErrors($validator);
        }
        if ($validator->fails()) {
            return redirect("messages/{$message->id}/edit")->withErrors($validator);
        }
        $message->fill($request->except(['_token', '_method']))->save();
        return redirect('messages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $validator = Validator::make([], []);
        // 認証済ユーザーのメッセージか
        if($message->user_id === Auth::id()){
            $message->delete();
        }else{
            $validator->errors()->add('field', 'field id');
        }      
        return redirect()->route('messages.index')->withErrors($validator);
    }
}
