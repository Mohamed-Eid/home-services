<?php

namespace App\Http\Controllers\Api;

use App\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BankResourece;

class BankController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        return $this->ApiResponse(true , [] , __('site.banks') ,BankResourece::collection(Bank::all()) ,200);
    }
}
