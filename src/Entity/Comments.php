<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 */
class Comments implements \JsonSerializable
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
    private $text;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Games::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $games;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getGames(): ?Games
    {
        return $this->games;
    }

    public function setGames(?Games $games): self
    {
        $this->games = $games;

        return $this;
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return [
            'text'=>$this->getText(),
            'date'=>$this->getDate()
        ];
    }
}
