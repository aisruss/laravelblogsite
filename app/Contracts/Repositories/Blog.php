<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface Blog
{
    public function all() : Collection;

    public function show($id);

    public function create(array $request);

    public function update(array $request, $id);

    public function find($id);

}