<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="order_history")
 * @ORM\Entity
 */
class OrderHistory
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
     * @ORM\Column(name="account_type", type="string", nullable=false)
     */
    private $accountType;

    /**
     * @var string
     *
     * @ORM\Column(name="account_game", type="string", nullable=false)
     */
    private $accountGame;

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
     * @ORM\Column(name="account_security_question", type="string", nullable=true)
     */
    private $accountSecurityQuestion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserProfile", inversedBy="order_history")
     */
    private $user_profile;

    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    public function setAccountName(string $accountName)
    {
        $this->accountName = $accountName;

        return $this;
    }

    public function getAccountGame(): ?string
    {
        return $this->accountGame;
    }

    public function setAccountGame(string $accountGame)
    {
        $this->accountGame = $accountGame;

        return $this;
    }

    public function getAccountPassword(): ?string
    {
        return $this->accountPassword;
    }

    public function setAccountPassword(string $accountPassword)
    {
        $this->accountPassword = $accountPassword;

        return $this;
    }

    public function getAccountSecurityQuestion(): ?string
    {
        return $this->accountSecurityQuestion;
    }

    public function setAccountSecurityQuestion(string $accountSecurityQuestion)
    {
        $this->accountSecurityQuestion = $accountSecurityQuestion;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccountType(): ?string
    {
        return $this->accountType;
    }

    public function setAccountType(string $accountType): self
    {
        $this->accountType = $accountType;

        return $this;
    }

    public function getUserProfile(): ?UserProfile
    {
        return $this->user_profile;
    }

    public function setUserProfile(?UserProfile $user_profile): self
    {
        $this->user_profile = $user_profile;

        return $this;
    }
}