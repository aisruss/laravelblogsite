<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\BlogComments;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogComments;
use App\Persisters\BlogComments as BlogCommentsPersister;

class BlogCommentsController extends Controller
{

//    public function store(BlogComments $blogComments, $id)
//    {
//        $attributes = $this->validateBlogComment();
//        $blogComments->create($attributes + ['submitted_by_id' => auth()->id(),
//                                             'blog_id' => $id]);
//
//        return back();
//    }

    /**
     * @param StoreBlogComments $request
     * @param BlogCommentsPersister $persister
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBlogComments $request, BlogCommentsPersister $persister, $id)
    {
//        dd($request);
        $blogComments = $persister->persist($request, $id);

        //$attributes = $this->validateBlogPost();
        //$blog = $blogRepository->create($attributes + ['author_id' => auth()->id()]);

        return back();
    }




    /**
     * @return mixed
     */
    public function validateBlogComment()
    {
        return request()->validate([
            'comment' => ['required','min:3','max:250'],
        ]);
    }
}
