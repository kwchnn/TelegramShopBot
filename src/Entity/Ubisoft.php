<?php
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ubisoft")
 * @ORM\Entity
 */
class Ubisoft
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
     * @ORM\Column(name="game", type="integer", nullable=false)
     */
    private $game;

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", nullable=false)
     */
    private $sort;

    /**
     * @var string
     *
     * @ORM\Column(name="account_name", type="string", nullable=false)
     */
    private $accountName;

    /**
     * @var string
     *
     * @ORM\Column(name="account_password", type="string", nullable=false)
     */
    private $accountPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="secret_question", type="string", nullable=true)
     */
    private $secretQuestion;

    /**
     * @var string
     *
     * @ORM\Column(name="date_added", type="datetime", columnDefinition="TIMESTAMP DEFAULT CURRENT_TIMESTAMP")
     */
    private $dateAdded;

    /**
     * @var bool
     *
     * @ORM\Column(name="account_is_enable", type="boolean", nullable=false)
     */
    private $accountIsEnable = true;

    public function setGame(string $game)
    {
        $this->game = $game;

        return $this;
    }
    
    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setSort(int $sort)
    {
        $this->sort = $sort;

        return $this;
    }
    
    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setAccountName(string $accountName)
    {
        $this->accountName = $accountName;

        return $this;
    }
    
    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    public function setAccountPassword(string $accountPassword)
    {
        $this->accountPassword = $accountPassword;

        return $this;
    }
    
    public function getAccountPassword(): ?string
    {
        return $this->accountPassword;
    }

    public function setSecretQuestion(string $secretQuestion)
    {
        $this->secretQuestion = $secretQuestion;

        return $this;
    }
    
    public function getSecretQuestion(): ?string
    {
        return $this->secretQuestion;
    }

    public function setAccountIsEnable(bool $accountIsEnable)
    {
        $this->accountIsEnable = $accountIsEnable;

        return $this;
    }
    
    public function getAccountIsEnable(): ?bool
    {
        return $this->accountIsEnable;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function isAccountIsEnable(): ?bool
    {
        return $this->accountIsEnable;
    }

}