<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Session;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
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
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('posts.index')->withPosts($posts); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        //validate
        $this->validate($request, array(
            'title' =>'required|max:255',
            'slug'  =>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' =>'required|integer',
            'body'  =>'required',
            'featured_image'  =>'sometimes|image',
        )); 
        //store in db

        $post = new Post;  

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = clean($request->body);

        //save new image
         if ($request->hasFile('featured_image')) {
          $image = $request->file('featured_image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->resize(800, 400)->save($location);
          $post->image = $filename;
        }
        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'Post Uploaded Successfully');
 
        //redirect 
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $post= Post::find($id);
        
             $this->validate($request, array(
            'title'=>'required|max:255',
            'slug'=>"required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'category_id'=>'required|integer',
            'body'=>'required',
            'featured_image'=>'image',


             ));
        
        //Validate data
         

        //save data to db
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = clean($request->input('body'));

        if ($request->hasFile('featured_image')) {
            //add the new photo

             if ($request->hasFile('featured_image')) {
          $image = $request->file('featured_image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->resize(800, 400)->save($location);
          $oldfileName = $post->image;

            //update the old photo
            $post->image = $filename;
            //delete the new photo
            Storage::delete($oldfileName);
        }

        $post->save();


        if (isset($request->tags)) {
        $post->tags()->sync($request->tags);    
        }else{
        $post->tags()->sync(array());               
        }
        //set flash with success
        Session::flash('success', 'Update was successful !' );
        //redirect with flash to show
        return redirect()->route('posts.show',$post->id);
    }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);
      $post->tags()->detach();
      Storage::delete($post->image);
      $post->delete();

      Session::flash('success', 'Post deleted sucessfully');
      return redirect()->route('posts.index');   
    }
}


