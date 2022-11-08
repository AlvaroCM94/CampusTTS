<?php

namespace App\Controller\Admin;

use App\Entity\Material;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class MaterialCrudController extends AbstractCrudController

{
    public static function getEntityFqcn(): string
    {
        return Material::class;
    }

    public function configureFields(string $pageName): iterable{
        yield IdField::new('id') -> onlyOnIndex();
        yield AssociationField::new('id_curso');
        yield TextField::new('tema');
        yield TextField::new('titulo');
        yield TextField::new('enlace');
        yield TextareaField::new('descripcion');
        yield ChoiceField::new('tipo')->setChoices([
            'Video' => 'Video',
            'Imagen' => 'Imagen',
            'PDF' => 'PDF',
            'Power Point' => 'Power Point',
            'Word' => 'Word',
            'Enlace' => 'Enlace',
        ]);
        yield BooleanField::new('visibilidad') -> renderAsSwitch( false );
    }
}
