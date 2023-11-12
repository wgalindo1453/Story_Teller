<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    // Relationship with Image
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // Relationship with Audio
    public function audios()
    {
        return $this->hasMany(Audio::class);
    }
}

?>