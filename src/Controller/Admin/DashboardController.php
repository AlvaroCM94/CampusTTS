<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Curso;
use App\Entity\CompetenciaBasica;
use App\Entity\CompetenciaEspecifica;
use App\Entity\CompetenciaGenerales;
use App\Entity\InstructorUsuario;
use App\Entity\Lugares;
use App\Entity\Material;
use App\Entity\Objetivo;
use App\Entity\Reserva;
use App\Entity\TablaContenidos;
use App\Entity\UsuarioCurso;
use App\Entity\Usuario;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            -> setTitle('Administración TTS')
            -> setTranslationDomain('spanish');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Usuario', 'fas fa-user', Usuario::class);
        yield MenuItem::linkToCrud('Instructores y Usuarios', 'fas fa-users', InstructorUsuario::class);
        yield MenuItem::linkToCrud('Usuarios y sus cursos', 'fas fa-users', UsuarioCurso::class);
        yield MenuItem::linkToCrud('Reservas', 'fas fa-file', Reserva::class);
        yield MenuItem::linkToCrud('Lugares', 'fas fa-map', Lugares::class);
        yield MenuItem::linkToCrud('Cursos', 'fas fa-folder', Curso::class);
        yield MenuItem::linkToCrud('Objetivos', 'fas fa-list', Objetivo::class);
        yield MenuItem::linkToCrud('Competencias Basicas', 'fas fa-list', CompetenciaBasica::class);
        yield MenuItem::linkToCrud('Competencias Generales', 'fas fa-list', CompetenciaGenerales::class);
        yield MenuItem::linkToCrud('Competencias Especificas', 'fas fa-list', CompetenciaEspecifica::class);
        yield MenuItem::linkToCrud('Tabla de Contenidos', 'fas fa-list', TablaContenidos::class);
        yield MenuItem::linkToCrud('Materiales', 'fas fa-list', Material::class);
        yield MenuItem::linkToRoute('Volver', 'fas fa-arrow-left', 'campusUsuario');
    }
}
