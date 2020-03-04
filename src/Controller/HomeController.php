<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->redirect('/api');
    }

    /**
     * @Route("/singlevideo", name="singlevideo")
     */
    public function singlevideo(Request $request)
    {
        $search = $request->query->get('search');
        $apiKey = "AIzaSyB7CdRuc8guFqf0plkQc826nsEvINljutQ";
        $client = new \Google_Client();
        $client->setDeveloperKey($apiKey);
        $youtube = new \Google_Service_YouTube($client);
        $resp = $youtube->search->listsearch('id,snippet', ['q' => $search, 'maxResults' => 10]);
        $playlistitems = $resp["items"];
        $pl_array = [];
        $plline = [];
        foreach ($playlistitems as $pl) {
            $plline["id"] = $pl["snippet"]["resourceId"]["videoId"];
            $plline["title"] = $pl["snippet"]["title"];
            $plline["desc"] = $pl["snippet"]["description"];
            $plline["imgurl"] = $pl["snippet"]["thumbnails"]["high"]["url"];
            array_push($pl_array, $plline);
            $plline = [];
        }
        return $this->json(['videolist' => $pl_array]);
    }
}