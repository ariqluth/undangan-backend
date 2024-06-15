<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use App\Models\User;
use App\Models\KategoriArtikel;

class Items extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
    	'user_id',
        'nama_item',
        'gambar',
       
    ];

    public function profile()
    {
    	return $this->belongsTo(Profiles::class);
    }

   


}
