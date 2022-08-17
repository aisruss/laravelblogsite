<?php

namespace App\Refineries;

use Michaeljennings\Refinery\Refinery;

class BlogComments extends Refinery
{

    /**
     * Set the template the refinery will use for each item passed to it
     *
     * @param mixed $item
     * @return mixed
     */
    protected function setTemplate($blogComments)
    {
        return [
          'comment' => $blogComments->comment,
          'submitted_by' => $blogComments->submitted_by->name,
          'created_at' => $blogComments->created_at
        ];

    }
}