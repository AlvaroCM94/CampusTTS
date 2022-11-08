<?php

namespace App\Controller\Admin;

use App\Entity\CompetenciaEspecifica;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class CompetenciaEspecificaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CompetenciaEspecifica::class;
    }

    public function configureFields(string $pageName): iterable{
        yield IdField::new('id') -> onlyOnIndex();
        yield AssociationField::new('id_curso');
        yield TextareaField::new('descripcion');
    }
}
