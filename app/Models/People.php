<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PeopleType;

class People extends Model
{
    use HasFactory;

    protected $table = "people";

    protected $hidden = ["deleted_at", "type_id"];

    protected $fillable = ["name", "type_id"];

    public function type()
    {
        return $this->hasOne(PeopleType::class, "id", "type_id");
    }
}
