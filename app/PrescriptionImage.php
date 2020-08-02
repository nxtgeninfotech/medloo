<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PrescriptionImage extends Model
{
    protected $fillable = [
        'user_id',
        'image',
        'is_default'
    ];

    protected $casts = [
        'created_at' => 'date',
        'is_default' => 'boolean'
    ];

    public $timestamps = false;


    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    public function ScopeImageAttribute($value)
    {
        return 'uploads/prescription' . $value;
    }

    public function ScopeMyPrescription($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public static function ScopeIsDefault($query)
    {
        return $query->where('is_default', true);
    }

}
