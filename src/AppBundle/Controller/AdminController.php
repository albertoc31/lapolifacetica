<?php
/**
 * @author: albertosanchez
 * Nuevo Controller para administración de las actividades
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Activity;
use AppBundle\Entity\Category;
use AppBundle\Entity\Asociacion;
use AppBundle\Entity\User;
use AppBundle\Entity\Colectivo;
use AppBundle\Entity\Programa;

use AppBundle\Service\SendMailApiKey;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


// Clase para el formulario de cada entidad
use AppBundle\Form\ActivityType;
use AppBundle\Form\CategoryType;
use AppBundle\Form\AsociacionType;
use AppBundle\Form\UserType;
use AppBundle\Form\ColectivoType;
use AppBundle\Form\ProgramaType;

// librerias de autenticacion y seguridad
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/administracion")
 */

class AdminController extends Controller {


    /**
     * @Route("/", name="administracion")
     */
    public function indexAction(Request $request)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN_COL" in roles and user.getActive() == 1'
        ));

        /*$logged_user = $this->getUser();
        var_dump($logged_user->getActive());die(' == ala');*/

        //var_dump($asociaciones);die();
        // replace this example code with whatever you need
        return $this->render('administracion/admin.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/nuevaActividad", name="nuevaActividad")
     */
    public function nuevaActividadAction(Request $request)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles and user.getActive() == 1'
        ));

        // creates an activity. In ActivityType we use EntityType for Asociaciones
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity,
            ['submitLabel' => 'Guardar Actividad']);

        // Recogemos la información
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$activity` variable has also been updated
            $activity = $form->getData();

            $foto = $activity->getFoto();
            $fileName = $this->generateUniqueFileName().'.'.$foto->guessExtension();
            try {
                $foto->move(
                    $this->getParameter('activity_img'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $activity->setFoto($fileName);

            /*
             * Para usar una función directa de PHP hay que escapar !!!!!
             * $activity->setFechaIni(new \DateTime());
            */

            // almacenar la actividad

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activity);
            $entityManager->flush();

            return $this->redirectToRoute('actividad', ['id' => $activity->getId()]);
        }

        // replace this example code with whatever you need
        return $this->render('administracion/editActividad.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/editActividad/{id}", name="editActividad")
     */
    public function editActividadAction(Request $request, $id = null)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles and user.getActive() == 1'
        ));
        $goList = false;
        $repository = $this->getDoctrine()->getRepository(Activity::class);

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $logged_user = $this->getUser();
            $id_asociacion = $logged_user->getAsociacion();

            $actividades = $repository->getByAssociation($id_asociacion);
            $act_array = [];
            foreach ($actividades as $actividad) {
                $act_array[] = $actividad->getId();
            }

            if (!in_array($id, $act_array)) {
                $id = null;
            }
            /*var_dump($actividades); die (' ==> bye');*/
        }

        if ($id != null) {

            $activity = $repository->findOneById($id);

            if ($activity != null) {

                // recojo los valores que pueden no cambiar
                $oldFoto = $activity->getFoto();

                $apiKey = $this->getUser()->getApikey();

                $form = $this->createForm(ActivityType::class, $activity, [
                    'requireFoto' => false,
                    'submitLabel' => 'Guardar Actividad',
                    'oldFoto' => $oldFoto,
                    'apiKey' => $apiKey

                ]);

                // Recogemos la información
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // $form->getData() holds the submitted values
                    // but, the original `$activity` variable has also been updated
                    $activityNew = $form->getData();

                    // Guardamos fotos
                    $foto = $activityNew->getFoto();

                    if ($foto != null) {
                        $fileName = $this->generateUniqueFileName() . '.' . $foto->guessExtension();
                        try {
                            $foto->move(
                                $this->getParameter('activity_img'),
                                $fileName
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }
                    } else {
                        // si no ha cmbiado la foto, preservo la antigua
                        $fileName = $oldFoto;
                    }
                    $activityNew->setFoto($fileName);

                    // almacenar la actividad

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($activityNew);
                    $entityManager->flush();

                    return $this->redirectToRoute('actividad', ['id' => $activity->getId()]);
                }

                return $this->render('administracion/editActividad.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    'form' => $form->createView(),
                    'isEdit' => true
                ]);
            } else {
                $goList = true;
            }
        } else {
            $goList = true;
        }

        if ($goList) {
            // redirects to the "nuevaActividad" route
            return $this->redirectToRoute('listaActividades');
        }
    }

    /**
     * @Route("/listaActividades/", name="listaActividades")
     */
    public function listaActividadesAction(Request $request, $id = null)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles and user.getActive() == 1'
        ));

        $repository = $this->getDoctrine()->getRepository(Activity::class);
        $actividades = $repository->findAll();

        $can_edit = [];

        $logged_user = $this->getUser();
        $id_asociacion = $logged_user->getAsociacion();

        foreach ($actividades as $actividad) {
            if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {

                // estos son los metodos para trabajar con arrayCollections
                $exists = $actividad->getAsociaciones()->exists(function($key, $value) use ($id_asociacion) {
                    //var_dump($value->getID()); die(' ==> eso');
                    return $value->getID() === $id_asociacion;
                });
                if ($exists) {
                    $can_edit[] = $actividad->getID();
                }
                /*foreach ($asoc_array as $asoc) {
                    if ($id_asociacion == $asoc->getID()) {
                        $can_edit[] = $actividad->getID();
                    }
                }*/
            } else {
                $can_edit[] = $actividad->getID(); // SUPER_ADMIN puede editar everything
            }
        }
        //var_dump($can_edit); die(' ==> eso');

        /*if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $logged_user = $this->getUser();
            $id_asociacion = $logged_user->getAsociacion();
            $actividades = $repository->getByAssociation($id_asociacion);
        } else {
            $actividades = $repository->findAll();
        }*/

        return $this->render('administracion/listaActividades.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'actividades' => $actividades,
            'can_edit' => $can_edit
        ]);
    }


    /**
     * @Route("/nuevaCategoria", name="nuevaCategoria")
     */
    public function nuevaCategoriaAction(Request $request)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles and user.getActive() == 1'
        ));

        // creates a category and gives it some dummy data for this example
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category, ['allow_file_upload'=>false]);

        // Recogemos la información
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$category` variable has also been updated
            $category = $form->getData();

            /*
             * Para usar una función directa de PHP hay que escapar !!!!!
             * $category->setFechaIni(new \DateTime());
            */

            // almacenar la actividad

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('listaCategorias');
        }

        // replace this example code with whatever you need
        return $this->render('administracion/editCategoria.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/editCategoria/{id}", name="editCategoria")
     */
    public function editCategoriaAction(Request $request, $id = null)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles and user.getActive() == 1'
        ));

        $goNew = false;

        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(Category::class);
            $category = $repository->findOneById($id);

            if ($category != null) {

                $form = $this->createForm(CategoryType::class, $category, [
                    'submitLabel' => 'Guardar Categoria',
                ]);

                // Recogemos la información
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // $form->getData() holds the submitted values
                    // but, the original `$category` variable has also been updated
                    $categoryNew = $form->getData();
                    // almacenar la categoria

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($categoryNew);
                    $entityManager->flush();

                    return $this->redirectToRoute('listaCategorias');
                }

                return $this->render('administracion/editCategoria.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    'form' => $form->createView(),
                    'isEdit' => true,
                ]);
            } else {
                $goNew = true;
            }
        } else {
            $goNew = true;
        }

        if ($goNew) {
            // redirects to the "nuevaCategoria" route
            return $this->redirectToRoute('nuevaCategoria');
        }
    }

    /**
     * @Route("/nuevaAsociacion/", name="nuevaAsociacion")
     */
    public function nuevaAsociacionAction(Request $request)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_SUPER_ADMIN" in roles and user.getActive() == 1'
        ));

        // creates an activity and gives it some dummy data for this example
        $asociacion = new Asociacion();
        $form = $this->createForm(AsociacionType::class, $asociacion);

        // Recogemos la información
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$asociacion` variable has also been updated
            $asociacion = $form->getData();

            /*
             * Para usar una función directa de PHP hay que escapar !!!!!
             * $asociacion->setFechaIni(new \DateTime());
            */
            /*$asociacion->setUsers([]);*/

            // Guardamos fotos
            $foto = $asociacion->getFoto();
            $fileName = $this->generateUniqueFileName().'.'.$foto->guessExtension();
            try {
                $foto->move(
                    $this->getParameter('activity_img'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $asociacion->setFoto($fileName);

            // almacenar la actividad

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($asociacion);
            $entityManager->flush();

            return $this->redirectToRoute('asociacion', ['id' => $asociacion->getId()]);
        }

        // replace this example code with whatever you need
        return $this->render('administracion/editAsociacion.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
            //'oldFoto' => '' // por consistencia con la edicion
        ]);
    }

    /**
     * @Route("/editAsociacion/{id}", name="editAsociacion")
     */
    public function editAsociacionAction(Request $request, $id = null)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles and user.getActive() == 1'
        ));

        $goNew = false;

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $logged_user = $this->getUser();
            $id_asociacion = $logged_user->getAsociacion();

            if ( $id_asociacion != $id ) {
                $id = null;
            }
            /*var_dump($actividades); die (' ==> bye');*/
        }

        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(Asociacion::class);
            $asociacion = $repository->findOneById($id);

            if ($asociacion != null) {

                // recojo los valores que pueden no cambiar
                $oldFoto = $asociacion->getFoto();
                $oldUsers = $asociacion->getUsers();

                $form = $this->createForm(AsociacionType::class, $asociacion, [
                    'oldFoto' => $oldFoto,
                    'requireFoto' => false,
                    'submitLabel' => 'Guardar Asociación',
                ]);

                // Recogemos la información
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // $form->getData() holds the submitted values
                    // but, the original `$asociacion` variable has also been updated
                    $asociacionNew = $form->getData();

                    // Guardamos fotos
                    $foto = $asociacionNew->getFoto();

                    if ($foto != null) {
                        $fileName = $this->generateUniqueFileName() . '.' . $foto->guessExtension();
                        try {
                            $foto->move(
                                $this->getParameter('activity_img'),
                                $fileName
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }
                    } else {
                        // si no ha cmbiado la foto, preservo la antigua
                        $fileName = $oldFoto;
                    }
                    $asociacionNew->setFoto($fileName);

                    // guardamos la web sin http://

                    $url = $asociacionNew->getWeb();
                    /*if (!preg_match('#^http(s)?://#', $url)) {
                        $url = 'http://' . $url;
                    }*/
                    $url = parse_url($url, PHP_URL_HOST) . parse_url($url, PHP_URL_PATH) ;
                    /*var_dump($url); die (' ==> bye');*/
                    $asociacionNew->setWeb($url);

                    // preservamos los valores que pueden no cambiar
                    $asociacionNew->setUsers($oldUsers);

                    // almacenar la asociacion

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($asociacionNew);
                    $entityManager->flush();

                    return $this->redirectToRoute('asociacion', ['id' => $asociacion->getId()]);
                }

                return $this->render('administracion/editAsociacion.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    'form' => $form->createView(),
                    'oldFoto' => $oldFoto,
                    'isEdit' => true,
                ]);
            } else {
                $goNew = true;
            }
        } else {
            $goNew = true;
        }

        if ($goNew) {
            // redirects to the "nuevaAsociacion" route
            return $this->redirectToRoute('administracion');
        }

    }

    /**
     * @Route("/nuevoUsuario/", name="nuevoUsuario")
     */
    public function nuevoUsuarioAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_SUPER_ADMIN" in roles and user.getActive() == 1'
        ));

        // Capturamos repositorio de tabla Asociaciones
        $repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);
        $asociaciones = $repository_asc->findAll();
        $asociaciones_array = array_map( function(Asociacion $asociacion){return [$asociacion->getId(),$asociacion->getName()];} , $asociaciones );
        $choices = [];
        foreach ($asociaciones_array as $asoc){
            //print_r($asoc);
            $choices[$asoc[1]] = $asoc[0];
        }

        // creates an user and gives it some dummy data for this example
        $user = new User();
        $form = $this->createForm(UserType::class, $user, [
            'choices' => $choices,
            'submitLabel' => 'Crear Usuario'
        ]);

        // Recogemos la información
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$user` variable has also been updated
            $user = $form->getData();

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
            /*var_dump($user); die(' === eso');*/
            $asociacion->setUsers($users);
            $entityManager->persist($asociacion);
            $entityManager->flush();

            return $this->redirectToRoute('listaUsuarios');
        }

        // replace this example code with whatever you need
        return $this->render('administracion/editUsuario.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/editUsuario/{id}", name="editUsuario")
     */
    public function editUsuarioAction(Request $request, $id = null, SendMailApiKey $sendMailApiKey)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles and user.getActive() == 1'
        ));

        $goAdmin = false;

        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(User::class);
            $user = $repository->findOneById($id);

            if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                $logged_user = $this->getUser();
                $id_asociacion = $logged_user->getAsociacion();
                if ($user->getAsociacion() !== $id_asociacion){
                    // nos cargamos el objeto user
                    $user = null;
                }
            }

            if ($user != null) {

                $message = '';

                // Capturamos repositorio de tabla Asociaciones
                $repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);
                $asociaciones = $repository_asc->findAll();
                $asociaciones_array = array_map( function(Asociacion $asociacion){return [$asociacion->getId(),$asociacion->getName()];} , $asociaciones );
                $choices = [];
                foreach ($asociaciones_array as $asoc){
                    //print_r($asoc);
                    $choices[$asoc[1]] = $asoc[0];
                }
                $roles = [];

                if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                    $roles = ['ROLE_USER'=>'ROLE_USER', 'ROLE_ADMIN_COL'=>'ROLE_ADMIN_COL', 'ROLE_ADMIN'=>'ROLE_ADMIN', 'ROLE_API'=>'ROLE_API',  'ROLE_SUPER_ADMIN'=>'ROLE_SUPER_ADMIN'];
                }

                $form = $this->createForm(UserType::class, $user, [
                    'submitLabel' => 'Guardar Usuario',
                    'choices' => $choices,
                    'isEdit' => true,
                    'validation_groups' => ['edition'],
                    'roles' => $roles
                ]);

                // Recogemos la información
                $form->handleRequest($request);

                $userNew = $form->getData();

                $data = json_decode($request->getContent(), true);
                $method = $request->getMethod();
                $args = $request->request->all();
                $build_apikey = isset($args['user']['build_apikey']) ? $args['user']['build_apikey'] : false;

                if ($form->isSubmitted() && $form->isValid()) {
                    // $form->getData() holds the submitted values
                    // but, the original `$user` variable has also been updated
                    $userNew = $form->getData();

                    // Aqui (re)generamos la ApiKey
                    if ($build_apikey) {
                        $newApiKey = password_hash(bin2hex(random_bytes(64)), PASSWORD_BCRYPT);
                        $userNew->setApikey($newApiKey);
                    }
                    // almacenar la asociacion
                    $asociacion_id = $userNew->getAsociacion();
                    $asociacion = $repository_asc->findOneById($asociacion_id);
                    $users = $asociacion->getUsers();
                    $users[] = $userNew->getId();
                    $asociacion->setUsers($users);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($userNew);
                    $entityManager->persist($asociacion);
                    $entityManager->flush();

                    if ($newApiKey) {
                        // comunicamos al usuario su Apikey
                        /*$mail = new Mail($this->getParameter('mail_config'));*/
                        if ($sendMailApiKey->__invoke($userNew)) {
                            return $this->redirectToRoute('listaUsuarios');
                        } else {
                            $message = 'Ha habido un problema al comunicar la ApiKey';
                        }
                    } else {
                        return $this->redirectToRoute('listaUsuarios');
                    }
                }

                return $this->render('administracion/editUsuario.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    'form' => $form->createView(),
                    'isEdit' => true,
                    'message'  => $message
                ]);
            } else {
                $goAdmin = true;
            }
        } else {
            $goAdmin = true;
        }

        if ($goAdmin) {
            // redirects to the "administracion" route
            return $this->redirectToRoute('administracion');
        }
    }

    /**
     * @Route("/borraUsuario/{id}", name="borraUsuario")
     */
    public function borraUsuarioAction(Request $request, $id = null)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles and user.getActive() == 1'
        ));

        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(User::class);
            $user = $repository->findOneById($id);

            if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                $logged_user = $this->getUser();
                $id_asociacion = $logged_user->getAsociacion();
                if ($user->getAsociacion() !== $id_asociacion) {
                    // nos cargamos el objeto user
                    $user = null;
                }
            }

            if ($user != null) {
                $repository = $this->getDoctrine()->getRepository(User::class);
                $user = $repository->findOneById($id);

                $roles = $user->getRoles();
                if (!in_array('ROLE_SUPER_ADMIN', $roles) ) {

                    $user->setDeleted(true);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($user);
                    $entityManager->flush();
                }
            }
        }
        return $this->redirectToRoute('listaUsuarios');
    }

    /**
     * @Route("/listaUsuarios/", name="listaUsuarios")
     */
    public function listaUsuariosAction(Request $request)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles and user.getActive() == 1'
        ));

        $repository = $this->getDoctrine()->getRepository(User::class);
        $repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);
        $asociaciones = [];

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $user = $this->getUser();
            $id_asociacion = $user->getAsociacion();

            $asociaciones[$id_asociacion] = $repository_asc->findOneById($id_asociacion)->getName();

            // get usuarios for this association
            $usuarios = $repository->findBy(
                ['asociacion' => $id_asociacion,
                    'deleted' => false]
            );
        } else {
            $usuarios = $repository->findBy(['deleted' => false]);

            $asociations = $repository_asc->findAll();
            $asociaciones = [];
            foreach ($asociations as $association) {
                $asociaciones[$association->getID()] = $association->getName();
            }
            /*var_dump($asociaciones); die(' == bye');*/
        }

        return $this->render('administracion/listaUsuarios.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'usuarios' => $usuarios,
            'asociations' => $asociaciones
        ]);
    }

    /**
     * @Route("/listaCategorias/", name="listaCategorias")
     */
    public function listaCategoriasAction(Request $request, $id = null)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles and user.getActive() == 1'
        ));

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categorias = $repository->findAll();
        return $this->render('administracion/listaCategorias.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'categorias' => $categorias,
        ]);
    }

    /**
     * @Route("/listaAsociaciones/", name="listaAsociaciones")
     */
    public function listaAsociacionesAction(Request $request, $id = null)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles and user.getActive() == 1'
        ));

        $repository = $this->getDoctrine()->getRepository(Asociacion::class);
        // $asociaciones = [];
        $asociaciones = $repository->findAll();

        $can_edit = [];

        $logged_user = $this->getUser();
        $id_asociacion = $logged_user->getAsociacion();

        /*if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $logged_user = $this->getUser();
            $id_asociacion = $logged_user->getAsociacion();
            $asociaciones[] = $repository->findOneById($id_asociacion);
        } else {
            $asociaciones = $repository->findAll();
        }*/

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categorias = $repository->findAll();
        return $this->render('administracion/listaAsociaciones.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'asociaciones' => $asociaciones,
            'id_asociacion' => $id_asociacion
        ]);
    }

    /**
     * @Route("/nuevoColectivo/", name="nuevoColectivo")
     */
    public function nuevoColectivoAction(Request $request)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN_COL" in roles and user.getActive() == 1'
        ));

        // creates an activity and gives it some dummy data for this example
        $colectivo = new Colectivo();

        // Capturamos repositorio de tabla Asociaciones
        $repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);
        $choices = [];

        // Solo SUPER_ADMIN puede crear colectivos para otras asociaciones
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $logged_user = $this->getUser();
            $id_asociacion = $logged_user->getAsociacion();
            $asociacion = $repository_asc->findOneById($id_asociacion);
            $choices[$asociacion->getName()] = $asociacion->getId();
        } else {
            $asociaciones = $repository_asc->findAll();
            $asociaciones_array = array_map(function (Asociacion $asociacion) {
                return [$asociacion->getId(), $asociacion->getName()];
            }, $asociaciones);

            foreach ($asociaciones_array as $asoc) {
                //print_r($asoc);
                $choices[$asoc[1]] = $asoc[0];
            }
        }
        /*var_dump($choices);die(' ==> bye');*/

        $form = $this->createForm(ColectivoType::class, $colectivo, [
            'submitLabel' => 'Crear Colectivo',
            'choices' => $choices,
        ]);

        // Recogemos la información
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$asociacion` variable has also been updated
            $colectivo = $form->getData();

            // almacenar el colectivo

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($colectivo);
            $entityManager->flush();

            return $this->redirectToRoute('listaColectivos');
        }

        // replace this example code with whatever you need
        return $this->render('administracion/editColectivo.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
            'choices' => $choices
        ]);
    }

    /**
     * @Route("/editColectivo/{id}", name="editColectivo")
     */
    public function editColectivoAction(Request $request, $id = null)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN_COL" in roles and user.getActive() == 1'
        ));

        $goNew = false;

        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(Colectivo::class);
            $colectivo = $repository->findOneById($id);

            // determinaos si tiene permiso para editar este colectivo
            if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                $logged_user = $this->getUser();
                $id_asociacion = $logged_user->getAsociacion();
                if ($colectivo->getAsociacion() !== $id_asociacion){
                    // nos cargamos el objeto user
                    $colectivo = null;
                }
            }

            if ($colectivo != null) {

                // Capturamos repositorio de tabla Asociaciones
                $repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);

                if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                    // uso findBy en vez de find($id) porque devuelve un array
                    $asociaciones = $repository_asc->findBy(['id'=>$id_asociacion]);
                } else {
                    $asociaciones = $repository_asc->findAll();
                }


                $asociaciones_array = array_map( function(Asociacion $asociacion){return [$asociacion->getId(),$asociacion->getName()];} , $asociaciones );
                $choices = [];
                foreach ($asociaciones_array as $asoc){
                    //print_r($asoc);
                    $choices[$asoc[1]] = $asoc[0];
                }
                /*var_dump($choices);die(' ==> bye');*/

                $form = $this->createForm(ColectivoType::class, $colectivo, [
                    'submitLabel' => 'Editar Colectivo',
                    'choices' => $choices,
                ]);

                // Recogemos la información
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // $form->getData() holds the submitted values
                    // but, the original `$colectivo` variable has also been updated
                    $colectivoNew = $form->getData();

                    // almacenar el colectivo

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($colectivoNew);
                    $entityManager->flush();

                    return $this->redirectToRoute('listaColectivos');
                }

                return $this->render('administracion/editColectivo.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    'form' => $form->createView(),
                    'isEdit' => true,
                ]);
            } else {
                $goNew = true;
            }
        } else {
            $goNew = true;
        }

        if ($goNew) {
            // redirects to the "nuevoColectivo" route
            return $this->redirectToRoute('listaColectivos');
        }

    }

    /**
     * @Route("/listaColectivos/", name="listaColectivos")
     */
    public function listaColectivosAction(Request $request, $id = null)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN_COL" in roles and user.getActive() == 1'
        ));

        $repository = $this->getDoctrine()->getRepository(Colectivo::class);
        $colectivos = $repository->findAll();

        // Capturamos repositorio de tabla Asociaciones
        $repository_asc = $this->getDoctrine()->getRepository(Asociacion::class);
        $asociations = $repository_asc->findAll();
        $asociaciones = [];
        foreach ($asociations as $association) {
            $asociaciones[$association->getID()] = $association->getName();
        }

        $logged_user = $this->getUser();
        $id_asociacion = $logged_user->getAsociacion();
        $can_edit = [];

        foreach ($colectivos as $colectivo) {
            if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                if ($colectivo->getAsociacion() == $id_asociacion) {
                    $can_edit[] = $colectivo->getID();
                }
            } else {
                $can_edit[] = $colectivo->getID(); // SUPER_ADMIN puede editar everything
            }
        }

        return $this->render('administracion/listaColectivos.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'colectivos' => $colectivos,
            'asociations' => $asociaciones,
            'can_edit' => $can_edit
        ]);
    }

    /**
     * @Route("/nuevoPrograma", name="nuevoPrograma")
     */
    public function nuevoProgramaAction(Request $request)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN_COL" in roles and user.getActive() == 1'
        ));

        // creates an activity and gives it some dummy data for this example
        $programa = new Programa();

        // los colectivos posibles dependen del permiso de usuario
        $repository_col = $this->getDoctrine()->getRepository(Colectivo::class);
        $choices = [];

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $logged_user = $this->getUser();
            $id_asociacion = $logged_user->getAsociacion();
            $colectivos = $repository_col->findByAsociacion($id_asociacion);
        } else {
            $colectivos = $repository_col->findAll();
        }
        $colectivos = array_map( function(Colectivo $colectivo) use (&$choices) {
            $choices[$colectivo->getName()] = $colectivo->getId();
        }, $colectivos);
        /*var_dump($choices); die (' ==> bye');*/

        $form = $this->createForm(ProgramaType::class, $programa,
            ['submitLabel' => 'Guardar Programa',
                'requireFoto' => false,
                'oldFoto' => '',
                'choices' => $choices]);

        // Recogemos la información
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$programa` variable has also been updated
            $programa = $form->getData();

            $foto = $programa->getFoto();
            if ($foto != null) {
                $fileName = $this->generateUniqueFileName() . '.' . $foto->guessExtension();
                try {
                    $foto->move(
                        $this->getParameter('activity_img'),
                        $fileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            } else {
                $fileName = '';
            }
            $programa->setFoto($fileName);

            /*
             * Para usar una función directa de PHP hay que escapar !!!!!
             * $programa->setFechaIni(new \DateTime());
            */

            // tengo que darle el objeto colectivo
            $colectivo_id = $programa->getColectivo();
            $colectivo = $repository_col->findOneById($colectivo_id);
            // var_dump($colectivo); die (' ==> bye');
            $programa->setColectivo($colectivo);

            // almacenar la actividad

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($programa);
            $entityManager->flush();

            return $this->redirectToRoute('listaProgramas', ['id' => $programa->getId()]);
        }

        // replace this example code with whatever you need
        return $this->render('administracion/editPrograma.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/editPrograma/{id}", name="editPrograma")
     */
    public function editProgramaAction(Request $request, $id = null)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN_COL" in roles and user.getActive() == 1'
        ));
        $goList = false;
        $repository = $this->getDoctrine()->getRepository(Programa::class);

        if ($id != null) {
            $programa = $repository->findOneById($id);

            $repository_col = $this->getDoctrine()->getRepository(Colectivo::class);
            $choices = [];

            if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                $logged_user = $this->getUser();
                $id_asociacion = $logged_user->getAsociacion();
                $colectivos = $repository_col->findByAsociacion($id_asociacion);
            } else {
                $colectivos = $repository_col->findAll();
            }
            $colectivos = array_map( function(Colectivo $colectivo) use (&$choices) {
                $choices[$colectivo->getName()] = $colectivo->getId();
            }, $colectivos);

            if ($programa->getColectivo()->getAsociacion() !== $id_asociacion ) {
                $programa = null;
            }

        }
        /*var_dump($choices); die (' ==> bye');*/

        if ($programa != null) {

            // recojo los valores que pueden no cambiar
            $oldFoto = $programa->getFoto();
            $oldColectivo = $programa->getColectivo()->getId();
            /*var_dump($oldColectivo); die (' ==> bye');*/

            $form = $this->createForm(ProgramaType::class, $programa, [
                'requireFoto' => false,
                'submitLabel' => 'Guardar Programa',
                'oldFoto' => $oldFoto,
                'choices' => $choices,
                'colectivo' => $oldColectivo

            ]);

            // Recogemos la información
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                // but, the original `$programa` variable has also been updated
                $programaNew = $form->getData();

                // Guardamos fotos
                $foto = $programaNew->getFoto();

                if ($foto != null) {
                    $fileName = $this->generateUniqueFileName() . '.' . $foto->guessExtension();
                    try {
                        $foto->move(
                            $this->getParameter('activity_img'),
                            $fileName
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                } else {
                    // si no ha cmbiado la foto, preservo la antigua
                    $fileName = $oldFoto;
                }
                $programaNew->setFoto($fileName);

                // tengo que darle el objeto colectivo
                $colectivo_id = $programaNew->getColectivo();
                $colectivo = $repository_col->findOneById($colectivo_id);
                // var_dump($colectivo); die (' ==> bye');
                $programaNew->setColectivo($colectivo);

                // almacenar el programa

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($programaNew);
                $entityManager->flush();

                return $this->redirectToRoute('listaProgramas', ['id' => $programa->getId()]);
            }

            return $this->render('administracion/editPrograma.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                'form' => $form->createView(),
                'isEdit' => true
            ]);
        } else {
            $goList = true;
        }

        if ($goList) {
            // redirects to the "nuevaPrograma" route
            return $this->redirectToRoute('listaProgramas');
        }
    }

    /**
     * @Route("/listaProgramas/", name="listaProgramas")
     */
    public function listaProgramasAction(Request $request, $id = null)
    {
        /* Uso aquí el control de usuario activo porque en security.yml no está funcionando ¿¿?? */
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN_COL" in roles and user.getActive() == 1'
        ));

        $repository = $this->getDoctrine()->getRepository(Programa::class);
        $programas = $repository->findAll();

        $can_edit = [];

        $logged_user = $this->getUser();
        $id_asociacion = $logged_user->getAsociacion();

        foreach ($programas as $programa) {
            if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                if ($programa->getColectivo()->getAsociacion() === $id_asociacion ) {
                    $can_edit[] = $programa->getID();
                }
            } else {
                $can_edit[] = $programa->getID(); // SUPER_ADMIN puede editar everything
            }
        }
        //var_dump($can_edit); die(' ==> eso');

        /*if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $logged_user = $this->getUser();
            $id_asociacion = $logged_user->getAsociacion();
            $programas = $repository->getByAssociation($id_asociacion);
        } else {
            $programas = $repository->findAll();
        }*/

        return $this->render('administracion/listaProgramas.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'programas' => $programas,
            'can_edit' => $can_edit
        ]);
    }

    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}