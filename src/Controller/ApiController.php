<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiController extends AbstractController
{


    public function fetchApi(EntityManagerInterface $entityManager)
    {
        $username = 'azerty';

        $url = file_get_contents("http://51.255.160.47:8181/euw1/passerelle/getHistoryMatchList/" . $username);
        $json = json_decode($url, true);

        foreach ($json['matches'] as $data) {


            if (isset($data)) {

                $user = new User();

                $user = $this->setValue($data, 'username', $username, 'setUsername', $user, $entityManager, false);
                $user = $this->setValue($data, 'gameId', $data['gameId'], 'setGameId', $user, $entityManager);
                $user = $this->setValue($data, 'role', $data['role'], 'setRole', $user, $entityManager);
                $user = $this->setValue($data, 'lane', $data['lane'], 'setLane', $user, $entityManager);


                $entityManager->persist($user);
            } else {
                $err = 'erreur';
                dump($err);
            }
            $entityManager->flush();
        }


    }

    protected function setValue($data, $key, $value, $action, $object, $entityManager, $exists = true)
    {

        if (!$exists || array_key_exists($key, $data)) {
            $object->$action($value);

        } else {
            $object->$action('undefined');

        }

        $entityManager->persist($object);

        return $object;

    }


    /**
     * @Route("/", name="api")
     */
    public
    function index(UserRepository $api): Response
    {
        $users = $api->findAll();

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
            'users' => $users
        ]);
    }

    /**
     * @Route("/user/{id}", name="user_details")
     */
    public function showUserDetails(User $user)
    {

        return $this->render('api/details.html.twig', [
            'user' => $user
        ]);
    }
}
