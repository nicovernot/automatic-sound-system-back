<?php


namespace App\Service;


use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Component\Dotenv\Dotenv;

class YouTubeService
{
    const API_KEY = "AIzaSyB7CdRuc8guFqf0plkQc826nsEvINljutQ";

    /**
     * @param string $playlistId
     * @return ResponseInterface
     */
    public function getPlaylistItems(string $playlistId): ResponseInterface
    {
        $dotenv = new Dotenv();
        $dotenv->loadEnv(__DIR__.'/.env.local');
        $ak = $_ENV['API_KEY'];
        $client1 = HttpClient::create();
        $url = 'https://www.googleapis.com/youtube/v3/playlistItems';

        $playlistResponse = $client1->request('GET', $url, [
            'query' => [
                'part' => 'snippet',
                'maxResults' => 50,
                'playlistId' => $playlistId,
                'key' => $ak,
            ]
        ]);

        return $playlistResponse;
    }
}