<?php

namespace App\Entity;

use App\Repository\CategorieDocumentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorieDocumentRepository::class)]
class CategorieDocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // ================= Nom & Description =================

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    // ================= Documents =================

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Document::class)]
    private Collection $documents;

    // ================= Constructor =================

    public function __construct()
    {
        $this->documents = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    // ================= Relations =================

    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);

            // synchronisation côté Document
            if ($document->getCategorie() !== $this) {
                $document->setCategorie($this);
            }
        }

        return $this;
    }

    public function removeDocument(Document $document): static
    {
        // on ne casse pas la contrainte nullable=false
        $this->documents->removeElement($document);

        return $this;
    }
}
