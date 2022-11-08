<?php

namespace App\Controller\Admin;

use App\Entity\InstructorUsuario;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class InstructorUsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InstructorUsuario::class;
    }


    public function configureFields(string $pageName): iterable{
        yield IdField::new('id') -> onlyOnIndex();
        yield AssociationField::new('instructor');
        yield AssociationField::new('alumno');
        yield BooleanField::new('activo') -> renderAsSwitch( false );
    }
}
