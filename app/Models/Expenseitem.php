<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenseitem extends Model
{
    use HasFactory;

    protected $fillable = ['expense_id', 'category', 'quantity', 'price', 'total'];

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }
}
