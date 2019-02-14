<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PreRemove;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Application
{   

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(
     *  min= 4,
     *  max = 20,
     *  minMessage = "Le nom du candidat doit comporter au moins {{ limit }} caractères ",
     *  maxMessage = "Le nom du candidat ne peut pas comporter plus de {{ limit }} caractères"
     * )
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(
     *  min= 15,
     *  max = 255,
     *  minMessage = "Votre message doit comporter au moins {{ limit }} caractères ",
     *  maxMessage = "Votre message ne peut pas comporter plus de {{ limit }} caractères"
     * )
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

      /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Advert", inversedBy="application")
   * @ORM\JoinColumn(nullable=false)
   */
    private $advert;

    public function __construct()
    {
        $this->date  = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAdvert(): ?Advert
    {
        return $this->advert;
    }

    public function setAdvert(?Advert $advert): self
    {
        $this->advert = $advert;

        return $this;
    }

    /**
   * @ORM\PrePersist
   */
    public function increase()
    {
        $this->getAdvert()->increaseApplication();
    }

    /**
   * @ORM\PreRemove
   */
    public function decrease()
    {
        $this->getAdvert()->decreaseApplication();
    }



    /**
     * @Assert\Callback
     */
    public function isContentValid(ExecutionContextInterface $context)
    {
      $forbiddenWords = array('démotivation', 'abandon', 'chauffe');

      if (preg_match('#'.implode('|', $forbiddenWords).'#', $this->getContent())) {

        $context
          ->buildViolation('Contenu invalide car il contient un mot interdit.') 
          ->atPath('content')                                                   
          ->addViolation() // ceci déclenche l'erreur, ne l'oubliez pas
        ;
      }
    }
}
