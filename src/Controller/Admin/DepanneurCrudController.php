<?php

namespace App\Controller\Admin;

use App\Entity\Depanneur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DepanneurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Depanneur::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
