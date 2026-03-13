<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AgentRepository::class)]
class Agent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // ================= Identity =================

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email(message: "L'adresse email '{{ value }}' n'est pas valide.")]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    #[Assert\Choice(
        choices: ['AGENT', 'RH', 'ADMIN', 'DIRECTION'],
        message: "Rôle invalide."
    )]
    private ?string $role = null;

    // ================= Organisation =================

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    private ?string $poste = null;

    #[ORM\Column(length: 100)]
    private ?string $service = null;

    #[ORM\Column(length: 100)]
    private ?string $direction = null;

    #[ORM\Column(length: 100)]
    private ?string $pole = null;

    // ================= Relations =================

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Document::class, orphanRemoval: true)]
    private Collection $documents;

    #[ORM\OneToMany(mappedBy: 'auteur', targetEntity: ActualiteRH::class)]
    private Collection $actualitesRedigees;

    #[ORM\OneToMany(mappedBy: 'validateur', targetEntity: ActualiteRH::class)]
    private Collection $actualitesValidees;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: LogConsultation::class, orphanRemoval: true)]
    private Collection $logConsultations;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->actualitesRedigees = new ArrayCollection();
        $this->actualitesValidees = new ArrayCollection();
        $this->logConsultations = new ArrayCollection();
    }

    // ================= Getters / Setters =================

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }
    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }
    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }
    public function setRole(string $role): static
    {
        $this->role = $role;
        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }
    public function setPoste(string $poste): static
    {
        $this->poste = $poste;
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

    public function getDirection(): ?string
    {
        return $this->direction;
    }
    public function setDirection(?string $direction): static
    {
        $this->direction = $direction;
        return $this;
    }

    public function getPole(): ?string
    {
        return $this->pole;
    }
    public function setPole(?string $pole): static
    {
        $this->pole = $pole;
        return $this;
    }

    // ================= Documents =================

    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setAgent($this);
        }
        return $this;
    }

    public function removeDocument(Document $document): static
    {
        if ($this->documents->removeElement($document)) {
            if ($document->getAgent() === $this) {
                $document->setAgent(null);
            }
        }
        return $this;
    }

    // ================= Actualités rédigées =================

    public function getActualitesRedigees(): Collection
    {
        return $this->actualitesRedigees;
    }

    public function addActualiteRedigee(ActualiteRH $actualite): static
    {
        if (!$this->actualitesRedigees->contains($actualite)) {
            $this->actualitesRedigees->add($actualite);
            $actualite->setAuteur($this);
        }
        return $this;
    }

    public function removeActualiteRedigee(ActualiteRH $actualite): static
    {
        if ($this->actualitesRedigees->removeElement($actualite)) {
            if ($actualite->getAuteur() === $this) {
                $actualite->setAuteur(null);
            }
        }
        return $this;
    }

    // ================= Actualités validées =================

    public function getActualitesValidees(): Collection
    {
        return $this->actualitesValidees;
    }

    public function addActualiteValidee(ActualiteRH $actualite): static
    {
        if (!$this->actualitesValidees->contains($actualite)) {
            $this->actualitesValidees->add($actualite);
            $actualite->setValidateur($this);
        }
        return $this;
    }

    public function removeActualiteValidee(ActualiteRH $actualite): static
    {
        if ($this->actualitesValidees->removeElement($actualite)) {
            if ($actualite->getValidateur() === $this) {
                $actualite->setValidateur(null);
            }
        }
        return $this;
    }

    // ================= LogConsultations =================

    public function getLogConsultations(): Collection
    {
        return $this->logConsultations;
    }

    public function addLogConsultation(LogConsultation $log): static
    {
        if (!$this->logConsultations->contains($log)) {
            $this->logConsultations->add($log);
            $log->setUtilisateur($this);
        }
        return $this;
    }

    public function removeLogConsultation(LogConsultation $log): static
    {
        // On supprime juste de la collection, on ne met plus null
        $this->logConsultations->removeElement($log);
        return $this;
    }
}
