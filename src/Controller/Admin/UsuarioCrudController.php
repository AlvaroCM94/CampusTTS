<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use App\Form\AltaFormType;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordEncoderInterface;

class UsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }

    public function configureFields(string $pageName): iterable{

        yield IdField::new('id') -> onlyOnIndex();
        yield BooleanField::new('tramitado');
        yield TextField::new('nombre');
        //yield TextField::new('apellidos');
        yield EmailField::new('email');
        yield ArrayField::new('roles') -> onlyOnIndex();
        yield BooleanField::new('comunicaciones') -> renderAsSwitch( false );
        yield BooleanField::new('procesar_almacenar_datos') -> renderAsSwitch( false );

    }

    public function configureActions(Actions $actions): Actions{
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setTemplatePath('admin/botonAltaAdmin.html.twig');
            })
            // ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
            //     return $action->setTemplatePath('admin/botonEditarAdmin.html.twig');
            // })
            ->add(Crud::PAGE_EDIT, Action::DETAIL)
            ->update(Crud::PAGE_EDIT, Action::DETAIL, function (Action $action) {
                return $action->setTemplatePath('admin/botonEditarAdmin.html.twig');
            })
        ;
    }

}
