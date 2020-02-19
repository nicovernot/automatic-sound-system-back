<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use vendor\google\apiclient;
use Symfony\Component\HttpClient\HttpClient;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $client1 = HttpClient::create();
        $response = $client1->request('GET', 'https://api.github.com/repos/symfony/symfony-docs');
        $contentType = $response->getHeaders()['content-type'][0];
        var_dump($contentType) ;
        $apiKey = "AIzaSyB8iEceICuU8wpmmlP98kdHCeeIQ6_NH6g";
        $client = new \Google_Client();
        $client -> setDeveloperKey($apiKey);
        $youtube = new \Google_Service_YouTube($client);
        $resp = $youtube->search->listsearch('id,snippet',['q'=>'raccoon','maxResults'=>10]);
       
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            "videos" => $resp,
        ]);
    }
}
