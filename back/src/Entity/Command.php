<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CommandRepository::class)
 * @UniqueEntity(
 * "name",
 *  message="Ce nom de personnage {{ value }} est déjà utilisé",
 *  groups = {
 *      "registration", 
 *      "validation_one"
 *      }
 * )
 */
class Command
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(
     *  type="integer"
     * )
     * @Groups({
     *  "category",
     *  "command",
     *  "user",
     *  "login",
     *  "command_info"
     * })
     */
    private $id;

    /**
     * @ORM\Column(
     *  type="string",
     *  length=255,
     *  nullable=true
     * )
     * @Groups({
     *  "category",
     *  "command", 
     *  "user", 
     *  "login",
     *  "command_info"
     * })
     */
    private $file;

    /**
     * @ORM\Column(
     *  type="json"
     * )
     * @Assert\NotBlank(
     *  message = "Ce champ ne peut pas être vide."
     * )
     * @Groups({
     *  "category",
     *  "command",
     *  "user",
     *  "command_info"
     * })
     */
    private $data = [];

    /**
     * @ORM\ManyToOne(
     *  targetEntity=User::class,
     *  inversedBy="commands"
     * )
     * @Groups({
     *  "category",
     *  "command", 
     *  "command_info"
     * })
     */
    private $user;

    /**
     * @ORM\ManyToMany(
     * targetEntity=Item::class,
     *  inversedBy="commands",
     * cascade={"persist"}
     * )
     * @Groups({
     *  "command",
     *  "user",
     *  "login",
     *  "command_info"
     * }),
     * 
     */
    private $item;

    /**
     * @ORM\Column(
     * type="datetime"
     * )
     * @Groups({
     *  "category",
     *  "command", 
     *  "user",
     *  "command_info"
     * })
     */
    private $createdAt;

    /**
     * @ORM\Column(
     *  type="datetime"
     * )
     * @Groups({
     *  "category",
     *  "command",
     *  "user",
     *  "command_info"
     * })
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(
     * targetEntity=Testimony::class,
     *  mappedBy="command",
     *  cascade={
     *      "persist",
     *      "remove"
     *      }
     * )
     */
    private $testimony;

    /**
     * @ORM\Column(
     *  type="string",
     *  length=255
     * )
     * @Groups({
     *  "user",
     *  "command",
     *  "login",
     *  "command_info"
     * })
     */
    private $slug;

    /**
     * @ORM\Column(
     *  type="string",
     *  length=45
     * )
     * @Groups({
     *  "user",
     *  "login",
     *  "command_info",
     *  "command"
     * })
     * @Assert\NotBlank(
     *  message = "Ce champ ne peut pas être vide.",
     *  groups = {
     *       "validation_one",
     *      },
     * )
     * @Assert\Length(
     *      min = 3,
     *      max = 25,
     *      minMessage = "Votre nom d'utilisateur doit au moins faire {{ limit }} caractère",
     *      maxMessage = "Votre nom d'utilisateur doit faire {{ limit }} caractère maximum",
     *      groups = {
     *      "validation_one",
     *      },
     * )
     */
    private $name;

    /**
     * @ORM\OneToOne(
     * targetEntity=CommandData::class,
     *  inversedBy="command",
     *  cascade={
     *      "persist",
     *      "remove"
     *      },
     * )
     * @ORM\JoinColumn(
     *  nullable=true
     * )
     * @Groups({
     *  "command_info"
     * })
     */
    private $commandData;

    /**
     * @ORM\ManyToOne(
     *  targetEntity=Status::class,
     *  inversedBy="commands"
     * )
     * @ORM\JoinColumn(
     *  nullable=false
     * )
     * @Groups({
     *  "command", "user"
     * })
     */
    private $status;

    public function __construct()
    {
        $this->item = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(Item $item): self
    {
        if (!$this->item->contains($item)) {
            $this->item[] = $item;
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->item->contains($item)) {
            $this->item->removeElement($item);
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getTestimony(): ?Testimony
    {
        return $this->testimony;
    }

    public function setTestimony(Testimony $testimony): self
    {
        $this->testimony = $testimony;

        // set the owning side of the relation if necessary
        if ($testimony->getCommand() !== $this) {
            $testimony->setCommand($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCommandData(): ?CommandData
    {
        return $this->commandData;
    }

    public function setCommandData(CommandData $commandData): self
    {
        $this->commandData = $commandData;

        // set the owning side of the relation if necessary
        if ($commandData->getCommand() !== $this) {
            $commandData->setCommand($this);
        }

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }
}
