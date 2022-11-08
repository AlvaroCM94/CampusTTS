<?php

namespace App\Controller\Admin;

use App\Entity\Lugares;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LugaresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lugares::class;
    }

    public function configureFields(string $pageName): iterable{
        yield IdField::new('id') -> onlyOnIndex();
        yield TextField::new('nombre');
        yield TextField::new('coordenadas');
    }
}
