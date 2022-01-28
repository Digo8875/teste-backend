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
        return Link::where('id_user', '=', auth()->user()->id)->get();
    }

    public function getLinkById($id)
    {
        return Link::findOrFail($id);
    }

    public function updateLink($link_details, Link $link)
    {
        foreach ($link_details as $key => $value) {
            $link->$key = $value;
        }

        return $link->save();
    }

    public function deleteLink(Link $link)
    {
        return $link->delete();
    }

    public function getLinkBySlug($slug, $return_type = 'fail')
    {
        if ($return_type == 'fail')
            return Link::where('slug', '=', $slug)->withTrashed()->firstOrFail();
        else
            return Link::where('slug', '=', $slug)->withTrashed()->first();
    }

    public function incrementLinkAccess($id)
    {
        $link = Link::findOrFail($id);

        $link->accesses = $link->accesses + 1;

        return $link->save();
    }
}
