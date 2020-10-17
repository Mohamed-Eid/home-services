<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentBankAccount extends Model
{
    protected $guarded = [];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
