<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Entity\UserService;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route(path="/api/register", methods={"POST"})
     */
    public function register(Request $request, ValidatorInterface $validator, AuthenticationSuccessHandler $handler, UserService $service)
    {
        $user = $service->createFromRequest($request);

        if (!$service->add($user)) {
            $errors = $validator->validate($user);

            if (count($errors) > 0) {
                return $this->json([
                    'errors' => (string)$errors
                ], Response::HTTP_BAD_REQUEST);
            }

            return $this->json([], Response::HTTP_BAD_REQUEST);
        }

        return $handler->handleAuthenticationSuccess($user);
    }
}
