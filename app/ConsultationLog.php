<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultationLog extends Model
{
    protected $table = 'consultation_logs';

    protected $fillable = ['user_id', 'consultation_id', 'name', 'excerpt', 'text'];

    /**
     * Relations
     * 
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
