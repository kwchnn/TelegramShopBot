<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="blizzard_games")
 *  @ORM\Entity(repositoryClass="App\Repository\BlizzardGamesRepository")
 */
class BlizzardGames
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
     * @var Blizzard[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Blizzard", mappedBy="blizzard_games")
     */
    private $blizzard;

    public function __construct()
    {
        $this->blizzard = new ArrayCollection();
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

    public function getGameId(): ?int
    {
        return $this->gameId;
    }

    public function setGameId(int $gameId): self
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * @return Collection<int, Blizzard>
     */
    public function getBlizzard(): Collection
    {
        return $this->blizzard;
    }

    public function addBlizzard(Blizzard $blizzard): self
    {
        if (!$this->blizzard->contains($blizzard)) {
            $this->blizzard->add($blizzard);
            $blizzard->setBlizzardGames($this);
        }

        return $this;
    }

    public function removeBlizzard(Blizzard $blizzard): self
    {
        if ($this->blizzard->removeElement($blizzard)) {
            // set the owning side to null (unless already changed)
            if ($blizzard->getBlizzardGames() === $this) {
                $blizzard->setBlizzardGames(null);
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
    
}