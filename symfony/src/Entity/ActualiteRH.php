<?php

namespace App\Entity;

use App\Repository\ActualiteRHRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActualiteRHRepository::class)]
class ActualiteRH
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Titre
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le titre est requis.")]
    private ?string $titre = null;

    // Contenu
    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Le contenu est requis.")]
    private ?string $contenu = null;

    // Visibilité publique (intranet)
    #[ORM\Column]
    private bool $est_public = false;

    // Statut éditorial
    #[ORM\Column(length: 50)]
    private string $statut = 'brouillon';

    // Auteur RH
    #[ORM\ManyToOne(inversedBy: 'actualiteRHs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Agent $auteur = null;

    // Validateur (Direction / DRH)
    #[ORM\ManyToOne]
    private ?Agent $validateur = null;

    // Date création
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    // Date publication réelle
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_publication = null;

    // Date archivage
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_archivage = null;

    public function __construct()
    {
        $this->date_creation = new \DateTime();
    }

    // =============================
    // Getters / Setters
    // =============================

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }
    public function setTitre(string $titre): static
    {
        $this->titre = $titre;
        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }
    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function isEstPublic(): bool
    {
        return $this->est_public;
    }
    public function setEstPublic(bool $est_public): static
    {
        $this->est_public = $est_public;
        return $this;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }
    public function setStatut(string $statut): static
    {
        $this->statut = $statut;
        return $this;
    }

    public function getAuteur(): ?Agent
    {
        return $this->auteur;
    }
    public function setAuteur(?Agent $auteur): static
    {
        $this->auteur = $auteur;
        return $this;
    }

    public function getValidateur(): ?Agent
    {
        return $this->validateur;
    }
    public function setValidateur(?Agent $validateur): static
    {
        $this->validateur = $validateur;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }
    public function setDatePublication(?\DateTimeInterface $date_publication): static
    {
        $this->date_publication = $date_publication;
        return $this;
    }

    public function getDateArchivage(): ?\DateTimeInterface
    {
        return $this->date_archivage;
    }
    public function setDateArchivage(?\DateTimeInterface $date_archivage): static
    {
        $this->date_archivage = $date_archivage;
        return $this;
    }
}
