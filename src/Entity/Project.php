<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("detail_project")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups("detail_project")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", name="started_at")
     * @Groups("detail_project")
     */
    private $startedAt;

    /**
     * @ORM\Column(type="datetime", name="ended_at", nullable=true)
     * @Groups("detail_project")
     */
    private $endedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("detail_project")
     */
    private $status;

    /**

     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="project")
     * @Groups("detail_project")
     */
    private $tasks;

    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeInterface $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeInterface $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }
    
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTasks()
    {
        return $this->tasks;
    }

    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

}
