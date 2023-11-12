<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['story_id', 'url'];

    // Relationship with Story
    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}

?>