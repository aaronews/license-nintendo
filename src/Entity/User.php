<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *  fields={"username"},
 *  message="errors.form.users.not_unique"
 * )
 */
class User extends AbstractEntity implements UserInterface
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\Email
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", message="errors.form.users.password.bad_format")
     */
    private $password;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    private $active = false;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @var string
     * @Assert\EqualTo(propertyPath="password", message="errors.form.users.password.not_same")
     */
    private $confirmPassword;

    /**
     * @var array
     * @ORM\Column(type="text", length=255)
     */
    private $roles;

    /**
     * Get id value
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get username value
     *
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set username value
     *
     * @param string $username
     * @return self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get password value
     *
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set password value
     *
     * @param string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get active value
     *
     * @return boolean|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * Set active value
     *
     * @param boolean $active
     * @return self
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get token value
     *
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set token value
     *
     * @param string|null $token
     * @return self
     */
    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get confirm password value
     *
     * @return string|null
     */
    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    /**
     * Set confirm password value
     *
     * @param string $confirmPassword
     * @return self
     */
    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    
    public function getSalt(){}

    
    public function eraseCredentials(){}

    /**
     * Get roles list
     *
     * @return array
     */
    public function getRoles(): array
    {
        return array_unique(array_merge(['ROLE_USER'], json_decode($this->roles)));
    }

    /**
     * Set roles value
     *
     * @param array|null $roles
     * @return self
     */
    public function setRoles(?array $roles): self
    {
        if($roles === null){
            $this->roles = json_encode(['ROLE_USER']);
        }else{
            $this->roles = json_encode($roles);
        }

        return $this;
    }
}
