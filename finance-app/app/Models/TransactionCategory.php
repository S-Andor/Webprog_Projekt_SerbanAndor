<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    protected $table = 'transactions_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name','code','created_at','updated_at'];
    use HasFactory;
}
