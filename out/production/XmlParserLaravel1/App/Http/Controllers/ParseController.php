<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Models\Clients;
use App\Models\Cities;
use App\Models\Parser;

class ParseController extends Controller
{
    public function __construct()
    {
    }

    public function parse(Clients $clients){
        $xml = XmlParser::load('storage/xml/clients.xml');
        $user = array();
        foreach ($xml->getContent() as $client){
            $city_code = $this->check_city_by_name($client->city);
            if(!$city_code){
               $city_name = ['name'=>$client->city];
               $city_code = $this->create_city($city_name);
            }

            $user[]= [
                'client_id' => $client->attributes()['id'],
                'name'=> $client->name,
                'age' => $client->age,
                'city_code' => $city_code,
                'membership_date' => $client->membership_date,
                'phones' => json_encode($client->numbers->number),
            ];

        }
        foreach ($user as $item){
            if(!$this->check_client_by_id($item['client_id'])){
                $clients->insert($item);
            }else{
                $id = $this->check_client_by_id($item['client_id']);
                Clients::query()->where('id', $id)->update([
                    'name'=> $item['name'],
                    'age' => $item['age'],
                    'city_code' => $item['city_code'],
                    'membership_date' => $item['membership_date'],
                    'phones' => $item['phones'],

                ]);
                //var_dump($item);
            }
           // var_dump($item['client_id']);
            //$clients->insert($item);
        }

    }

    public function upload_xml(Request $request){
        if($request->file('xml')){
           $file_name =  $request->file('xml')->getClientOriginalName();
            //var_dump($request->file('xml'));
            $this->validate($request, Parser::rules());
            Storage::putFileAs('public/xml', $request->file('xml'),$file_name);
        }
    }

    private function check_city_by_name($name){
        return Cities::query()->where('name', $name)->value('id');
    }
    private function create_city($name){
        return Cities::query()->insertGetId($name);
    }
    private function check_client_by_id($client_id){
        return Clients::query()->where('client_id', $client_id)->value('id');
    }
}
