<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankTransfer extends Model
{
    protected $guarded = [];

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function bank(){
        return $this->belongsTo(Bank::class);
    }
}
