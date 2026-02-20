<?php

namespace Wapplersystems\WsQuicklinks\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Quicklink extends AbstractEntity
{
    protected string $name = '';
    protected string $link = '';

    /**
     *
     * @var ObjectStorage<FileReference>
     */
    protected ?ObjectStorage $icon = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getIcon(): ?ObjectStorage
    {
        return $this->icon;
    }

    public function setIcon(?ObjectStorage $icon): void
    {
        $this->icon = $icon;
    }


}
