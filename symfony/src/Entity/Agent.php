<?php

namespace App\Entity;

use App\Enum\Direction;
use App\Enum\Pole;
use App\Entity\Service;
use App\Entity\Document;
use App\Entity\ActualiteRH;
use App\Entity\LogConsultation;
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

    // NOUVEAU SYSTEME DE ROLES (Symfony Security)
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    // CONSTANTES (propre et réutilisable partout)
    public const ROLE_AGENT = 'ROLE_AGENT';
    public const ROLE_RH = 'ROLE_RH';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    // ================= Organisation =================

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    private ?string $poste = null;


    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $service = null;

    #[ORM\Column(enumType: Pole::class)]
    private ?Pole $pole = null;

    // ================= Relations =================

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Document::class, orphanRemoval: true)]
    private Collection $documents;

    #[ORM\OneToMany(mappedBy: 'auteur', targetEntity: ActualiteRH::class)]
    private Collection $actualitesRedigees;

    #[ORM\OneToMany(mappedBy: 'validateur', targetEntity: ActualiteRH::class)]
    private Collection $actualitesValidees;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: LogConsultation::class, orphanRemoval: true)]
    private Collection $logConsultations;

    // #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'agents')]
    // #[ORM\JoinColumn(nullable: true)]
    // private ?Service $service = null;


    // ================= Constructeur =================

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->actualitesRedigees = new ArrayCollection();
        $this->actualitesValidees = new ArrayCollection();
        $this->logConsultations = new ArrayCollection();

        // ROLE PAR DEFAUT (IMPORTANT)
        $this->roles = [self::ROLE_AGENT];
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

    // ================= ROLES =================

    public function getRoles(): array
    {
        $roles = $this->roles;

        // garantit toujours au moins ROLE_AGENT
        $roles[] = self::ROLE_AGENT;

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    // MÉTHODE PRATIQUE
    public function hasRole(string $role): bool
    {
        return in_array($role, $this->getRoles());
    }

    // ================= Organisation =================

    public function getPoste(): ?string
    {
        return $this->poste;
    }
    public function setPoste(string $poste): static
    {
        $this->poste = $poste;
        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }
    public function setService(?Service $service): static
    {
        $this->service = $service;
        return $this;
    }

    public function getPole(): ?Pole
    {
        return $this->pole;
    }

    public function setPole(?Pole $pole): static
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

            if ($document->getAgent() !== $this) {
                $document->setAgent($this);
            }
        }

        return $this;
    }

    public function removeDocument(Document $document): static
    {
        $this->documents->removeElement($document);
        return $this;
    }

    // ================= Actualités =================

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
        $this->actualitesRedigees->removeElement($actualite);
        return $this;
    }

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

    // ================= Logs =================

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
        $this->logConsultations->removeElement($log);
        return $this;
    }

   
}
