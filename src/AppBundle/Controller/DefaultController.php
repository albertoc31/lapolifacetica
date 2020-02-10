<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activity;
use AppBundle\Entity\Asociacion;
use AppBundle\Entity\Category;
use AppBundle\Entity\User;

// Clase de formulario de nuevo usuario
use AppBundle\Form\UserType;
use AppBundle\Form\ContactType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

// librerias de autenticacion y seguridad
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends Controller
{
    private static $max_activities = 3;

    /**
     * @Route("/{pagina}", name="homepage")
     */
    public function indexAction(Request $request, $pagina = 1)
    {
        $numActivities = $this::$max_activities;
        // Capturamos repositorio de tabla Activity
        $repository = $this->getDoctrine()->getRepository(Activity::class);

        // dynamic method names to find a group of products based on a column value
        /* $activities = $repository->findByDestacado(true); */

        // sacamos las actividades según la paginacion
        $activities = $repository->paginaActividades($pagina, $numActivities);

        // Capturamos repositorio de tabla Asociaciones
        /*$repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);
        $asociaciones = $repository_asc->findAll();

        NOS LO HEMOS LLEVADO A UNA EXTENSION DE TWIG
        */

        //var_dump($asociaciones);die();
        // replace this example code with whatever you need
        return $this->render('home/home.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'activities' => $activities,
            /*'asociaciones' => $asociaciones,*/
            'paginaActual' => $pagina,
        ]);
    }

    /**
     * @Route("/actividad/{id}", name="actividad")
     */
    public function actividadAction(Request $request, $id = null)
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
     * @Route("/actividades/", name="actividades")
     */
    public function actividadesAction(Request $request, $pagina = 1)
    {
        // Capturamos repositorio de tabla Activity
        $repository = $this->getDoctrine()->getRepository(Activity::class);
        // sacamos las actividades según la paginacion
        $activities = $repository->paginaActividades($pagina, $this::$max_activities);

        return $this->render('home/activities.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'activities' => $activities,
        ]);
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
     * @Route("/contacto/", name="contacto")
     */
    public function contactoAction(Request $request)
    {
        // saco el array de asociaciones

        // Capturamos repositorio de tabla Asociaciones
        $repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);
        $asociaciones = $repository_asc->findAll();

        $asociaciones_nombres = array_map( function(Asociacion $asociacion){return $asociacion->getName();} , $asociaciones );

        /*var_dump($asociaciones_nombres);die();*/

        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm(ContactType::class,null, array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('contacto'),
            'method' => 'POST',
            'choices' => array( 'Asociaciones' => array_combine($asociaciones_nombres, $asociaciones_nombres), 'General' => array('La Polifacética'=> 'La Polifacética'))
        ));
        $message = '';

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                // Send mail
                if($this->sendEmail($form->getData())){
                    $message = 'Mensaje enviado correctamente';
                }else{
                    $message = 'Ha habido un problema al enviar el mail. Por favor, vuelva a intentarlo';
                }
            }
        }

        return $this->render('home/contacto.html.twig', array(
            'form' => $form->createView(),
            'message'  => $message
        ));
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
        // Capturamos repositorio de tabla Asociaciones
        $repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);
        $asociaciones = $repository_asc->findAll();
        $asociaciones_array = array_map( function(Asociacion $asociacion){return [$asociacion->getId(),$asociacion->getName()];} , $asociaciones );
        $choices = [];
        foreach ($asociaciones_array as $asoc){
            //print_r($asoc);
            $choices[$asoc[1]] = $asoc[0];
        }

        /*var_dump($choices); die();
        $choices = array_combine($asociaciones_nombres, $asociaciones_nombres);*/

        // creates an user
        $user = new User();
        $form = $this->createForm(UserType::class, $user, ['choices' => $choices]);


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

    private function sendEmail($data){
        $myappContactMail = 'info@convergenciadeculturas.org';
        $myappContactPassword = 'Toledo50';
        /*$asociaciones_nombres = $data["asociaciones"]->map( function(Asociacion $asociacion){return $asociacion->getName();} )->getValues();
        var_dump(implode (', ',  $asociaciones_nombres) );die();*/
        $asociaciones_nombres = implode(', ',  $data["asociaciones"] );

        // In this case we'll use GMAIL mail services.
        // If your service is another, then read the following article to know which smpt code to use and which port
        // http://ourcodeworld.com/articles/read/14/swiftmailer-send-mails-from-php-easily-and-effortlessly
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
            ->setUsername($myappContactMail)
            ->setPassword($myappContactPassword);

        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance("Formulario de contacto de La Polifacética: ". $data["subject"])
            ->setFrom(array($myappContactMail => "Mensaje de ".$data["name"]))
            ->setTo(array(
                $myappContactMail => $myappContactMail
            ))
            ->setBody($data["message"]."<br />Email contacto:".$data["email"]."<br />Asociaciones destinatarias: ".$asociaciones_nombres, 'text/html');

        return $mailer->send($message);
    }
}