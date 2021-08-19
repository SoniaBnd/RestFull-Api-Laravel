<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\Comment;
use App\Models\User;
use Validator;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CommentController extends BaseController
{
	
	 public function index(Request $request)
    {
        $comments = Comment::all();
		
			return view('comments.list', [
		   'comments' =>Comment::all()
		]);
		
    }
	
	
	public function show($ticket_id)
    {
		$comments = DB::table('comments')
            ->where('approved', 1)
            ->where('ticket_id', $ticket_id)
            ->get();
        return $this->sendResponse($comments, 'Comments of ticket $ticket_id fetched.');
    }
	
    public function store(Request $request, $ticket_id)
    {
		$comment= new Comment();
        $input = $request->all();
		$authUser = Auth::user();
		$comment->comment= $request->input('comment');
		$comment->author_id= $authUser->id;
		$comment->author_name= $authUser->name;
		$comment->approved= false;
		$ticket = Ticket::find($ticket_id);
        $validator = Validator::make($input, [
            'comment' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
       
		$ticket->comment()->save($comment);
        return $this->sendResponse($comment, 'Comment created.');
    }
	
	
	public function update(Request $request, Comment $comment)
    {
	 $input = $request->all();

        $validator = Validator::make($input, [
            'comment' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $comment->approved = 1;
        $comment->comment = $input['comment'];
        $comment->save();
        if ($request->wantsJson()) 
           return $this->sendResponse($comment, 'Comment updated.');
	    else 
		{
			$request->session()->flash('status', 'Comment was approved successfully');
		    return redirect()->route('listcomment');
		}
    }  
	
	public function destroy(Comment $comment)
    {
        $comment->delete();
        return $this->sendResponse([], 'Comment deleted.');
    }
}
