<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserSubscription;
use Minishlink\WebPush\MessageSentReport;
use Minishlink\WebPush\WebPush;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NotificationController
 * @package App\Controller
 * @Route("/api/notification")
 */
class NotificationController extends AbstractController
{
    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/register/", name="api_notification_register", methods={"POST"})
     */
    public function registerSubscription(Request $request)
    {
//        try {
//            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//            $user = $this->getUser();
//        } catch (\Exception $e) {
//            return JsonResponse::create([
//                "code" => 401,
//                "message" => "Authentication required",
//            ], 401);
//        }

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find(1);

         $body = json_decode($request->getContent(), true);

        if (!is_array($body["keys"]) || empty($body["endpoint"])) {
            return JsonResponse::create([
                "code" => 400,
                "message" => "Missing data to register the subscription (endpoint, keys)",
            ], 400);
        }

        try {
            $endpoint = $body["endpoint"];
            $keys = $body["keys"];

            $userSubscription = new UserSubscription();
            $userSubscription->setUser($user);
            $userSubscription-> setEndpoint($endpoint);
            $userSubscription->setAuthToken($keys["p256dh"]);
            $userSubscription->setPublicKey($keys["auth"]);

            $entityManager->persist($userSubscription);
            $entityManager->flush();

            return JsonResponse::create([
                "code" => 200,
            ], 200);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "code" => 500,
                "" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/unregister/", name="api_notification_unregister", methods={"DELETE"})
     */
    public function unregisterSubscription(Request $request)
    {
//        try {
//            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//            $user = $this->getUser();
//        } catch (\Exception $e) {
//            return JsonResponse::create([
//                "code" => 401,
//                "message" => "Authentication required",
//            ], 401);
//        }

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find(1);

        try {
            $userSubscriptionList = $entityManager->getRepository(UserSubscription::class)->findByIds([$user->getId()]);
            foreach ($userSubscriptionList as $userSubscription) {
                $entityManager->remove($userSubscription);
            }

            $entityManager->flush();

            return JsonResponse::create([
                "code" => 200,
            ], 200);
        } catch (\Exception $e) {
            return JsonResponse::create([
                "code" => 500,
                "" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \ErrorException
     *
     * @Route("/send/", name="api_notification_send", methods={"POST"})
     */
    public function send(Request $request)
    {
//        try {
//            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//        } catch (\Exception $e) {
//            return JsonResponse::create([
//                "code" => 401,
//                "message" => "Authentication required",
//            ], 401);
//        }

        $body = json_decode($request->getContent(), true);

        if ( !array($body["userIdList"]) || empty($body["messageNotification"]) ) {
            return JsonResponse::create([
                "code" => 400,
                "message" => "Missing data to send notification (userIdList, )",
            ], 400);
        }

        $userIdList = $body["userIdList"];
        $messageNotification = $body["messageNotification"];
        $titleNotification = $body["titleNotification"];
        $linkNotification = $body["linkNotification"];

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

        $webPush = new WebPush([
            'GCM' => 'MY_GCM_API_KEY', // deprecated and optional, it's here only for compatibility reasons
            'VAPID' => [
                'subject' => 'pdelamotte@esimed.fr', // can be a mailto: or your website address
                'publicKey' => 'BItoVHgEImb1oDvlVaCchsKAHOQNjbclddgfp7mlfZUmKwMIgqlgI5t8bBYRWWNlic3uViiU4ZbIRU6rmRuX_Ac', // (recommended) uncompressed public key P-256 encoded in Base64-URL
                'privateKey' => '2ro62CCZGMJOJXDX4p1ATSM5MdZLcQrFVQPk-Liu9o4', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
            ],
        ]);

        // send multiple notifications with payload
        foreach ($notifications as $notification) {
            $webPush->sendNotification(
                $notification['subscription'],
                $notification['payload'], // optional (defaults null)
                true  //if set to true, notifications are flush without check result
            );
        }

//        these line are for debug
//        $notificationsStatus = [];
//
//        /**
//         * Check sent results
//         * @var MessageSentReport $report
//         */
//        foreach ($webPush->flush() as $report) {
//            $endpoint = $report->getRequest()->getUri()->__toString();
//
//            if ($report->isSuccess()) {
//                $notificationsStatus["success"][] = "[v] Message sent successfully for subscription {$endpoint}";
//            } else {
//                $notificationsStatus["error"][] = [
//                    "message" => "[x] Message failed to sent for subscription {$endpoint}",
//                    "reason" => "{$report->getReason()}"
//                ];
//            }
//        }

        return JsonResponse::create([
            "code" => 200,
//            "data" => $notificationsStatus,
        ], 200);
    }
}
