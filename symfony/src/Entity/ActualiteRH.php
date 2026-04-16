<?php

namespace App\Entity;

use App\Repository\ActualiteRHRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Enum\StatutActualite;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ActualiteRHRepository::class)]
class ActualiteRH
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // ======= Contenu =======
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le titre est requis.")]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Le contenu est requis.")]
    private ?string $contenu = null;

    #[ORM\Column]
    private bool $est_public = false;

    #[ORM\Column(type: 'string', enumType: StatutActualite::class)]
    private StatutActualite $statut = StatutActualite::BROUILLON;

    // ======= Relations =======
    #[ORM\ManyToOne(inversedBy: 'actualitesRedigees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Agent $auteur = null;

    #[ORM\ManyToOne(targetEntity: Agent::class, inversedBy: 'actualitesValidees')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Agent $validateur = null;

    // simple réfrérence pour éviter les problèmes de cascade 
    #[ORM\OneToMany(mappedBy: 'actualite', targetEntity: Document::class)]
    private Collection $documents;

    // #[ORM\OneToMany(mappedBy: 'actualite', targetEntity: Document::class, cascade: ['persist', 'remove'])]
    // private Collection $documents;

    // ======= Dates =======
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_publication = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_archivage = null;

    // ======= Constructeur =======
    public function __construct()
    {
        $this->date_creation = new \DateTime();
        $this->documents = new ArrayCollection();
        
    }

    // ======= Flux métier =======
    public function valider(): void
    {
        if ($this->statut !== StatutActualite::BROUILLON) {
            throw new \LogicException('Seul un brouillon peut être mis en validation.');
        }
        $this->statut = StatutActualite::EN_VALIDATION;
    }

    public function publier(): void
    {
        if ($this->statut !== StatutActualite::EN_VALIDATION) {
            throw new \LogicException('Une actualité doit être validée avant publication.');
        }
        $this->statut = StatutActualite::PUBLIEE;
        $this->date_publication = new \DateTime();
        $this->est_public = true; // automatiquement public après publication
    }

    public function archiver(): void
    {
        $this->statut = StatutActualite::ARCHIVEE;
        $this->date_archivage = new \DateTime();
        $this->est_public = false; // plus visible
    }

    // ======= Relation Document =======
    public function addDocument(Document $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setActualite($this);
        }
        return $this;
    }

    public function removeDocument(Document $document): static
    {
        if ($this->documents->removeElement($document)) {
            if ($document->getActualite() === $this) {
                $document->setActualite(null);
            }
        }
        return $this;
    }

    // ======= Getters / Setters =======
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
    public function getStatut(): StatutActualite
    {
        return $this->statut;
    }
    public function setStatut(StatutActualite $statut): static
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
    public function getDateArchivage(): ?\DateTimeInterface
    {
        return $this->date_archivage;
    }
    // public function getDocuments(): Collection
    // {
    //     return $this->documents;
    // }
}
