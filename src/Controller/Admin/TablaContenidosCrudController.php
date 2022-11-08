<?php

namespace App\Controller\Admin;

use App\Entity\TablaContenidos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class TablaContenidosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TablaContenidos::class;
    }

    public function configureFields(string $pageName): iterable{
        yield IdField::new('id') -> onlyOnIndex();
        yield AssociationField::new('id_curso');
        yield TextField::new('titulo');
        yield TextareaField::new('descripcion');
    }
}
