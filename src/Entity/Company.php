<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Company extends User
{
    public function __construct()
    {
        $this->setRoles(['ROLE_COMPANY']);
    }
}
