<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="user_profile")
 * @ORM\Entity(repositoryClass="App\Repository\UserProfileRepository")
 * @UniqueEntity("tgUserId")
 */
class UserProfile
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
     * @var int
     *
     * @ORM\Column(name="tg_user_id", type="integer", nullable=false, unique=true)
     */
    private $tgUserId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", nullable=false)
     */
    private $userName;

    /**
     * @var int
     *
     * @ORM\Column(name="buy_count", type="integer", nullable=false)
     */
    private $buyCount;

    /**
     * @var float
     *
     * @ORM\Column(name="account_balance", type="float", nullable=false)
     */
    private $accountBalance;

    /**
     * @var int
     *
     * @ORM\Column(name="last_game_id", type="integer", nullable=false)
     */
    private $lastGameId;

    /**
     * @var OrderHistory[]
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\OrderHistory", mappedBy="user_profile")
     */
    private $order_history;

    public function __construct()
    {
        $this->order_history = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTgUserId(int $tgUserId)
    {
        $this->tgUserId = $tgUserId;

        return $this;
    }
    
    public function getTgUserId(): ?int
    {
        return $this->tgUserId;
    }

    public function setUserName(string $userName)
    {
        $this->userName = $userName;

        return $this;
    }
    
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setBuyCount(int $buyCount)
    {
        $this->buyCount = $buyCount;

        return $this;
    }
    
    public function getBuyCount(): ?int
    {
        return $this->buyCount;
    }

    /**
     * @return Collection<int, OrderHistory>
     */
    public function getOrderHistory(): Collection
    {
        return $this->order_history;
    }

    public function addOrderHistory(OrderHistory $orderHistory): self
    {
        if (!$this->order_history->contains($orderHistory)) {
            $this->order_history->add($orderHistory);
            $orderHistory->setUserProfile($this);
        }

        return $this;
    }

    public function removeOrderHistory(OrderHistory $orderHistory): self
    {
        if ($this->order_history->removeElement($orderHistory)) {
            // set the owning side to null (unless already changed)
            if ($orderHistory->getUserProfile() === $this) {
                $orderHistory->setUserProfile(null);
            }
        }

        return $this;
    }

    public function getAccountBalance(): ?float
    {
        return $this->accountBalance;
    }

    public function setAccountBalance(float $accountBalance): self
    {
        $this->accountBalance = $accountBalance;

        return $this;
    }

    public function setLastGameId(int $lastGameId)
    {
        $this->lastGameId = $lastGameId;

        return $this;
    }

    public function getLastGameId(): ?int
    {
        return $this->lastGameId;
    }
}