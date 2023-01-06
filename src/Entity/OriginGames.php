<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="origin_games")
 *  @ORM\Entity(repositoryClass="App\Repository\OriginGamesRepository")
 */
class OriginGames
{

     /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

     /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="game_available", type="boolean", nullable=false)
     */
    private $gameAvailable = true;

    /**
     * @var int
     *
     * @ORM\Column(name="game_price", type="integer", nullable=false)
     */
    private $gamePrice;

    /**
     * @var int
     *
     * @ORM\Column(name="game_id", type="integer", nullable=false)
     */
    private $gameId;

    /**
     * @var Origin[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Origin", mappedBy="origin_games")
     */
    private $origin;

    public function __construct()
    {
        $this->origin = new ArrayCollection();
    }

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

    public function isGameAvailable(): ?bool
    {
        return $this->gameAvailable;
    }

    public function setGameAvailable(bool $gameAvailable): self
    {
        $this->gameAvailable = $gameAvailable;

        return $this;
    }

    /**
     * @return Collection<int, Origin>
     */
    public function getOrigin(): Collection
    {
        return $this->origin;
    }

    public function addOrigin(Origin $origin): self
    {
        if (!$this->origin->contains($origin)) {
            $this->origin>add($origin);
            $origin->setOriginGames($this);
        }

        return $this;
    }

    public function removeOrigin(Origin $origin): self
    {
        if ($this->origin->removeElement($origin)) {
            // set the owning side to null (unless already changed)
            if ($origin->getOriginGames() === $this) {
                $origin->setOriginGames(null);
            }
        }

        return $this;
    }

    public function getGamePrice(): ?int
    {
        return $this->gamePrice;
    }

    public function setGamePrice(int $gamePrice): self
    {
        $this->gamePrice = $gamePrice;

        return $this;
    }

    public function getGameId(): ?int
    {
        return $this->gameId;
    }

    public function setGameId(int $gameId): self
    {
        $this->gameId = $gameId;

        return $this;
    }
}