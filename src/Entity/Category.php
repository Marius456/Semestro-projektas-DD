<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="category")
     */
    private $events;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="subscribedCategories")
     */
    private $subscribedUsers;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->subscribedUsers = new ArrayCollection();
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

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setCategory($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getCategory() === $this) {
                $event->setCategory(null);
            }
        }

        return $this;
    }


    public function __toString(): string
    {
        return $this->name;
    }

            /**
     * @return mixed
     */
    public function getSubscribedUsers()
    {
        return $this->subscribedUsers;
    }

    /**
     * @param mixed $category
     */
       public function addSubscribedUser(?User $user)
    {
        if(!$this->getSubscribedUsers()->contains($user))
        $this->getSubscribedUsers()->add($user);
    }

        /**
     * @param mixed $category
     */
    public function removeSubscribedUser(?User $user)
    {
        if($this->getSubscribedUsers()->contains($user))
        $this->getSubscribedUsers()->removeElement($user);
    }
}
