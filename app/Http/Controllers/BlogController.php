<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Contracts\Repositories\Blog as BlogRepository;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlog;
use App\Persisters\Blog as BlogPersister;

class BlogController extends Controller
{
    /**
     * @var \App\Contracts\Repositories\BlogRepository
     */
    private $blog;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->middleware('auth');
        $this->repository = $blogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param BlogRepository $blog
     * @return \Illuminate\Http\Response
     */
    public function index(\App\Refineries\Blog $blogRefinery)
    {
        $blogRepo = $this->repository->all();
        $blog = $blogRefinery->refine($blogRepo);

        //dd($blog);
        return view('blog.index', [
            'blogs' => $blog, //This returns data being grabbed from the repo.
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.form', [
            'title' => 'Create Post',
            'method' => 'POST',
            'action' => route('blog.create'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogRepository $blogRepository
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @internal param BlogRepository $blog
     */
    public function store(StoreBlog $request, BlogPersister $persister)
    {
//        dd($request);
        $blog = $persister->persist($request);

      //$attributes = $this->validateBlogPost(); storeblog handles validation before it enters here
      //$blog = $blogRepository->create($attributes + ['author_id' => auth()->id()]);

        return redirect('/blog');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Refineries\Blog $blogRefinery, $id)
    {
        $blog = $this->repository->show($id);
        $blog = $blogRefinery->bring(['blogComments'])->refine($blog);

        return view('blog.show', [
            'blog' => $blog,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = $this->findOrAbort($id);
        $this->authorize('update', $blog);

//        return view ('blog.edit', compact('blog'));

        return view('blog.form', [
            'blog' => $blog,
            'title' => 'Update Post',
            'method' => 'PUT',
            'action' => route('blog.update', [$id]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param BlogRepository $blogRepository
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Blog|BlogRepository $blog
     */
//    public function update(Request $request, BlogRepository $blogRepository, $id)
//    {
//        $blogRepository->update($this->validateBlogPost(), $id);
//
//        return redirect('/blog');
//    }

    /**
     * @param $id
     * @param StoreBlog $request
     * @param BlogPersister $persister
     */
    public function update($id, StoreBlog $request, BlogPersister $persister)
    {
        $blogRecord = $this->findOrAbort($id);

        if ( ! $blogRecord) {
            abort(404);
        }

        $blogRecord = $persister->persist($request, $blogRecord);
        return redirect('/blog');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }

//    public function validateBlogPost()
//    {
//        return request()->validate([
//            'title' => ['required','min:3','max:250'],
//            'content' => ['required','min:3'],
//        ]);
//    }

    protected function findOrAbort($id)
    {
        $blog = $this->repository->find($id);

        if ( ! $blog) {
            abort(404);
        }

        return $blog;
    }
}
