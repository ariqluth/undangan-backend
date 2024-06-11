<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignApprove extends Model
{
    use HasFactory;

    protected $table = 'assign_approve';

    protected $fillable = [
        'kbli_perusahaan_id',
        'assign_to',
        'status',
        'approve_by',
        'approve_at',
        'kbli_perusahaan_json',
        'gambar_kbli_perusahaan_json',
        'data_terhapus',
        'delete_by',
        'delete_at',
        'updated_at',
        'updated_by',
        'created_by',
    ];

    public function kbli_perusahaan()
    {
        return $this->belongsTo(KbliPerusahaan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
