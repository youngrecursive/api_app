<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

   public function getData($siret)
    {
       $response = $this->client->request(
           'GET',
           'https://api.insee.fr/entreprises/sirene/V3/siret/'.$siret, [
            'auth_bearer' => 'fa6ec09f-5d96-3b16-bde3-f7d110f07554',   
        ]
       );

       return $response->toArray();
   }

}
