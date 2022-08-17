<?php

namespace App\Repositories\Eloquent;

use App\Blog as BlogModel;
use Illuminate\Support\Collection;

class Blog implements \App\Contracts\Repositories\Blog
{
    protected $model;

    public function __construct(BlogModel $model)
    {
        $this->model = $model;

    }

    public function all() : Collection
    {
        return $this->model->all();
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function create(array $request)
    {
        return $this->model->create($request);
    }

    /**
     * @param array $request
     * @param $id
     * @return mixed
     */
    public function update(array $request, $id)
    {
        $recordToUpdate = $this->model->findOrFail($id);
        return $recordToUpdate->update($request);

    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}