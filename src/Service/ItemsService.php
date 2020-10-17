<?php

namespace App\Service;

use App\Repository\ItemRepository;

class ItemsService extends AbstractEntityService 
{
    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }
}