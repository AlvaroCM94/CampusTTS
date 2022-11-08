<?php

namespace App\Controller\Admin;

use App\Entity\UsuarioCurso;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class UsuarioCursoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UsuarioCurso::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        yield AssociationField::new('id_usuario');
        yield AssociationField::new('id_curso');
        yield ChoiceField::new('estado')->setChoices([
            '0 Curso sin pasos' => '0 Curso sin pasos',
            '1 Cuestionario inicial' => '1 Cuestionario inicial',
            '2 Reserva autoevaluación' => '2 Reserva autoevaluación',
            '2.1 Esperando confirmación de reserva' => '2.1 Esperando confirmación de reserva',
            '2.2 Reserva confirmada' => '2.2 Reserva confirmada',
            '3 Espera resultados autoevaluación' => '3 Espera resultados autoevaluación',
            '4 Explicación videoconferencia' => '4 Explicación videoconferencia',
            '5 Material entrenamiento' => '5 Material entrenamiento',
            '6 Examen' => '6 Examen',
            '7 Reserva entrenamientos' => '7 Reserva entrenamientos',
            '8 Videos' => '8 Videos',
            '9 Horario talleres' => '9 Horario talleres',
            '10 Acreditación en PDF' => '10 Acreditación en PDF',

        ]);
    }

    public function configureCrud(Crud $crud): Crud{
        return $crud;
    }
}
