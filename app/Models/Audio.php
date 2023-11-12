<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audio extends Model
{
    use HasFactory;
    protected $table = 'audios';  // Explicitly set the table name
    protected $fillable = ['story_id', 'file_path'];

    // Relationship with Story
    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}

?>