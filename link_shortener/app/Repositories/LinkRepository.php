<?php

namespace App\Repositories;

use App\Models\Link;
use App\Models\Accessor;

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

    public function deleteLink($id)
    {
        $link = Link::findOrFail($id);

        return $link->delete();
    }

    public function getLinkBySlug($slug)
    {
        return Link::where('slug', '=', $slug)->firstOrFail();
    }

    public function incrementLinkAccess($id)
    {
        $link = Link::findOrFail($id);

        $link->accesses = $link->accesses + 1;

        return $link->save();
    }
}
