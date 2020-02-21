<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use vendor\google\apiclient;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
       
           
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
          
        ]);
    }

      /**
     * @Route("/playlist", name="playlist")
     */
    public function playlist(Request $request)
    {
            $client1 = HttpClient::create();
            $apiKey = "AIzaSyB7CdRuc8guFqf0plkQc826nsEvINljutQ";
            $playlist_id =  $request->query->get('playlist'); 
            if ($playlist_id==""){
                return $this->json(['erreur' => 'Vous n\'avez pas rentré le code plyalist']);
                exit;
            }
            $api_url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=25&playlistId='.$playlist_id . '&key='.$apiKey;
                  
            $playlist = $client1->request('GET',$api_url);
            $playlist = $playlist->getContent();
            $playlist =json_decode( $playlist,true);
            $playlistitems = $playlist["items"];
            $pl_array=[];
            $plline=[];
            foreach($playlistitems as $pl) {
               $plline["id"]=$pl["snippet"]["resourceId"]["videoId"];
               $plline["title"]=$pl["snippet"]["title"];
               $plline["desc"]=$pl["snippet"]["description"];
               $plline["imgurl"]=$pl["snippet"]["thumbnails"]["high"]["url"];
               array_push($pl_array, $plline);
               $plline=[];
            }

            return $this->json(['playlist' => $pl_array]);
    }


     /**
     * @Route("/singlevideo", name="singlevideo")
     */
    public function singlevideo(Request $request)
    {
        $search=$request->query->get('search');
        if ($search==""){
            return $this->json(['erreur' => 'Vous n\'avez pas rentré de mot clé']);
            exit;
        }
        $apiKey = "AIzaSyB7CdRuc8guFqf0plkQc826nsEvINljutQ";
        $client = new \Google_Client();
        $client -> setDeveloperKey($apiKey);
        $youtube = new \Google_Service_YouTube($client);
        $resp = $youtube->search->listsearch('id,snippet',['q'=>$search,'maxResults'=>10]);
        $playlistitems = $resp["items"];
        $pl_array=[];
        $plline=[];
        foreach($playlistitems as $pl) {
           $plline["id"]=$pl["snippet"]["resourceId"]["videoId"];
           $plline["title"]=$pl["snippet"]["title"];
           $plline["desc"]=$pl["snippet"]["description"];
           $plline["imgurl"]=$pl["snippet"]["thumbnails"]["high"]["url"];
           array_push($pl_array, $plline);
           $plline=[];
        }

        
        return $this->json(['videolist' => $pl_array]);
      
    }
}
