<?php

namespace App\Persisters;

use App\Contracts\Repositories\BlogComments as BlogCommentsRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogComments;

class BlogComments
{
    /**
     * @var BlogCommentsRepository
     */
    protected $blogComments;

    /**
     * @var DatabaseManager
     */
    protected $db;

    public function __construct(BlogCommentsRepository $blogComments, DatabaseManager $db)
    {
        $this->blogComments = $blogComments;
        $this->db = $db;
    }

    public function persist(Request $request, $id)
    {

        //dd($request);
        $this->db->beginTransaction();

        $blogComments = $this->create($request, $id);

        $this->db->commit();

        return $blogComments;
    }

    protected function create(Request $request, $id)
    {
        try {
            $data = $this->getData($request);

            return $this->blogComments->create($data + ['submitted_by_id' => auth()->id(),
                                                         'blog_id' => $id]);
        } catch (\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    protected function getData(Request $request): array
    {
        $attributes =  $request->all();

        return $attributes;
    }
}