<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ubisoft_games")
 *  @ORM\Entity(repositoryClass="App\Repository\UbisoftGamesRepository")
 */
class UbisoftGames
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
     * @var Ubisoft[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Ubisoft", mappedBy="ubisoft_games")
     */
    private $ubisoft;

    public function __construct()
    {
        $this->ubisoft = new ArrayCollection();
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
     * @return Collection<int, Ubisoft>
     */
    public function getUbisoft(): Collection
    {
        return $this->ubisoft;
    }

    public function addUbisoft(Ubisoft $ubisoft): self
    {
        if (!$this->ubisoft->contains($ubisoft)) {
            $this->ubisoft>add($ubisoft);
            $ubisoft->setUbisoftGames($this);
        }

        return $this;
    }

    public function removeUbisoft(Ubisoft $ubisoft): self
    {
        if ($this->ubisoft->removeElement($ubisoft)) {
            // set the owning side to null (unless already changed)
            if ($ubisoft->getUbisoftGames() === $this) {
                $ubisoft->setUbisoftGames(null);
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