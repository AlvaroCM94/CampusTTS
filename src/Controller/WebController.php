<?php

namespace App\Controller;

use App\Entity\CompetenciaBasica;
use App\Entity\CompetenciaEspecifica;
use App\Entity\CompetenciaGenerales;
use App\Entity\Curso;
use App\Entity\InstructorUsuario;
use App\Entity\Usuario;
use App\Entity\Lugares;
use App\Entity\Material;
use App\Entity\Reserva;
use App\Entity\Objetivo;
use App\Entity\TablaContenidos;
use App\Entity\UsuarioCurso;
use App\Form\AltaFormType;

use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Throwable;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class WebController extends AbstractController{

    /*
        ************************************************************************************************************************************
        WEB CONTROLLERS
        ************************************************************************************************************************************ 
    */

    public function navbar(): Response{

        return $this->render('components/navbar.html.twig');
    }

    public function home(): Response{

        return $this->render('web/home.html.twig');
    }

    public function softSkills(): Response{

        return $this->render('web/soft-skills.html.twig');
    }

    public function retos(): Response{

        return $this->render('web/retos.html.twig');
    }

    public function acompanamiento(): Response{

        return $this->render('web/acompanamiento.html.twig');
    }

    public function soluciones(): Response{

        return $this->render('web/soluciones-de-inteligencia.html.twig');
    }

    public function travelCrystalBall(): Response{

        return $this->render('web/travel-crystal-ball.html.twig');
    }

    public function contacto(EntityManagerInterface $em): Response{

        $error = "";

        try {

            $cursosActivos = $em->getRepository(Curso::class)->getAllCursos();
            //dd($cursosActivos[0]["nombre"]);

        } catch (Throwable $e) {

            // echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('web/contacto.html.twig', [
                'contoller_name' => 'WebController', 'error' => $error, 'cursosActivos' => $cursosActivos
            ]);
        }
    }

    public function travelTechSkills(EntityManagerInterface $em): Response{

        try {

            $cursos = $em->getRepository(Curso::class)->getAllCursos();
            // dd($cursos);
        } catch (Throwable $e) {

            // echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('web/travel-tech-skills/travel-tech-skills.html.twig', [
                'contoller_name' => 'WebController', 'cursos' => $cursos
            ]);
        }
    }

    public function infoDeCurso(): Response{

        return $this->render('web/travel-tech-skills/infoDeCurso.html.twig');
    }

    public function privacidad(): Response{

        return $this->render('web/privacidad.html.twig');
    }

    public function objetivos(EntityManagerInterface $em, int $id): Response{

        try {

            $objetivos = $em->getRepository(Curso::class)->objetivos($id);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('web/travel-tech-skills/objetivos.html.twig', [
                'contoller_name' => 'WebController', 'objetivos' => $objetivos
            ]);
        }
    }

    public function competenciasBasicas(EntityManagerInterface $em, int $id): Response{

        try {

            $competenciasBasicas = $em->getRepository(Curso::class)->competenciasBasicas($id);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('web/travel-tech-skills/competenciasBasicas.html.twig', [
                'contoller_name' => 'WebController', 'competenciasBasicas' => $competenciasBasicas
            ]);
        }
    }

    public function competenciasGenerales(EntityManagerInterface $em, int $id): Response{

        try {

            $competenciasGenerales = $em->getRepository(Curso::class)->competenciasGenerales($id);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('web/travel-tech-skills/competenciasGenerales.html.twig', [
                'contoller_name' => 'WebController', 'competenciasGenerales' => $competenciasGenerales
            ]);
        }
    }

    public function competenciasEspecificas(EntityManagerInterface $em, int $id): Response{

        try {

            $competenciasEspecificas = $em->getRepository(Curso::class)->competenciasEspecificas($id);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('web/travel-tech-skills/competenciasEspecificas.html.twig', [
                'contoller_name' => 'WebController', 'competenciasEspecificas' => $competenciasEspecificas
            ]);
        }
    }

    public function usuarios(EntityManagerInterface $em): Response{

        try {

            $prueba = $em->getRepository(Usuario::class)->usuarios();
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('web/travel-tech-skills/prueba.html.twig', [
                'contoller_name' => 'WebController', 'pruebas' => $prueba
            ]);
        }
    }

    public function landingNeuroliderazo(): Response{

        return $this->render('web/landings/2022/landingNeuroliderazgo2022.html.twig');
    
    }

    /*
        ************************************************************************************************************************************
        CAMPUS CONTROLLERS
        ************************************************************************************************************************************ 
    */


    // public function new(Request $request): Response{
    //     $usuario = new Usuario();

    //     // $form = $this->createFormBuilder($usuario)
    //     //     ->add('roles', TextType::class)
    //     //     ->add('password', PasswordType::class)
    //     //     ->add('email', TextType::class)
    //     //     ->getForm()
    //     // ;

    //     // return $this->renderForm('admin/crearUsuario.html.twig', [
    //     //     'form' => $form->createView(),
    //     // ]);

    //     $form = $this->createForm(AltaFormType::class, $usuario);

    //     return $this->renderForm('admin/crearUsuario.html.twig', [
    //         'form' => $form->createView(),
    //     ]);

    // }

    /*
        ************************************************************************************************************************************
        ADMIN PANEL
        ************************************************************************************************************************************
    */
    public function adminPanel(){

        return $this->render('admin/adminController/panelAdministracion.html.twig');
    }

                            /* 
                                USUARIO
                            */

    public function adminPanelUsuario(EntityManagerInterface $em){

        try {

            $allCursos = $em->getRepository(Curso::class)->getAllCursos();

            $usuarios = $em->getRepository(Usuario::class)->usuarios();
            //$cursos = $em->getRepository(Curso::class)->getAllInfoCursosNombreParaUnUsuario();

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('admin/adminController/contenidos/usuario.html.twig', ['usuarios' => $usuarios, 'allCursos' => $allCursos]);
        }
    }

    public function crearUser(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em){

        try {
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $rol = '["' . $_POST["rol"] . '"]';
            $tlf = $_POST["tlf"];
            $dni = $_POST["dni"];

            $contraseña = $_POST["password"];
            $aux = new Usuario();
            $cifrada = $passwordHasher->hashPassword($aux, $contraseña);

            $tramitado = isset($_POST["tramitado"]);
            if ($tramitado == false) {
                $tramitado = 0;
            } else if ($tramitado == true) {
                $tramitado = 1;
            }

            $comunicaciones = isset($_POST["comunicaciones"]);
            if ($comunicaciones == false) {
                $comunicaciones = 0;
            } else if ($comunicaciones == true) {
                $comunicaciones = 1;
            }

            $procesar_almacenar_datos = isset($_POST["procesar_almacenar_datos"]);
            if ($procesar_almacenar_datos == false) {
                $procesar_almacenar_datos = 0;
            } else if ($procesar_almacenar_datos == true) {
                $procesar_almacenar_datos = 1;
            }


            $em->getRepository(Usuario::class)->crearUsuario($nombre, $rol, $cifrada, $email, $comunicaciones, $procesar_almacenar_datos, $tramitado, $tlf, $dni);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function editUser(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em){

        try {
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];

            $tlf = $_POST["tlf"];
            $dni = $_POST["dni"];

            $tramitado = isset($_POST["tramitado"]);
            if ($tramitado == false) {
                $tramitado = 0;
            } else if ($tramitado == true) {
                $tramitado = 1;
            }

            $comunicaciones = isset($_POST["comunicaciones"]);
            if ($comunicaciones == false) {
                $comunicaciones = 0;
            } else if ($comunicaciones == true) {
                $comunicaciones = 1;
            }

            $procesar_almacenar_datos = isset($_POST["procesar_almacenar_datos"]);
            if ($procesar_almacenar_datos == false) {
                $procesar_almacenar_datos = 0;
            } else if ($procesar_almacenar_datos == true) {
                $procesar_almacenar_datos = 1;
            }

            $contraseña = $_POST["password"];
            if ($contraseña != "") {
                $aux = new Usuario();
                $cifrada = $passwordHasher->hashPassword($aux, $contraseña);
                $em->getRepository(Usuario::class)->actualizarConPass($id, $nombre, $cifrada, $email, $comunicaciones, $procesar_almacenar_datos, $tramitado, $tlf, $dni);
            } else {
                $res = $em->getRepository(Usuario::class)->actualizarSinPass($id, $nombre, $email, $comunicaciones, $procesar_almacenar_datos, $tramitado, $tlf, $dni);
            }
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function deleteUser(EntityManagerInterface $em){

        try {

            $id = $_POST["id"];

            $em->getRepository(Usuario::class)->borrarUser($id);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function inscribirUser(EntityManagerInterface $em){

        $id = $_POST["id"];
        $curso = $_POST["curso"];
        $tipo = $_POST["tipo"];
        //dd($tipo);

        try {

            $res = $em->getRepository(UsuarioCurso::class)->inscribirUser($id, $curso, $tipo);
            //dd($res);

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {
            //dd($cursos);
            return $this->render('admin/adminController/panelAdministracion.html.twig');
        }
    }

    public function cursosParaUnUser(EntityManagerInterface $em, $idUser){

        $cursos = array();

        try {

            $allCursos = $em->getRepository(Curso::class)->getAllCursos();

            $ids = $em->getRepository(Curso::class)->getAllInfoCursosNombreParaUnUsuario($idUser);
            for ($i = 0; $i < count($ids); ++$i) {

                $aux = $em->getRepository(Curso::class)->getAllCursosNombresPorId($ids[$i]["id_curso_id"]);
                $cursos[] = $aux[0];
            }
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {
            //dd($cursos);
            return $this->render('admin/adminController/contenidos/usuarioCursos.html.twig', ['cursos' => $cursos, 'allCursos' => $allCursos]);
        }
    }

    public function reservasParaUnUser(EntityManagerInterface $em, $idUser){

        try {

            $lugares = array();

            $reservas = $em->getRepository(Reserva::class)->getAllReservasPorId($idUser);
            $idLugares = $em->getRepository(Reserva::class)->getAllIdLugaresPorIdUser($idUser);
            for ($i = 0; $i < count($idLugares); ++$i) {
                $aux = $em->getRepository(Lugares::class)->getLugaresNombrePorId($idLugares[$i]["lugar_id"]);
                $lugares[] = $aux[0];
            }
            //dd($lugares);

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('admin/adminController/contenidos/usuarioReservas.html.twig', ['reservas' => $reservas, 'lugares' => $lugares]);
        }
    }

    public function alumnosDeUnInstructor(EntityManagerInterface $em, $idUser){

        try {

            $alumnos = array();

            $idAlumnos = $em->getRepository(InstructorUsuario::class)->getAlumnosIdPorInstructorIdYActivos($idUser);
            for ($i = 0; $i < count($idAlumnos); ++$i) {
                $aux = $em->getRepository(Usuario::class)->getAlumnosPorId($idAlumnos[$i]["alumno_id"]);
                $alumnos[] = $aux[0];
            }
            //dd($alumnos);

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('admin/adminController/contenidos/usuarioAlumnos.html.twig', ['alumnos' => $alumnos]);
        }
    }
                                /* 
                                    CURSO
                                */


    public function adminPanelCurso(EntityManagerInterface $em){

        try {

            $cursos = $em->getRepository(Curso::class)->getAllCursos();

            $usuarios = $em->getRepository(Usuario::class)->usuarios();
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('admin/adminController/contenidos/curso.html.twig', ['usuarios' => $usuarios, 'cursos' => $cursos]);
        }
    }

    public function crearCurso(EntityManagerInterface $em){

        try {
            $nombre = $_POST["nombre"];
            $etiqueta = $_POST["etiqueta"];
            $dura = $_POST["dura"];
            $valo = $_POST["valo"];
            $descrip = $_POST["descrip"];
            $compe = $_POST["compe"];
            $dina = $_POST["dina"];
            $img = $_POST["img"];

            $visibilidad = isset($_POST["visibilidad"]);
            if ($visibilidad == false) {
                $visibilidad = 0;
            } else if ($visibilidad == true) {
                $visibilidad = 1;
            }

            $em->getRepository(Curso::class)->crearCurso($nombre, $etiqueta, $dura, $valo, $descrip, $compe, $dina, $img, $visibilidad);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function editCurso(EntityManagerInterface $em){

        try {
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $etiqueta = $_POST["etiqueta"];
            $dura = $_POST["dura"];
            $valo = $_POST["valo"];
            $descrip = $_POST["descrip"];
            $compe = $_POST["compe"];
            $dina = $_POST["dina"];
            $img = $_POST["img"];

            $visibilidad = isset($_POST["visibilidad"]);
            if ($visibilidad == false) {
                $visibilidad = 0;
            } else if ($visibilidad == true) {
                $visibilidad = 1;
            }

            $em->getRepository(Curso::class)->editarCurso($id, $nombre, $etiqueta, $dura, $valo, $descrip, $compe, $dina, $img, $visibilidad);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function deleteCurso(EntityManagerInterface $em){

        try {

            $id = $_POST["id"];

            $em->getRepository(Curso::class)->borrarCurso($id);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

                                /* 
                                    Competencia Basica
                                */

    public function CBParaUnCurso(EntityManagerInterface $em, $idCurso){

        try {

            $cb = $em->getRepository(CompetenciaBasica::class)->getAllCBParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('admin/adminController/contenidos/cursoCB.html.twig', ['cbs' => $cb, 'idCurso' => $idCurso]);
        }
    }

    public function addCBParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $desc = $_POST["desc"];
            $em->getRepository(CompetenciaBasica::class)->addCBParaUnCurso($idCurso, $desc);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function editCBParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $desc = $_POST["desc"];
            $em->getRepository(CompetenciaBasica::class)->editCBParaUnCurso($idCurso, $desc);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function deleteCBParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $em->getRepository(CompetenciaBasica::class)->deleteCBParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

                                /* 
                                    Competencia Especifica
                                */

    public function CEParaUnCurso(EntityManagerInterface $em, $idCurso){

        try {

            $ce = $em->getRepository(CompetenciaEspecifica::class)->getAllCEParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {
            //dd($cb);
            return $this->render('admin/adminController/contenidos/cursoCE.html.twig', ['ces' => $ce, 'idCurso' => $idCurso]);
        }
    }

    public function addCEParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $desc = $_POST["desc"];
            $em->getRepository(CompetenciaEspecifica::class)->addCEParaUnCurso($idCurso, $desc);            

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function editCEParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $desc = $_POST["desc"];
            $em->getRepository(CompetenciaEspecifica::class)->editCEParaUnCurso($idCurso, $desc);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function deleteCEParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $em->getRepository(CompetenciaEspecifica::class)->deleteCEParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

                                /* 
                                    Competencia General
                                */

    public function CGParaUnCurso(EntityManagerInterface $em, $idCurso){

        try {

            $cg = $em->getRepository(CompetenciaGenerales::class)->getAllCGParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('admin/adminController/contenidos/cursoCG.html.twig', ['cgs' => $cg, 'idCurso' => $idCurso]);
        }
    }

    public function addCGParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $desc = $_POST["desc"];
            $em->getRepository(CompetenciaGenerales::class)->addCGParaUnCurso($idCurso, $desc);            

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function editCGParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $desc = $_POST["desc"];
            $em->getRepository(CompetenciaGenerales::class)->editCGParaUnCurso($idCurso, $desc);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function deleteCGParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $em->getRepository(CompetenciaGenerales::class)->deleteCGParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

                                /* 
                                    Material
                                */

    public function MatParaUnCurso(EntityManagerInterface $em, $idCurso){

        try {
            $mat = $em->getRepository(Material::class)->getAllMatParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {
            return $this->render('admin/adminController/contenidos/cursoMat.html.twig', ['mats' => $mat, 'idCurso' => $idCurso]);
        }
    }

    public function addMatParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $titulo = $_POST["titulo"];
            $enlace = $_POST["enlace"];
            $tema = $_POST["tema"];
            $desc = $_POST["desc"];
            $visibilidad = isset($_POST["visibilidad"]);
            if ($visibilidad == false) {
                $visibilidad = 0;
            } else if ($visibilidad == true) {
                $visibilidad = 1;
            }
            $tipo = $_POST["tipo"];
            $em->getRepository(Material::class)->addMatParaUnCurso($idCurso, $titulo, $enlace, $tema, $desc, $visibilidad, $tipo);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function editMatParaUnCurso(EntityManagerInterface $em){

        try {

            $id = $_POST["id"];
            $titulo = $_POST["titulo"];
            $enlace = $_POST["enlace"];
            $tema = $_POST["tema"];
            $desc = $_POST["desc"];
            $visibilidad = isset($_POST["visibilidad"]);
            if ($visibilidad == false) {
                $visibilidad = 0;
            } else if ($visibilidad == true) {
                $visibilidad = 1;
            }
            $tipo = $_POST["tipo"];

            $em->getRepository(Material::class)->editMatParaUnCurso($id, $titulo, $enlace, $tema, $desc, $visibilidad, $tipo);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function deleteMatParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $em->getRepository(Material::class)->deleteMatParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

                                /* 
                                    Objetivo
                                */

    public function ObjParaUnCurso(EntityManagerInterface $em, $idCurso){

        try {

            $obj = $em->getRepository(Objetivo::class)->getAllObjParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('admin/adminController/contenidos/cursoObj.html.twig', ['objs' => $obj, 'idCurso' => $idCurso]);
        }
    }

    public function addObjParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $desc = $_POST["desc"];
            $em->getRepository(Objetivo::class)->addObjParaUnCurso($idCurso, $desc);            

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function editObjParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $desc = $_POST["desc"];
            $em->getRepository(Objetivo::class)->editObjParaUnCurso($idCurso, $desc);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function deleteObjParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $em->getRepository(Objetivo::class)->deleteObjParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

                                /* 
                                    Tabla de contenidos
                                */

    public function TablaParaUnCurso(EntityManagerInterface $em, $idCurso){

        try {

            $tc = $em->getRepository(TablaContenidos::class)->getAllTCParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {
            //dd($tc);
            return $this->render('admin/adminController/contenidos/cursoConte.html.twig', ['tcs' => $tc, 'idCurso' => $idCurso]);
        }
    }

    public function addContParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $titulo = $_POST["titulo"];
            $desc = $_POST["desc"];
            $em->getRepository(TablaContenidos::class)->addTCParaUnCurso($idCurso, $titulo, $desc);            

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function editContParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $titulo = $_POST["titulo"];
            $desc = $_POST["desc"];
            $em->getRepository(TablaContenidos::class)->editTCParaUnCurso($idCurso, $titulo, $desc);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    public function deleteContParaUnCurso(EntityManagerInterface $em){

        try {

            $idCurso = $_POST["id"];
            $em->getRepository(TablaContenidos::class)->deleteTCParaUnCurso($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->redirectToRoute('adminPanel');
        }
    }

    /*
        ***************************************************************************************
        Otros
        ***************************************************************************************
    */

    public function botonAltaAdmin(){

        return $this->render('admin/botonAltaAdmin.html.twig');
    }

    public function alta(){

        $usuario = new Usuario();
        $form = $this->createForm(AltaFormType::class, $usuario);

        return $this->render('admin/crearUsuario.html.twig', ['usuario_form' => $form->createView()]);
    }

    public function botonEditarAdmin(){

        return $this->render('admin/botonEditarAdmin.html.twig');
    }

    public function editar(){

        $usuario = new Usuario();
        $form = $this->createForm(EditarFormType::class, $usuario);

        return $this->render('admin/editarUsuario.html.twig', ['usuario_form' => $form->createView()]);
    }

    public function curso(EntityManagerInterface $em){

        try {  
            $idCurso = $_POST["id"];
            $etiqueta = $_POST["etiqueta"];

            $infoCurso = $em->getRepository(Curso::class)->getAllCursosPorId($idCurso);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            if($etiqueta == "Neuro Talentour"){

                return $this->render('campus/cursoNTT.html.twig', ['curso' => $infoCurso]);

            }else{

                return $this->render('campus/cursoPorTemas.html.twig', ['curso' => $infoCurso]);

            }

        }
    }

    public function infoCurso(EntityManagerInterface $em, $nombreC): Response{

        try {

            $infoCurso = $em->getRepository(Curso::class)->getCursoPorNombre($nombreC);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('campus/infoCurso.html.twig', ['curso' => $infoCurso]);
        }
    }

    public function uploadUser(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em){

        try {

            $email = $_POST["email"];
            $rol = $_POST["rol"];
            $rol = '["' . $rol . '"]';

            $contraseña = $_POST["password"];
            $aux = new Usuario();
            $cifrada = $passwordHasher->hashPassword($aux, $contraseña);

            $em->getRepository(Usuario::class)->altaUsuario($rol, $cifrada, $email);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            $usuario = new Usuario();
            $form = $this->createForm(AltaFormType::class, $usuario);
            return $this->render('admin/crearUsuario.html.twig', ['usuario_form' => $form->createView()]);
        }
    }

    public function campus(EntityManagerInterface $em): Response{

        try {

            $emailAux = $this->getUser()->getEmail();
            $idUser = $em->getRepository(Usuario::class)->getUsuarioPorEmail($emailAux);
            //dd($idUser[0]['id']);
            $idCurso = $em->getRepository(Curso::class)->getAllCursosParaUnUsuario($idUser[0]['id']);
            //dd($idCurso);
            // if($idCurso == []){
            //     $idCurso = 0;
            // }
            //dd($idCurso[3]['id_curso_id']);
            $cursos = [];
            for ($i = 0; $i < sizeOf($idCurso); $i++) {
                $cursos[] = $em->getRepository(Curso::class)->getAllCursosPorId($idCurso[$i]['id_curso_id']);
            }
            //$cursos = $em->getRepository(Curso::class)->getAllCursosPorId($idCurso);
            //dd($cursos);

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('campus/cursos.html.twig', [
                'contoller_name' => 'WebController', 'cursosAux' => $cursos
            ]);
        }
    }

    public function info(EntityManagerInterface $em, int $id): Response{

        try {

            $emailAux = $this->getUser()->getEmail();
            $idUser = $em->getRepository(Usuario::class)->getUsuarioPorEmail($emailAux);
            $info = $em->getRepository(Curso::class)->getEstado($idUser[0]['id'], $id);

            $material = $em->getRepository(Curso::class)->materiales($id);

            $lugares = $em->getRepository(Lugares::class)->getAllLugares();
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('campus/estadoCurso.html.twig', [
                'contoller_name' => 'WebController', 'info' => $info[0]['estado'], 'materiales' => $material, 'lugares' => $lugares, 'idCurso' => $id
            ]);
        }
    }

    public function pasos(EntityManagerInterface $em, int $id): Response{

        try {

            $emailAux = $this->getUser()->getEmail();
            $idUser = $em->getRepository(Usuario::class)->getUsuarioPorEmail($emailAux);
            $info = $em->getRepository(Curso::class)->getEstado($idUser[0]['id'], $id);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('campus/pasos.html.twig', [
                'contoller_name' => 'WebController', 'info' => $info[0]['estado']
            ]);
        }
    }

    public function perfilInstructor(EntityManagerInterface $em): Response{

        try {

            // $emailAux = $this->getUser()->getEmail();
            // $idInstructor = $em->getRepository(Usuario::class)->getUsuarioPorEmail($emailAux);

            // $alumnosId = $em->getRepository(InstructorUsuario::class)->getAlumnosIdPorInstructorId($idInstructor[0]['id']);

            // $alumnos = [];
            // for ($i = 0; $i < sizeOf($alumnosId); $i++) {
            //     $alumnos[] = $em->getRepository(Usuario::class)->getAlumnosPorId($alumnosId[$i]['alumno_id']);
            // }

            $emailAux = $this->getUser()->getEmail();
            $idInstructor = $em->getRepository(Usuario::class)->getUsuarioPorEmail($emailAux);

            $idCursosDeUnInstructor = $em->getRepository(UsuarioCurso::class)->getIdCursosDeUnInstructor($idInstructor[0]["id"]);

            $idAlumnosDeUnInstructor[] = $em->getRepository(UsuarioCurso::class)->getIdAlumnosDeUnInstructor($idInstructor[0]["id"], $idCursosDeUnInstructor[0]["id_curso_id"]);
            
            for($i = 0; $i < sizeOf($idAlumnosDeUnInstructor[0]); $i++){
                $estados[] = $em->getRepository(UsuarioCurso::class)->getEstado($idAlumnosDeUnInstructor[0][$i]['id_usuario_id']);
            }

            // dd($estados[2][0]["estado"]);

            $alumnos = [];
            for ($i = 0; $i < sizeOf($idAlumnosDeUnInstructor[0]); $i++) {
                $alumnos[] = $em->getRepository(Usuario::class)->getAlumnosPorId($idAlumnosDeUnInstructor[0][$i]['id_usuario_id']);
            }

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('instructor/perfilInstructor.html.twig', [
                'contoller_name' => 'WebController', 'alumnosAux' => $alumnos, 'estados' => $estados,
            ]);
        }
    }

    /*public function alumnosDeUnCursoParaLosInstructores(EntityManagerInterface $em){

        try {

            $emailAux = $this->getUser()->getEmail();
            $idInstructor = $em->getRepository(Usuario::class)->getUsuarioPorEmail($emailAux);

            $idCursosDeUnInstructor = $em->getRepository(UsuarioCurso::class)->getIdCursosDeUnInstructor($idInstructor[0]["id"]);

            $idAlumnosDeUnInstructor = [];
            for($i = 0; $i < sizeOf($idCursosDeUnInstructor); $i++){
                $idAlumnosDeUnInstructor[] = $em->getRepository(UsuarioCurso::class)->getIdAlumnosDeUnInstructor($idInstructor[0]["id"], $idCursosDeUnInstructor[$i]["id_curso_id"]);
            }

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {
            return $this->render('instructor/infoAlumno.html.twig');
        }

    }*/

    public function infoAlumno(EntityManagerInterface $em, int $id, string $nombre, array $alumno, array $estados): Response{

        try {

            $cursosAlumnos = $em->getRepository(Curso::class)->getAllInfoCursosParaUnUsuario($id);

            $cursos = [];
            for ($i = 0; $i < sizeOf($cursosAlumnos); $i++) {
                $cursos[] = $em->getRepository(Curso::class)->getAllCursosPorId($cursosAlumnos[$i]['id_curso_id']);
            }

            /*$activos = [];
            for ($i = 0; $i < sizeOf($cursosAlumnos); $i++) {
                $activos[] = $em->getRepository(InstructorUsuario::class)->getUsuariosPorId($cursosAlumnos[$i]['id_usuario_id']);
            }*/

            $reservasAlumnos = $em->getRepository(Usuario::class)->getReservasAlumnosPorId($id);

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('instructor/infoAlumno.html.twig', [
                'contoller_name' => 'WebController', 'cursosAlumnos' => $cursosAlumnos, 'reservasAlumnos' => $reservasAlumnos,
                'cursosAux' => $cursos, 'nombre' => $nombre, 'alumno' => $alumno, /*'activos' => $activos[0], */'idAlumno' => $id, 'estados' => $estados
            ]);
        }
    }

    public function infoAlumnoInactivo(EntityManagerInterface $em, int $id, string $nombre, array $alumno): Response{

        try {

            $cursosAlumnos = $em->getRepository(Curso::class)->getAllInfoCursosParaUnUsuario($id);

            $cursos = [];
            for ($i = 0; $i < sizeOf($cursosAlumnos); $i++) {
                $cursos[] = $em->getRepository(Curso::class)->getAllCursosPorId($cursosAlumnos[$i]['id_curso_id']);
            }

            $activos = [];
            for ($i = 0; $i < sizeOf($cursosAlumnos); $i++) {
                $activos[] = $em->getRepository(InstructorUsuario::class)->getUsuariosPorId($cursosAlumnos[$i]['id_usuario_id']);
            }

            $reservasAlumnos = $em->getRepository(Usuario::class)->getReservasAlumnosPorId($id);
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('instructor/infoAlumnoNoActivo.html.twig', [
                'contoller_name' => 'WebController', 'cursosAlumnos' => $cursosAlumnos, 'reservasAlumnos' => $reservasAlumnos,
                'cursosAux' => $cursos, 'nombre' => $nombre, 'alumno' => $alumno, 'activos' => $activos[0]
            ]);
        }
    }

    public function modificarEstado(EntityManagerInterface $em): Response{

        try {

            $estado = $_POST["estado"];
            $idAlumno = $_POST["id"];
            $idCurso = $_POST["idCurso"];
            
            $em->getRepository(Usuario::class)->modificarEstado($idAlumno, $idCurso, $estado);

            $emailAux = $this->getUser()->getEmail();
            $idInstructor = $em->getRepository(Usuario::class)->getUsuarioPorEmail($emailAux);

            $idCursosDeUnInstructor = $em->getRepository(UsuarioCurso::class)->getIdCursosDeUnInstructor($idInstructor[0]["id"]);

            $idAlumnosDeUnInstructor = [];
            $estados = [];
            for($i = 0; $i < sizeOf($idCursosDeUnInstructor); $i++){
                $idAlumnosDeUnInstructor[] = $em->getRepository(UsuarioCurso::class)->getIdAlumnosDeUnInstructor($idInstructor[0]["id"], $idCursosDeUnInstructor[$i]["id_curso_id"]);
                $estados[] = $em->getRepository(UsuarioCurso::class)->getEstado($idAlumnosDeUnInstructor[0][$i]['id_usuario_id']);
            }

            $alumnos = [];
            for ($i = 0; $i < sizeOf($idAlumnosDeUnInstructor[0]); $i++) {
                $alumnos[] = $em->getRepository(Usuario::class)->getAlumnosPorId($idAlumnosDeUnInstructor[0][$i]['id_usuario_id']);
            }

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('instructor/perfilInstructor.html.twig', [
                'contoller_name' => 'WebController', 'alumnosAux' => $alumnos, 'estados' => $estados,
            ]);
        }
    }

    public function reservar(EntityManagerInterface $em): Response{

        $fecha = $_POST["fecha"];
        $hora = $_POST["hora1radio"];
        $reserva = $fecha . " " . $hora;
        $lugar = $_POST["lugar"];
        $idCurso = $_POST["idCurso"];
        $tipo = $_POST["tipo"];

        try {

            $emailAux = $this->getUser()->getEmail();
            $id = $em->getRepository(Usuario::class)->getUsuarioPorEmail($emailAux);

            $idLugar = $em->getRepository(Lugares::class)->getLugarIdPorNombre($lugar);

            $em->getRepository(Reserva::class)->addReserva($id[0]['id'], $reserva, $idLugar[0]['id'], $idCurso, $tipo);

            $estado = $em->getRepository(Curso::class)->getEstado($id[0]['id'], $idCurso);

            if($tipo == "neuroevaluacion"){

                $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '2.1 Espera de confirmacion de la cita');

            }else if($tipo == "trainingempatia"){

                if($estado[0]["estado"] == "4 Training (Ninguna reserva)"){

                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (Emp. reservada)');

                }else if($estado[0]["estado"] == "4 Training (Asert. reservada)"){

                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (Emp. y Asert reservadas)');
                    
                }else if($estado[0]["estado"] == "4 Training (HabCom. reservada)"){

                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (Emp. y HabCom reservadas)');
                    
                }else if($estado[0]["estado"] == "4 Training (Asert. y HabCom reservadas)"){

                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (Todas las reservas)');
                    
                }

            }else if($tipo == "trainingasertividad"){

                if($estado[0]["estado"] == "4 Training (Ninguna reserva)"){

                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (Asert. reservada)');

                }else if($estado[0]["estado"] == "4 Training (Emp. reservada)"){

                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (Emp. y Asert reservadas)');
                    
                }else if($estado[0]["estado"] == "4 Training (HabCom. reservada)"){

                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (Asert. y HabCom reservadas)');
                    
                }else if($estado[0]["estado"] == "4 Training (Emp. y HabCom reservadas)"){

                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (Todas las reservas)');
                    
                }
                
            }else if($tipo == "traininghabcom"){

                if($estado[0]["estado"] == "4 Training (Ninguna reserva)"){

                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (HabCom. reservada)');

                }else if($estado[0]["estado"] == "4 Training (Emp. reservada)"){

                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (Emp. y HabCom reservadas)');

                }else if($estado[0]["estado"] == "4 Training (Asert. reservada)"){
                    
                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (Asert. y HabCom reservadas)');

                }else if($estado[0]["estado"] == "4 Training (Emp. y Asert reservadas)"){

                    $em->getRepository(Usuario::class)->modificarEstado($id[0]['id'], $idCurso, '4 Training (Todas las reservas)');
                    
                }
                
            }

            $infoCurso = $em->getRepository(Curso::class)->getAllCursosPorId($idCurso);

        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('campus/cursoNTT.html.twig', ['curso' => $infoCurso]);
            
        }
    }

    public function contactoForm(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response{

        $error = "";

        $tipoInfo = $_POST["optradio"];

        $nombre = $_POST["nombre"];

        $rolAux = "ROLE_USER";
        $rol = '["' . $rolAux . '"]';

        $userAux = new Usuario();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.-';
        $contraseña = '';
        for ($i = 0; $i < 20; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $contraseña .= $characters[$index];
        }
        $password = $passwordHasher->hashPassword($userAux, $contraseña);

        $correo = $_POST["correo"];
        $apellidos = $_POST["apellidos"];
        $interes = $_POST["interes"];
        $telefono = $_POST["telefono"];
        $dni = $_POST["dni"];
        $genero = $_POST["genero"];
        $jerarquia = $_POST["jerarquia"];
        $funcional = $_POST["funcional"];

        if ($_POST["comunicaciones"] == 'on') {
            $comunicaciones = 1;
        } else {
            $comunicaciones = 0;
        }

        if ($_POST["datos"] == 'on') {
            $datos = 1;
        } else {
            $datos = 0;
        }

        $nombreApe = $nombre . " " . $apellidos;

        try {

            //dd($nombreApe, $rol, $password, $correo, $comunicaciones, $datos, $tipoInfo, $interes, $telefono);
            $em->getRepository(Usuario::class)->contactoForm($nombreApe, $rol, $password, $correo, $comunicaciones, $datos, $tipoInfo, $interes, $telefono, $dni, $genero, $jerarquia, $funcional);
        
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

            $error = "Error en la creación del usuario, compruebe que el correo o el nombre utilizado no pertenezca ya a una cuenta en uso";

        } finally {

            $cursosActivos = $em->getRepository(Curso::class)->getAllCursos();

            return $this->render('web/contacto.html.twig', [
                'contoller_name' => 'WebController', 'error' => $error, 'cursosActivos' => $cursosActivos,
            ]);
        }
    }

    public function citas(EntityManagerInterface $em): Response{

        try {

            $reservas = $em->getRepository(Reserva::class)->getAllReservasOrdenadas();

            for ($i = 0; $i < sizeOf($reservas); $i++) {
                $alumnos[] = $em->getRepository(Usuario::class)->getAlumnosPorId($reservas[$i]['id_usuario_id']);
            }
            
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('admin/citas.html.twig', [
                'contoller_name' => 'WebController', 'reservas' => $reservas, 'alumnos' => $alumnos,
            ]);
        }
    }

    public function editReserva(EntityManagerInterface $em): Response{

        try {

            $id = $_POST["id"];
            $hora = $_POST["hora1radio"];
            $dia = $_POST["fecha"];
            $reserva = $dia . " " . $hora;

            $em->getRepository(Reserva::class)->updateReserva($id, $reserva);

            $reservas = $em->getRepository(Reserva::class)->getAllReservasOrdenadas();

            for ($i = 0; $i < sizeOf($reservas); $i++) {
                $alumnos[] = $em->getRepository(Usuario::class)->getAlumnosPorId($reservas[$i]['id_usuario_id']);
            }

            
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('admin/citas.html.twig', [
                'contoller_name' => 'WebController', 'reservas' => $reservas, 'alumnos' => $alumnos,
            ]);
        }
    }

    public function deleteReserva(EntityManagerInterface $em): Response{

        try {

            $id = $_POST["id"];

            $em->getRepository(Reserva::class)->deleteReserva($id);

            $reservas = $em->getRepository(Reserva::class)->getAllReservasOrdenadas();

            for ($i = 0; $i < sizeOf($reservas); $i++) {
                $alumnos[] = $em->getRepository(Usuario::class)->getAlumnosPorId($reservas[$i]['id_usuario_id']);
            }
            
        } catch (Throwable $e) {

            //echo "Error: " . $e . "<br>";

        } finally {

            return $this->render('admin/citas.html.twig', [
                'contoller_name' => 'WebController', 'reservas' => $reservas, 'alumnos' => $alumnos,
            ]);
        }
    }


}
