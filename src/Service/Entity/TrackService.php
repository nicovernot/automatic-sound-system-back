<?php


namespace App\Service\Entity;


use App\Entity\Track;
use App\Repository\TrackRepository;
use App\Service\Base\AbstractEntityService;

/**
 * Class TrackService
 * @package App\Service\Entity
 *
 * @method TrackRepository getRepository() : ObjectRepository
 * @method Track|null findOneByYTUrlId(string $findOneByYTUrlId) : ?Track
 */
class TrackService extends AbstractEntityService
{
    public function getEntityClassName(): string
    {
        return Track::class;
    }

    public function createFromYT(array $datas): ?Track
    {
        $track = null;

        if (
            isset($datas["snippet"]["title"]) &&
            isset($datas["snippet"]["resourceId"]["videoId"]) &&
            isset($datas["snippet"]["thumbnails"]["high"]["url"])
        ) {
            $track = (new Track())
                ->setYTTitle($datas["snippet"]["title"])
                ->setYTUrlId($datas["snippet"]["resourceId"]["videoId"])
                ->setThumbnails($datas["snippet"]["thumbnails"]["high"]["url"])
            ;
        }

        return $track;
    }

    public function getFromYTItems(array $items): array
    {
        $tracks = [];

        foreach($items as $pl) {
            if (!isset($pl["snippet"]["resourceId"]["videoId"])) {
                continue;
            }

            $videoId = $pl["snippet"]["resourceId"]["videoId"];

            $track = $this->findOneBy(['yTUrlId' => $videoId]);

            if ($track === null) {
                $track = $this->createFromYT($pl);

                if ($track !== null) {
                    $this->persist($track);
                }
            }


            if ($track !== null) {
                $tracks[] = $track;
            }
        }

        $this->flush();

        return $tracks;
    }
}