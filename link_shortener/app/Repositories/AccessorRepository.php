<?php

namespace App\Repositories;

use App\Models\Accessor;

class AccessorRepository
{
    public function createAccessor($id_link)
    {
        $details = [
            'ip' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'id_link' => $id_link
        ];

        return Accessor::create($details);
    }
}
