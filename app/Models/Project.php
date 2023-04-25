<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'image', 'text'];

    public function getPlaceholder(){
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : "https://placehold.co/600x400";
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    
}
