<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// code employer
class Location extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'location_id';
    public $timestamps = false;
}