<?php

namespace App\Refineries;

use Michaeljennings\Refinery\Refinery;

class Blog extends Refinery
{
    /**
     * Set the template the refinery will use for each item passed to it
     *
     * @param mixed $user
     * @return mixed
     */
    protected function setTemplate($blog)
    {
        return [
            'id' => $blog->id,
            'author' => $blog->author->name,
            'content' => $blog->content,
            'title' => $blog->title,
            'updated_at' => $blog->updated_at,
        ];
    }

    public function blogComments()
    {
        return $this->attach(BlogComments::class);
    }

}
