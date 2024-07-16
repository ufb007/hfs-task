<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'article_id', 'vote'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
