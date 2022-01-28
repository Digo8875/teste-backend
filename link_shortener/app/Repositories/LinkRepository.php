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

    public function getAllLinks()
    {
        return Link::all();
    }

    public function getLinkById($id)
    {
        return Link::findOrFail($id);
    }

    public function updateLink($link_details, $id)
    {
        $link = Link::findOrFail($id);

        foreach ($link_details as $key => $value) {
            $link->$key = $value;
        }

        return $link->save();
    }
}
