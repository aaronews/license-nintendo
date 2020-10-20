<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 * @UniqueEntity("slug", message="errors.form.common.slug.already_used")
 */
abstract class AbstractDisplayableEntity extends AbstractEntity
{

    const SLUG_PATTERN = '^[a-z0-9]+(\-{1}[a-z0-9]+)*$';

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Length(
     *      min=3,
     *      max=255,
     *      minMessage="errors.form.common.name.to_short",
     *      maxMessage="errors.form.common.name.to_long"
     * )
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Image
     */
    private $thumbnail;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Expression(
     *     "preg_match(self::SLUG_PATTERN, value)",
     *     message="errors.form.common.slug.bad_format"
     * )
     */
    private $slug;

    /**
     * Get name value
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name value
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description value
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description value
     *
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get thumbnail value
     *
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * Set thumbnail value
     *
     * @param string $thumbnail
     * @return self
     */
    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get slug value
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Set slug value
     *
     * @param string $slug
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
