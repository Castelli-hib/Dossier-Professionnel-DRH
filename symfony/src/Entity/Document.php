<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\CategorieDocument;
use App\Entity\Agent;
use App\Enum\TypeDocument;
use App\Enum\StatutDocument;


#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // ================= Titre & Type & Statut =================
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $titre = null;

    #[ORM\Column(type: 'string', enumType: TypeDocument::class)]
    private TypeDocument $type;

    #[ORM\Column(type: 'string', enumType: StatutDocument::class)]
    private StatutDocument $statut = StatutDocument::BROUILLON;

    // ================= Catégorie =================
    #[ORM\ManyToOne(inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategorieDocument $categorie = null;

    // ================= Organisation =================
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $service = null;

    #[ORM\Column]
    private bool $est_public = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_publication = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $date_creation;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Agent $agent = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: true)]
    private ?ActualiteRH $actualite = null;

    // ================= Constructor =================
    public function __construct()
    {
        $this->date_creation = new \DateTime();
    }

    // ================= Flux métier =================
    public function valider(): void
    {
        $this->statut = StatutDocument::VALIDE;
    }

    public function publier(): void
    {
        if ($this->statut !== StatutDocument::VALIDE) {
            throw new \LogicException('Le document doit être validé avant publication.');
        }
        $this->statut = StatutDocument::PUBLIE;
        $this->date_publication = new \DateTime();
        $this->est_public = true; //  (cohérent métier)

    }

    public function archiver(): void
    {
        $this->statut = StatutDocument::ARCHIVE;
        $this->est_public = false;
        
    }


    // ================= Relations bidirectionnelles =================
    // public function setActualite(?ActualiteRH $actualite): static
    // {
    //     // Retirer du précédent si nécessaire
    //     if ($this->actualite && $this->actualite !== $actualite) {
    //         $this->actualite->removeDocument($this);
    //     }

    //     $this->actualite = $actualite;

    //     if ($actualite && !$actualite->getDocuments()->contains($this)) {
    //         $actualite->addDocument($this);
    //     }

    //     return $this;
    // }

    // ================= Getters / Setters =================
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
    public function getType(): TypeDocument
    {
        return $this->type;
    }
    public function setType(TypeDocument $type): static
    {
        $this->type = $type;
        return $this;
    }
    public function getCategorie(): ?CategorieDocument
    {
        return $this->categorie;
    }
    public function setCategorie(?CategorieDocument $categorie): static
    {
        $this->categorie = $categorie;
        return $this;
    }
    public function getService(): ?string
    {
        return $this->service;
    }
    public function setService(?string $service): static
    {
        $this->service = $service;
        return $this;
    }
    public function getActualite(): ?ActualiteRH
    {
        return $this->actualite;
    }
    public function isEstPublic(): bool
    {
        return $this->est_public;
    }
    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }
    public function setDatePublication(?\DateTimeInterface $date_publication): static
    {
        $this->date_publication = $date_publication;
        $this->est_public = $date_publication !== null;
        return $this;
    }
    public function getDateCreation(): \DateTimeInterface
    {
        return $this->date_creation;
    }
    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    // ================= RELATION AGENT =================
    public function setAgent(?Agent $agent): static
    {
        if ($this->agent && $this->agent !== $agent) {
            $this->agent->removeDocument($this);
        }

        $this->agent = $agent;

        if ($agent && !$agent->getDocuments()->contains($this)) {
            $agent->addDocument($this);
        }

        return $this;
    }

    public function setActualite(?ActualiteRH $actualite): static
    {
        $this->actualite = $actualite;
        return $this;
    }
}
