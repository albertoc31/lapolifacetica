<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activity;
use AppBundle\Entity\Asociacion;
use AppBundle\Entity\Category;
use AppBundle\Entity\Colectivo;
use AppBundle\Entity\User;
use AppBundle\Entity\Programa;

// Clase de formulario de nuevo usuario
use AppBundle\Form\UserType;
use AppBundle\Form\ContactType;

use AppBundle\Service\SendMailContact;
use AppBundle\Service\SendMailRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

// librerias de autenticacion y seguridad
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

// libreria para recaptcha
use ReCaptcha\ReCaptcha;

class DefaultController extends Controller
{
    private static $max_activities = 6;
    private static $max_programas = 6;

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, $pagina = 1)
    {
        /*$numActivities = $this::$max_activities;
          Nos ceñimos a 3 actividades destacadas en portada */
        $numActivities = 3;

        // Capturamos repositorio de tabla Activity
        $repository = $this->getDoctrine()->getRepository(Activity::class);

        // dynamic method names to find a group of products based on a column value
        /* $activities = $repository->findByDestacado(true); */

        // sacamos las actividades según la paginacion
        $activities = $repository->paginaActividades($pagina, $numActivities, $destacado = true);

        // Capturamos repositorio de tabla Asociaciones
        /*$repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);
        $asociaciones = $repository_asc->findAll();

        NOS LO HEMOS LLEVADO A UNA EXTENSION DE TWIG
        */

        // Esto lo hice porque me volvia loco en produccion mostrando stack traces
        // $debug_text = 'ENV = ' . $this->getParameter('kernel.environment') . ' / DEBUG = ' . $this->getParameter('kernel.debug');

        return $this->render('home/home.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'activities' => $activities,
            /*'debug_text' => $debug_text
            'asociaciones' => $asociaciones,*/
/*            'paginaActual' => $pagina,*/
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
     * @Route("/actividades/{num}", name="actividades")
     */
    public function actividadesAction(Request $request, $num = 1)
    {
        // Capturamos repositorio de tabla Activity
        $repository = $this->getDoctrine()->getRepository(Activity::class);

        // sacamos las actividades según la paginacion
        $activities = $repository->paginaActividades($num, $this::$max_activities, $destacado = false);

        /*foreach ($activities as $activity) {
            var_dump($activity); die();
            $associations = $activity->getAsociaciones();
            foreach ($associations as $association) {
                $name = $association->getName();
                var_dump($name); die();
            }
        }*/

        return $this->render('home/activities.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'activities' => $activities,
            'paginaActual' => $num,
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
     * @Route("/programas/{num}", name="programas")
     */
    public function programasAction(Request $request, $num = 1)
    {
        // Capturamos repositorio de tabla Activity
        $repository = $this->getDoctrine()->getRepository(Programa::class);

        // sacamos las programas según la paginacion
        $programas = $repository->paginaProgramas($num, $this::$max_programas);

        foreach ($programas as $programa) {
            // var_dump($programa); die();
            setlocale(LC_TIME, "es_ES");
            $fecha = strftime("%e de %B del %Y", $programa->getFecha()->getTimestamp());
            $programa->setFecha($fecha);
        }

        return $this->render('home/programas.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'programas' => $programas,
            'paginaActual' => $num,
            /*'colectivos' => $colectivos*/
        ]);
    }

    /**
     * @Route("/programa/{id}", name="programa")
     */
    public function programaAction(Request $request, $id = null)
    {
        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(Programa::class);
            $programa = $repository->findOneById($id);

            setlocale(LC_TIME, "es_ES");
            $fecha = strftime("%e de %B del %Y", $programa->getFecha()->getTimestamp());
            $programa->setFecha($fecha);

            return $this->render('home/programa.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                'programa' => $programa,
            ]);
        } else {
            // redirects to the "homepage" route
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/contacto/", name="contacto")
     */
    public function contactoAction(Request $request, SendMailContact $sendMailContact)
    {
        // saco el array de asociaciones

        // Capturamos repositorio de tabla Asociaciones
        $repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);
        $asociaciones = $repository_asc->findAll();

        $asoc_array = [];
        $associations = array_map( function(Asociacion $asociacion) use (&$asoc_array) {
            $asoc_array[$asociacion->getName()] = $asociacion->getId();
        }, $asociaciones);

        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm(ContactType::class,null, array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('contacto'),
            'method' => 'POST',
            'choices' => array( 'Asociaciones' => $asoc_array, 'General' => array('La Polifacética'=> '0'))
        ));
        $message = '';

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            $message = $this->recaptchaAction($request);

            if ($message == false) {
                if ($form->isValid()) {

                    // Send mail
                    $sendMailContact->setAsociaciones($asociaciones);

                    if ($sendMailContact->__invoke($form->getData())) {
                        $message = 'Mensaje enviado correctamente';
                    } else {
                        $message = 'Ha habido un problema al enviar el mail. Por favor, vuelva a intentarlo';
                    }
                }
            }
        }

        return $this->render('home/contacto.html.twig', array(
            'form' => $form->createView(),
            'message'  => $message
        ));
    }

    public function recaptchaAction(Request $request){
        $recaptcha_private_key = $this->getParameter('recaptcha_private_key');
        $recaptcha = new ReCaptcha($recaptcha_private_key);
        $resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());

        if (!$resp->isSuccess()) {
            /*var_dump(implode(', ',$resp->getErrorCodes()) );die();*/
            // Do something if the submit wasn't valid ! Use the message to show something
            return "ReCaptcha no se ha resuelto correctamente. Inténtalo de nuevo."; // "(reCAPTCHA said: " . implode(', ',$resp->getErrorCodes())  . ")";
        }else{
            // Everything works good ;) your contact has been saved.
            return false;
        }
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

        /**
         * Cuando quiera meter un recaptcha al login for miraré en detalle esto:
         * https://github.com/syspay/login-recaptcha-bundle/tree/master/src/Bundle
         */

        return $this->render('home/login.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/registro/", name="registro")
     */
    public function registroAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, SendMailRegistry $sendMailRegistry)
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
        $form = $this->createForm(UserType::class, $user, [
            'choices' => $choices,
            'submitLabel' => 'Registrarse'
        ]);

        $message = '';
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $message = $this->recaptchaAction($request);

            if ($message == false) {

                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);

                /*// 3b) $username = $email
                $user->setUsername($user->getEmail());*/

                // 3c) ROLES
                $user->setRoles(['ROLE_USER']);

                // 4) Deleted
                $user->setDeleted(0);

                // 5) ApiKey
                $user->setApikey('');

                // 4) save the User!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                // 5 Vamos a almacenar en asociacion su pertenencia a ella

                $asociacion_id = $user->getAsociacion();
                $asociacion = $repository_asc->findOneById($asociacion_id);
                $users = $asociacion->getUsers();
                $users[] = $user->getId();

                $asociacion->setUsers($users);
                $entityManager->persist($asociacion);
                $entityManager->flush();

                // ... do any other work - like sending them an email, etc
                // maybe set a "flash" success message for the user

                /*// Send mail
                $mail_config = $this->getParameter('mail_config');
                // Le pasamos mail_config porque no lo hemos inyectado invocando Mail como servicio
                $mail = new Mail($mail_config);*/

                // NO PUEDO MANDARLO EN EL CONSTRUCTOR NI INYECTAR DEPENDENCIAS :-(
                $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
                $sendMailRegistry->setBaseurl($baseurl);
                $sendMailRegistry->setAsociaciones($asociaciones);

                if ($sendMailRegistry->__invoke($form->getData())) {
                    return $this->redirectToRoute('acceso');
                } else {
                    $message = 'Ha habido un problema al comunicar el registro. Por favor, <a href="' . $baseurl . '/contacto">contacte con nosotros</a>';
                }
            }
        }

        return $this->render(
            'home/register.html.twig', [
            'form' => $form->createView(),
                'message'  => $message
            ]
        );
    }

    /**
     * @Route("/editSelf/{id}", name="editSelf")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function editSelfAction(Request $request, $id = null, UserPasswordEncoderInterface $passwordEncoder)
    {

        $user = $this->getUser();
        $user_id = $user->getID();

        if ($user_id != $id) {
            return $this->redirectToRoute('homepage');
        }
        $goHome = false;

        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(User::class);
            $user = $repository->findOneById($id);

            if ($user != null) {

                // Capturamos repositorio de tabla Asociaciones
                $repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);
                $asociaciones = $repository_asc->findAll();
                $asociaciones_array = array_map( function(Asociacion $asociacion){return [$asociacion->getId(),$asociacion->getName()];} , $asociaciones );
                $choices = [];
                foreach ($asociaciones_array as $asoc){
                    //print_r($asoc);
                    $choices[$asoc[1]] = $asoc[0];
                }

                $form = $this->createForm(UserType::class, $user, [
                    'submitLabel' => 'Guardar Usuario',
                    'choices' => $choices,
                    'selfEdit' => true,
                    'validation_groups' => ['edition'],
                ]);

                // Recogemos la información
                $form->handleRequest($request);

                $message = '';

                /*$data = json_decode($request->getContent(), true);
                $method = $request->getMethod();*/

                if ($form->isSubmitted() && $form->isValid()) {

                    $message = $this->recaptchaAction($request);

                    if ($message == '') {
                        // $form->getData() holds the submitted values
                        // but, the original `$user` variable has also been updated
                        $userNew = $form->getData();

                        // 3) Encode the password (you could also do this via Doctrine listener)
                        $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                        $userNew->setPassword($password);

                        // almacenar la asociacion
                        $asociacion_id = $userNew->getAsociacion();
                        $asociacion = $repository_asc->findOneById($asociacion_id);
                        $users = $asociacion->getUsers();
                        $users[] = $userNew->getId();
                        $asociacion->setUsers($users);

                        /*var_dump($users); die(' === eso');*/

                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($userNew);
                        $entityManager->persist($asociacion);
                        $entityManager->flush();

                        return $this->redirectToRoute('homepage');
                    }
                }

                return $this->render('administracion/editUsuario.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    'form' => $form->createView(),
                    'selfEdit' => true,
                    'message'  => $message
                ]);
            } else {
                $goHome = true;
            }
        } else {
            $goHome = true;
        }

        if ($goHome) {
            // redirects to the "homepage" route
            return $this->redirectToRoute('homepage');
        }
    }
}
