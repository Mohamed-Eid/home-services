<?php 

use App\Tax;

function calc_tax_on_price($price)
{
    $tax = Tax::first()->tax;

    return ($price)*($tax/100);
}

function get_client_by_token()
{
    $token = request()->header('x-api-key');
    $client = Client::where('api_token',$token)->first();

    if($client)
    {
        return $client;
    }
    return null;
}

?>