<?php

namespace App\Models;

use App\Traits\SetTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory,SetTrait;
    protected $table = 'files';
    protected $fillable = ['user_id', 'filename', 'document'];
    protected $appends=['path'];
    protected $dates = ['created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
    public function getPathAttribute(){
        return $this->setAwsPath($this->document);
    }
    // public function getDocumentAttribute($value)
    // {
    //     return  $this->setAwsPath($value);
    // }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
