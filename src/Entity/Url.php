<?php

namespace App\Entity;

use App\Repository\UrlRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\UrlStatistic;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UrlRepository::class)]
class Url
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $hash = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    #[ORM\Column(length: 255)]
    private ?string $longUrl = null;

    #[ORM\Column(length: 255)]
    private ?string $domain = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\ManyToOne(targetEntity: \App\Entity\User::class, inversedBy: 'urls')]
    #[ORM\JoinColumn(nullable: true)] // ou nullable: true si ce n'est pas obligatoire
    private ?\App\Entity\User $user = null;

    #[ORM\OneToMany(mappedBy: 'url', targetEntity: UrlStatistic::class, orphanRemoval: true)]
    private Collection $statistics;

    public function __construct()
    {
        $this->statistics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): static
    {
        $this->hash = $hash;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getLongUrl(): ?string
    {
        return $this->longUrl;
    }

    public function setLongUrl(string $longUrl): static
    {
        $this->longUrl = $longUrl;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    
    public function getUser(): ?\App\Entity\User
    {
        return $this->user;
    }

    public function setUser(?\App\Entity\User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, \App\Entity\UrlStatistic>
     */
    public function getStatistics(): Collection
    {
        return $this->statistics;
    }

    public function addStatistic(\App\Entity\UrlStatistic $statistic): static
    {
        if (!$this->statistics->contains($statistic)) {
            $this->statistics->add($statistic);
            $statistic->setUrl($this);
        }

        return $this;
    }

    public function removeStatistic(\App\Entity\UrlStatistic $statistic): static
    {
        if ($this->statistics->removeElement($statistic)) {
            if ($statistic->getUrl() === $this) {
                $statistic->setUrl(null);
            }
        }

        return $this;
    }

    public function getAllClicks(): int
    {
        $clicks = 0;

        foreach ($this->statistics as $statistic) {
            $clicks += $statistic->getClicks() ?? 0;
        }

        return $clicks;
    }
    
}