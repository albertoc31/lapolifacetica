<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activity;
use AppBundle\Entity\Asociacion;
use AppBundle\Entity\Category;
use AppBundle\Entity\User;

// Clase de formulario de nueva actividad
use AppBundle\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

// librerias de autenticacion y seguridad
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends Controller
{
    /**
     * @Route("/{pagina}", name="homepage")
     */
    public function indexAction(Request $request, $pagina = 1)
    {
        $numActivities = 3;
        // Capturamos repositorio de tabla Activity
        $repository = $this->getDoctrine()->getRepository(Activity::class);

        // dynamic method names to find a group of products based on a column value
        /* $activities = $repository->findByDestacado(true); */

        // sacamos las actividades según la paginacion
        $activities = $repository->paginaActividades($pagina, $numActivities);

        // replace this example code with whatever you need
        return $this->render('home/home.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'activities' => $activities,
            'paginaActual' => $pagina,
        ]);
    }

    /**
 * @Route("/activity/{id}", name="activity")
 */
    public function activityAction(Request $request, $id = null)
    {
        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(Activity::class);
            $activity = $repository->findOneById($id);

            /*$desde = $activity->getFechaIni();
            var_dump($desde->format('d-m-Y')); die();*/

            // Pasamos fechas a string
            $activity->desde = $activity->getFechaIni()->format('d-m-Y');
            $activity->hasta = $activity->getFechaFin()->format('d-m-Y');

            // Mostramos la imagen de la ruta correcta



            return $this->render('home/activity.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                'activity' => $activity,
            ]);
        } else {
            // redirects to the "homepage" route
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/category/{id}", name="category")
     */
    public function categoryAction(Request $request, $id = null)
    {
        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(Category::class);
            $category = $repository->findOneById($id);

            return $this->render('home/category.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                'category' => $category,
            ]);
        } else {
            // redirects to the "homepage" route
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/asociacion/{id}", name="asociacion")
     */
    public function asociacionAction(Request $request, $id = null)
    {
        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(Asociacion::class);
            $asociacion = $repository->findOneById($id);

            return $this->render('home/asociacion.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                'asociacion' => $asociacion,
            ]);
        } else {
            // redirects to the "homepage" route
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/nosotros/", name="nosotros")
     */
    public function nosotrosAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home/nosotros.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/documentos/", name="documentos")
     */
    public function documentosAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home/home.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'paginaActual' => 1,
        ]);
    }

    /**
     * @Route("/contacto/{equipo}", name="contacto")
     */
    public function contactoAction(Request $request, $equipo = 'none')
    {
        // replace this example code with whatever you need
        return $this->render('home/contacto.html.twig', [
            'equipo' => $equipo,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/acceso/", name="acceso")
     */
    public function accesoAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('home/login.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/registro/", name="registro")
     */
    public function registroAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // creates an activity and gives it some dummy data for this example
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 3b) $username = $email
            $user->setUsername($user->getEmail());

            // 3c) ROLES
            $user->setRoles(['ROLE_USER']);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('acceso');
        }

        return $this->render(
            'home/register.html.twig',
            ['form' => $form->createView()]
        );
    }
}
