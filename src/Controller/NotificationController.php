<?php

namespace App\Controller;

use App\Entity\UserSubscription;
use Minishlink\WebPush\MessageSentReport;
use Minishlink\WebPush\WebPush;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NotificationController
 * @package App\Controller
 * @Route("/api/notification")
 */
class NotificationController extends AbstractController
{
    /**
     * @param $request
     * @param $user
     * @return JsonResponse
     *
     * @Route("/register/", name="api_notification_register")
     * @Method("POST")
     */
    public function registerSubscription($request, $user)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $endpoint = $request->request->get("endpoint");
        $keys = $request->request->get("keys");

        if ((empty($keys) || !is_array($keys) )|| empty($endpoint)) {
            return JsonResponse::create([
                "code" => 400,
                "message" => "Missing data to register the subscription (endpoint, keys)",
            ], 400);
        }

        $userSubscription = new UserSubscription();
        $userSubscription->setUser($this->getUser());
        $userSubscription-> setEndpoint($endpoint);
        $userSubscription->setAuthToken($keys["p256dh"]);
        $userSubscription->setPublicKey($keys["auth"]);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($userSubscription);
        $entityManager->flush();

        return JsonResponse::create([
            "code" => 200,
        ], 200);
    }

    /**
     * @param $request
     * @return JsonResponse
     * @throws \ErrorException
     *
     * @Route("/send/", name="api_notification_register")
     */
    public function sendNotification($request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $userIdList = $request->request->get("userIdList");
        $messageNotification = $request->request->get("messageNotification");
        $titleNotification = $request->request->get("titleNotification");
        $linkNotification = $request->request->get("linkNotification");

        $userSubscriptionList = $this->getDoctrine()->getRepository(UserSubscription::class)->findByIds($userIdList);

        $notifications = [];

        /** @var UserSubscription $userSubscription */
        foreach ($userSubscriptionList as $userSubscription) {
            $notifications[] = [
                'subscription' => $userSubscription->getSubscription(),
                'payload' => json_encode([
                    "title" => $titleNotification,
                    "message" => $messageNotification,
                    "link" => $linkNotification,
                ]),
            ];
        }

        $webPush = new WebPush();

        // send multiple notifications with payload
        foreach ($notifications as $notification) {
            $webPush->sendNotification(
                $notification['subscription'],
                $notification['payload'], // optional (defaults null)
                true  //if set to true, notifications are flush without check result
            );
        }

//        /**
//         * Check sent results
//         * @var MessageSentReport $report
//         */
//        foreach ($webPush->flush() as $report) {
//            $endpoint = $report->getRequest()->getUri()->__toString();
//
//            if ($report->isSuccess()) {
//                echo "[v] Message sent successfully for subscription {$endpoint}.";
//            } else {
//                echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
//            }
//        }

        return JsonResponse::create([
            "code" => 200,
        ], 200);
    }
}
