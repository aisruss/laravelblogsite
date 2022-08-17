<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface BlogComments
{
    public function create(array $request);

}