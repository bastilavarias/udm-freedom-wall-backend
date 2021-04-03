<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleType extends Model
{
    use HasFactory;

    protected $table = "people_types";

    protected $hidden = ["deleted_at"];

    protected $fillable = ["label", "description"];
}
