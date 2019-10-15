<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @UniqueEntity(
 * fields={"libelle"},
 * message="Une autre annonce possède déjà ce libelle, merci de le modifier")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=50, 
     * minMessage="Le titre doit faire plus de 5 caractères !", 
     * maxMessage="Le titre ne peut pas faire plus de 50 caractères")
     * 
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=0, max=500,
     * minMessage="Le prix doit être supérieur à 0€",
     * maxMessage="Le prix ne doit pas dépasser 500€")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Length(min=10, max=200,
     * minMessage="La description doit faire plus de 10 caractères !",
     * maxMessage="La description ne peut pas faire plus de 200 caractères")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
