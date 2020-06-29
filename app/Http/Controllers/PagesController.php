<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Mail;
use Session;

class PagesController extends Controller
{
	public function getIndex(){
		$posts = Post::orderBy('updated_at', 'desc')->take(9 )->get();
		return view('pages.welcome')->withPosts($posts);
	}
	public function getAbout(){
		$first = "Michael";
		$last = "Richey";

		$fullname = $first." ".$last; 

		return view('pages.about')->with('fullname', $fullname);
	
 		return view('pages.contact');
		
	}

    public function getContact()
    {
    	return view('pages.contact');
    }

	public function postContact(Request $request)
	{
		$this->validate($request, [
			'email'=>'required|email',
			'subject'=>'min:10',
			'message'=>'min:10'
		]);

		$data = array(
			'email'=> $request->email,
			'subject'=>$request->subject,
			'bodyMessage'=>$request->message,
		);


		$to=[
			'name'=>'derichey9@gmail.com',
			'email'=>'derichey9@gmail.com',

			];

		
		Mail::to([$to])->send('emails.contact', $data, function($message) use($data){
			$message->form($data['email']);
			$message->to('derichey9@gmail.com');
			$message->subject($data['subject']);

		});

		Session::flash('success', 'Email Sent Successfully !!');

		return redirect()->url('/');
	}

}
 