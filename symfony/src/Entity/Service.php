<?php

namespace App\Entity;

use App\Enum\Direction;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // ================= IDENTITE =================

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column(length: 50, nullable: true, unique: true)]
    private ?string $code = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    // ================= ORGANISATION =================

    #[ORM\Column(enumType: Direction::class)]
    private ?Direction $direction = null;

    // ================= RESPONSABLE =================

    #[ORM\ManyToOne(targetEntity: Agent::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Agent $responsable = null;

    // ================= RELATIONS =================

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Agent::class)]
    private Collection $agents;

    // ================= DATES =================

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    // ================= CONSTRUCT =================

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    // ================= GETTERS / SETTERS =================

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;
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

    public function getDirection(): ?Direction
    {
        return $this->direction;
    }

    public function setDirection(Direction $direction): self
    {
        $this->direction = $direction;
        return $this;
    }

    // ================= RESPONSABLE =================

    public function getResponsable(): ?Agent
    {
        return $this->responsable;
    }

    public function setResponsable(?Agent $responsable): self
    {
        $this->responsable = $responsable;
        return $this;
    }

    // ================= AGENTS =================

    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents->add($agent);
            $agent->setService($this);
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            if ($agent->getService() === $this) {
                $agent->setService(null);
            }
        }

        return $this;
    }

    // ================= DATES =================

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function updateTimestamp(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}
