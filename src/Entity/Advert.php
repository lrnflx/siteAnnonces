<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdvertRepository")
 * @UniqueEntity("title")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="title", message="Une annonce existe déjà avec ce titre.")
 */
 
class Advert
{
    public function __construct()
    {
        $this->application = new ArrayCollection();
        $this->advertSkills = new ArrayCollection();
        $this->skills = new ArrayCollection();
    }


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *  min= 5,
     *  max = 30,
     *  minMessage = "Le titre de l'offre doit comporter au moins {{ limit }} caractères",
     *  maxMessage = "Le titre de l'offre ne peut pas comporter plus de {{ limit }} "
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *  min= 30,
     *  max = 500,
     *  minMessage = "La description de l'offre doit comporter au moins {{ limit }} caractères",
     *  maxMessage = "La description de l'offre ne peut pas comporter plus de {{ limit }} "
     * )
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published;
    


    // Création d'un champs de liaison vers entité Image
      /**
    * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $image;

   
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Application", mappedBy="advert")
    * @ORM\JoinColumn(nullable=false)
    */
    private $application;

    /**
    * @ORM\Column(name="nb_applications", type="integer")
    */
    private $nbApplications = 0;


   
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdvertSkill", mappedBy="advert", cascade={"persist" , "remove"})
     */
    private $skills;

 
    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplication(): Collection
    {
        return $this->application;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->application->contains($application)) {
            $this->application[] = $application;
            $application->setAdvert($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->application->contains($application)) {
            $this->application->removeElement($application);
            // set the owning side to null (unless already changed)
            if ($application->getAdvert() === $this) {
                $application->setAdvert(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AdvertSkill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(AdvertSkill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setAdvert($this);
        }

        return $this;
    }

    public function removeSkill(AdvertSkill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
            // set the owning side to null (unless already changed)
            if ($skill->getAdvert() === $this) {
                $skill->setAdvert(null);
            }
        }

        return $this;
    }
    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->date = new \DateTime();
    }


        
    /**
    * @ORM\PreUpdate
    */
    // public function preUpdate()
    // {
    //     $this->updateAt= new \DateTime();
    // }
    
    public function increaseApplication()
    {
        $this->nbApplications++;
    }
  
    public function decreaseApplication()
    {
        $this->nbApplications--;
    }
    
    /**
    * @param integer $nbApplications
    */
    public function setNbApplications($nbApplications)
    {
        $this->nbApplications = $nbApplications;
    }

    /**
    * @return integer
    */
    public function getNbApplications()
    {
        return $this->nbApplications;
    }
}
