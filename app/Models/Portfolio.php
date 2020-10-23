<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = ['link'];

    public static $rules = ['link' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'];
    public static $messages = ['link.*' => "Url Inválida"];

    public function dono(){
        return $this->belongsTo('App\Models\Candidato','candidato_id');
    }
}
