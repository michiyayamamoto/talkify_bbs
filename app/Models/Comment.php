<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     protected $fillable = [ "name","content","topic_id" ];

     public function topic()
     {
         return $this->belongsTo(Topic::class);
     }
}