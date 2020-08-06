<?php

namespace App\Entity;

use App\Repository\CommandDataRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommandDataRepository::class)
 */
class CommandData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $utilisation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $utilisationDetails;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $budget;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $gap;

    /**
     * @ORM\OneToOne(targetEntity=Command::class, inversedBy="commandData", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $command;

    /**
     * @ORM\OneToOne(targetEntity=CommandConfigData::class, inversedBy="commandData", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commandConfigData;

    /**
     * @ORM\OneToOne(targetEntity=CommandSpecData::class, inversedBy="commandData", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commandSpecData;

    /**
     * @ORM\OneToOne(targetEntity=CommandDeviceData::class, inversedBy="commandData", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commandDeviceData;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisation(): ?string
    {
        return $this->utilisation;
    }

    public function setUtilisation(?string $utilisation): self
    {
        $this->utilisation = $utilisation;

        return $this;
    }

    public function getUtilisationDetails(): ?string
    {
        return $this->utilisationDetails;
    }

    public function setUtilisationDetails(?string $utilisationDetails): self
    {
        $this->utilisationDetails = $utilisationDetails;

        return $this;
    }

    public function getBudget(): ?bool
    {
        return $this->budget;
    }

    public function setBudget(?bool $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getGap(): ?string
    {
        return $this->gap;
    }

    public function setGap(?string $gap): self
    {
        $this->gap = $gap;

        return $this;
    }

    public function getCommand(): ?Command
    {
        return $this->command;
    }

    public function setCommand(Command $command): self
    {
        $this->command = $command;

        return $this;
    }

    public function getCommandConfigData(): ?CommandConfigData
    {
        return $this->commandConfigData;
    }

    public function setCommandConfigData(CommandConfigData $commandConfigData): self
    {
        $this->commandConfigData = $commandConfigData;

        return $this;
    }

    public function getCommandSpecData(): ?CommandSpecData
    {
        return $this->commandSpecData;
    }

    public function setCommandSpecData(CommandSpecData $commandSpecData): self
    {
        $this->commandSpecData = $commandSpecData;

        return $this;
    }

    public function getCommandDeviceData(): ?CommandDeviceData
    {
        return $this->commandDeviceData;
    }

    public function setCommandDeviceData(CommandDeviceData $commandDeviceData): self
    {
        $this->commandDeviceData = $commandDeviceData;

        return $this;
    }
}
