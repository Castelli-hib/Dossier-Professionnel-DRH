<?php

namespace App\Entity;

use App\Repository\LogConsultationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogConsultationRepository::class)]
class LogConsultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_consultation = null;

    #[ORM\ManyToOne(targetEntity: Agent::class, inversedBy: 'logConsultations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Agent $utilisateur = null;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $type_ressource = null;

    #[ORM\Column(type: 'integer')]
    private ?int $id_ressource = null;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $action = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $origine = null;

    #[ORM\ManyToOne]
    private ?Document $document = null;

    #[ORM\ManyToOne]
    private ?ActualiteRH $actualite = null;

    // ===== Getters / Setters =====

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setDocument(?Document $document): static
    {
        $this->document = $document;

        if ($document) {
            $this->type_ressource = 'document';
            
        }

        return $this;
    }

    public function getDateConsultation(): ?\DateTimeInterface
    {
        return $this->date_consultation;
    }

    public function setDateConsultation(\DateTimeInterface $date_consultation): static
    {
        $this->date_consultation = $date_consultation;
        return $this;
    }

    public function getUtilisateur(): ?Agent
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Agent $utilisateur): static
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    public function getTypeRessource(): ?string
    {
        return $this->type_ressource;
    }

    public function setTypeRessource(string $type_ressource): static
    {
        $this->type_ressource = $type_ressource;
        return $this;
    }

    public function getIdRessource(): ?int
    {
        return $this->id_ressource;
    }

    public function setIdRessource(int $id_ressource): static
    {
        $this->id_ressource = $id_ressource;
        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): static
    {
        $this->action = $action;
        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->origine;
    }

    public function setOrigine(string $origine): static
    {
        $this->origine = $origine;
        return $this;
    }

    public function __construct()
    {
        $this->date_consultation = new \DateTime();
    }
}
