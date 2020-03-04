<?php


namespace App\Controller\API\Track;


use App\Service\Entity\TrackService;
use App\Service\YouTubeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrackSymfonyController extends AbstractController
{
    /** @var YouTubeService $youTubeService */
    private $youTubeService;
    /** @var TrackService $trackService */
    private $trackService;

    //region AUTO WIRING
    /**
     * @param YouTubeService $youTubeService
     * @required
     */
    public function setYouTubeService(YouTubeService $youTubeService): void
    {
        $this->youTubeService = $youTubeService;
    }

    /**
     * @param TrackService $trackService
     * @required
     */
    public function setTrackService(TrackService $trackService): void
    {
        $this->trackService = $trackService;
    }
    //endregion

    /**
     * @Route("/api/tracks/youtube/playlist", name="tracks_youtube_playlist")
     */
    public function playlist(Request $request)
    {
        $playlistId = $request->get('yt_playlist_id');

        $playlistResponse = $this->youTubeService->getPlaylistItems($playlistId);

        $playlist = $playlistResponse->toArray();

        $tracks = [];

        if (isset($playlist["items"])) {
            $tracks = $this->trackService->getFromYTItems($playlist["items"]);
        }

        return $this->json(
            $tracks,
            Response::HTTP_OK,
            [],
            ['groups' => ['track_read']]
        );
    }
}