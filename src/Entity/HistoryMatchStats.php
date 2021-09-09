<?php

namespace App\Entity;

use App\Repository\HistoryMatchStatsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoryMatchStatsRepository::class)
 */
class HistoryMatchStats
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $champion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChampion(): ?int
    {
        return $this->champion;
    }

    public function setChampion(string $champion): self
    {
        $this->champion = $champion;

        return $this;
    }
}
