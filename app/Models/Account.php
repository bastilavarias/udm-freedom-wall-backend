<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "accounts";

    protected $hidden = ["password", "deleted_at"];

    protected $fillable = ["name", "username", "password"];
}
