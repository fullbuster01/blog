<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    

    // ini relasi many to many untuk tabel post_tag
    public function posts()
    {
        return $this->BelongsToMany(Post::class);
    }
}
