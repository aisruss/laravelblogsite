<?php

namespace App\Repositories\Eloquent;

use App\BlogComments as BlogCommentsModel;
use Illuminate\Support\Collection;

class BlogComments implements \App\Contracts\Repositories\BlogComments
{
    protected $model;

    /**
     * @param BlogCommentsModel $
     */
    public function __construct(BlogCommentsModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function create(array $request)
    {
        return $this->model->create($request);
    }

}