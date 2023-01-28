<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        "service_id", "method_id", "end_point_id", "protocol_id", "output_date_time", "status_code"
    ];

    public function method() {
        return $this->hasOne(Method::class);
    }
    public function protocol() {
        return $this->hasOne(Protocol::class);
    }
    public function service() {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
    public function end_point() {
        return $this->hasOne(EndPoint::class);
    }
}
