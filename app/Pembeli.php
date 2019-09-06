<?php
  
namespace App;
  
use Illuminate\Database\Eloquent\Model;
   
class Pembeli extends Model
{
    protected $table = 'pembeli';
    protected $fillable = [
        'nama_pembeli', 'detail'
    ];
    protected $primaryKey = 'id_pembeli';
}