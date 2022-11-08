<?php

namespace App\Controller\Admin;

use App\Entity\Curso;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class CursoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Curso::class;
    }

    public function configureFields(string $pageName): iterable {

        yield IdField::new('id') -> onlyOnIndex();
        yield TextField::new('nombre');
        yield ChoiceField::new('etiqueta') -> setChoices([ 
            'Marketing Skills' => 'Marketing Skills',
            'VR' => 'VR',
            'Unreal' => 'Unreal',
            'SCE' => 'SCE',
        ]);
        yield NumberField::new('duracion', 'Duración (Horas)') -> onlyOnForms();
        yield ChoiceField::new('valoracion', 'Valoración') -> setChoices([ 
            1 => 1, 
            2 => 2, 
            3 => 3, 
            4 => 4, 
            5 => 5 
        ]);
        yield TextareaField::new('descripcion','Descripción') -> onlyOnForms();
        yield TextareaField::new('competencias') -> onlyOnForms();
        yield TextareaField::new('dinamicas') -> onlyOnForms();
        yield TextField::new('imagen');
        yield BooleanField::new('visibilidad') -> renderAsSwitch( false );

    }
}
