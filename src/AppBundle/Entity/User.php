<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersRepository")
 * @ORM\Table(name="users")
 * @UniqueEntity("phone",message="form.phone.unique")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     * @Assert\NotBlank(message="form.name.not_blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "form.surname.min",
     *      maxMessage = "form.surname.max"
     * )
     * @ORM\Column(name="name",type="string",length=255,nullable=false)
     */
    protected $name;

    /**
     * @var string $surname
     * @Assert\NotBlank(message="form.surname.not_blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "form.name.min",
     *      maxMessage = "form.name.max"
     * )
     * @ORM\Column(name="surname",type="string",length=255,nullable=false)
     */
    protected $surname;

    /**
     * @var string $website
     * @Assert\Url(message="form.website.url")
     * @ORM\Column(name="website",type="string",length=255,nullable=true)
     */
    protected $website;

    /**
     * @var string $phone
     * @Assert\NotBlank(message="form.phone.not_blank")
     * @Assert\Regex(
     *     pattern="/^0[1-689][0-9]{8}$/i",
     *     htmlPattern="^0[1-689][0-9]{8}$",
     *     message="form.phone.valid"
     * )
     * @ORM\Column(name="phone",type="string",nullable=false)
     */
    protected $phone;

    /**
     * @var string $address
     * @Assert\NotBlank(message="form.address.not_blank")
     * @Assert\Length(
     *      min = 20,
     *      minMessage = "form.address.min",
     * )
     * @ORM\Column(name="address",type="text",length=455,nullable=false)
     */
    protected $address;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Contact", mappedBy="sender")
     */
    protected $senders;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Contact", mappedBy="receiver")
     */
    protected $receivers;

    public function __construct()
    {
        parent::__construct();
        $this->receivers = new ArrayCollection();
        $this->senders = new ArrayCollection();
    }



    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return User
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add senders
     *
     * @param \AppBundle\Entity\Contact $senders
     * @return User
     */
    public function addSender(\AppBundle\Entity\Contact $senders)
    {
        $this->senders[] = $senders;

        return $this;
    }

    /**
     * Remove senders
     *
     * @param \AppBundle\Entity\Contact $senders
     */
    public function removeSender(\AppBundle\Entity\Contact $senders)
    {
        $this->senders->removeElement($senders);
    }

    /**
     * Get senders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSenders()
    {
        return $this->senders;
    }

    /**
     * Add receivers
     *
     * @param \AppBundle\Entity\Contact $receivers
     * @return User
     */
    public function addReceiver(\AppBundle\Entity\Contact $receivers)
    {
        $this->receivers[] = $receivers;

        return $this;
    }

    /**
     * Remove receivers
     *
     * @param \AppBundle\Entity\Contact $receivers
     */
    public function removeReceiver(\AppBundle\Entity\Contact $receivers)
    {
        $this->receivers->removeElement($receivers);
    }

    /**
     * Get receivers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReceivers()
    {
        return $this->receivers;
    }
}
