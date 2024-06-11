<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model
{
    use HasFactory;
     protected $table = 'menu_groups';
    protected $fillable = ['name', 'permission_name', 'icon', 'position'];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
