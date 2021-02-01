<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';

    public function blogs() {
        return $this->hasMany(
                        Blog::class,
                        'user_id',
                        'id',
        );
    }

    public function getPhotoUrl() {
        if ($this->photo) {
            return url('/storage/blogs/' . $this->photo1);
        }

        return url('/themes/front/img/avatar-1.jpg');
    }

}
