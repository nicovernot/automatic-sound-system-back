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
       
        $apiKey = "AIzaSyB8iEceICuU8wpmmlP98kdHCeeIQ6_NH6g";
        $client = new \Google_Client();
        $client -> setDeveloperKey($apiKey);
        $youtube = new \Google_Service_YouTube($client);
        $resp = $youtube->search->listsearch('id,snippet',['q'=>'raccoon','maxResults'=>10]);

            $playlist_id =  'PLaLWNpJCbH_o5BXR4quVluHs29iEvzo_O'; 
            $api_url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=25&playlistId='.$playlist_id . '&key='.$apiKey;
                  
            $playlist = $client1->request('GET',$api_url);
            $playlist = $playlist->getContent();
            $playlist =json_decode( $playlist,true);
           
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            "videos" => $resp,
            "playlist" => $playlist,
        ]);
    }
}
