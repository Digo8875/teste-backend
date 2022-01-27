<?php

namespace App\Repositories;

use App\Models\Link;

class LinkRepository
{
    public function newLink()
    {
        return new Link;
    }

    public function createLink($link_details)
    {
        return Link::create($link_details);
    }
}
