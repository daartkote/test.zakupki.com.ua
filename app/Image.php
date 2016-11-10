<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    const TYPE_USER = 1;
    const TYPE_PRODUCT = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'file_name',
        'type',
        'model_id'
    ];

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return public_path('img') . '/';
    }

    public function getPath()
    {
        return 'img/' . $this->file_name;
    }
}
