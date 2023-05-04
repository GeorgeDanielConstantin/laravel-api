<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'image', 'text', 'type_id'];


    public function getPlaceholder(){
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : "https://placehold.co/600x400";
    }

    public function getAbstract($max = 150){
        return substr($this->details, 0, $max) . "[...]";
    }

    public function getAbstractIndex($max = 50){
        return substr($this->details, 0, $max) . "...";
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    
}
