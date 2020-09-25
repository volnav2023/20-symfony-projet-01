<?php

namespace App\Entity;

use App\Repository\GamesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GamesRepository::class)
 */
class Games implements \JsonSerializable
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
    private $nom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateSortie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $jaquette;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="games", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(?\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getJaquette(): ?string
    {
        return $this->jaquette;
    }

    public function setJaquette(?string $jaquette): self
    {
        $this->jaquette = $jaquette;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setGames($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getGames() === $this) {
                $comment->setGames(null);
            }
        }

        return $this;
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return [
//            'id'=>$this->getId(),
            'title'=>$this->getNom(),
            'date'=>$this->getDateSortie()->format('d-m-Y'),
            'jaquette'=>$this->getJaquette(),
//            'comments'=>$this->getComments()->toArray()
        ];
    }
}
