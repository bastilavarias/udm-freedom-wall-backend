<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = "messages";

    protected $hidden = ["deleted_at"];

    protected $fillable = ["text", "people_id"];

    public function people()
    {
        return $this->hasOne(People::class, "id", "people_id");
    }
}
