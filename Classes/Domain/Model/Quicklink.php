<?php

namespace Wapplersystems\Quicklinks\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Quicklink extends AbstractEntity
{
    protected string $name = '';
    protected string $icon = '';
    protected string $link = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }
}
