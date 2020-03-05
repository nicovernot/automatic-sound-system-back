<?php

namespace App\Controller\API\Score;


use App\Controller\API\AbstractController;
use App\Entity\Score;
use App\Service\Entity\ScoreService;

abstract class AbstractScoreController extends AbstractController
{
    /** @var ScoreService $service */
    protected $service;

    /**
     * @param ScoreService $service
     * @required
     */
    public function setService(ScoreService $service): void
    {
        $this->service = $service;
    }

    public function getEntityClassName(): string
    {
        return Score::class;
    }
}