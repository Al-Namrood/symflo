<?php

namespace App\Controller;

use App\Entity\HistoryMatchStats;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HistoryMatchListController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getHistoryMatch()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $username = 'azerty';
        $response = $this->client->request(
            'GET',
            "http://51.255.160.47:8181/euw1/passerelle/getHistoryMatchList/" . $username
        );
        $content = $response->toArray();



        foreach ($content['matches'] as $data) {
            if (isset($data)) {
                dump($data);
                $championId = new HistoryMatchStats();

                $championId = $this->setValue($data, 'champion', $data['champion'], 'setChampion', $championId, $entityManager);

                $entityManager->persist($championId);
            }else {
                $err = 'erreur';
                dd($err);
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
     * @Route("/match-list", name="history_match_list")
     */
    public function index(): Response
    {

       $this->getHistoryMatch();

        return $this->render('history_match_list/index.html.twig', [
            'controller_name' => 'HistoryMatchListController',
        ]);
    }
}
