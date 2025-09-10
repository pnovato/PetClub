<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name','species','sex','age_years','size','image',
        'description','status','adopted_by','adopted_at'
    ];

    protected $casts = [
        'adopted_at' => 'datetime',
    ];

    // Relação com User (adotante)
    public function adopter()
    {
        return $this->belongsTo(User::class, 'adopted_by');
    }

    // Escopo: apenas disponíveis
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}
