<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Customer extends User
{
    public function __construct()
    {
        $this->setRoles(['ROLE_CUSTOMER']);
    }
}
