<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;

class ClientsController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        $clients = Clients::query()->join('cities', 'clients.city_code', '=', 'cities.id')->select(Clients::raw('clients.id, clients.client_id, clients.name, clients.age, clients.city_code, clients.membership_date, clients.phones, cities.name as city_name'))->get();
        //dd($clients);
        return view('clients',['clients'=>$clients]);
    }
}
