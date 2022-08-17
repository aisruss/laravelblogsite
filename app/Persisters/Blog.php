<?php

namespace App\Persisters;

use App\Contracts\Repositories\Blog as BlogRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlog;

class Blog
{
    /**
     * @var BlogRepository
     */
    protected $blog;

    /**
     * @var DatabaseManager
     */
    protected $db;

    public function __construct(BlogRepository $blog, DatabaseManager $db)
    {
        $this->blog = $blog;
        $this->db = $db;
    }

    public function persist(Request $request, $blog = null)
    {

        //dd($request);
        $this->db->beginTransaction();

        if ($blog) {
            $blog = $this->update($blog, $request);
        } else {
            $blog = $this->create($request);
        }

        $this->db->commit();

        return $blog;
    }

    protected function create(Request $request)
    {
        try {
            $data = $this->getData($request);


            return $this->blog->create($data + ['author_id' => auth()->id()]);
        } catch (\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    protected function update($blog, Request $request)
    {
        try {
            return $this->blog->update(
                $this->getData($request),
                $blog->id
            );
        } catch (\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }


//    protected function update($blog, Request $request)
//    {
//        try {
//            return $this->blog->update(
//                $blog->id,
//                $this->getData($request)
//            );
//        } catch (\Exception $e) {
//            $this->db->rollback();
//            throw $e;
//        }
//    }

    protected function getData(Request $request): array
    {
        $attributes =  $request->all();

        return $attributes;
    }
}