<?php
/**
 * @author: albertosanchez
 * Nuevo Controller para administración de las actividades
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Activity;
use AppBundle\Entity\Category;
use AppBundle\Entity\Asociacion;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


// Clase de formulario de nueva actividad
use AppBundle\Form\ActivityType;
use AppBundle\Form\CategoryType;
use AppBundle\Form\AsociacionType;

/**
 * @Route("/administracion")
 */

class AdminController extends Controller {
    /**
     * @Route("/nuevaActividad", name="nuevaActividad")
     */
    public function nuevaActividadAction(Request $request)
    {

        /*if (!is_null($request)){
            $datos = $request->request->all();
            var_dump($datos);
        }*/

        // creates an activity and gives it some dummy data for this example
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);

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

            return $this->redirectToRoute('activity', ['id' => $activity->getId()]);
        }

        // replace this example code with whatever you need
        return $this->render('administracion/nuevaActividad.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/editActividad/{id}", name="editActividad")
     */
    public function editActividadAction(Request $request, $id = null)
    {
        $goNew = false;

        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(Activity::class);
            $activity = $repository->findOneById($id);

            if ($activity != null) {

                // recojo los valores que pueden no cambiar
                $oldFoto = $activity->getFoto();



                $form = $this->createForm(ActivityType::class, $activity, [
                    'requireFoto' => false,
                    'submitLabel' => 'Guardar Actividad',
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

                    return $this->redirectToRoute('activity', ['id' => $activity->getId()]);
                }

                return $this->render('administracion/nuevaActividad.html.twig', [
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
            // redirects to the "nuevaActividad" route
            return $this->redirectToRoute('nuevaActividad');
        }
    }


    /**
     * @Route("/nuevaCategoria", name="nuevaCategoria")
     */
    public function nuevaCategoriaAction(Request $request)
    {
        // creates an activity and gives it some dummy data for this example
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category, ['requiredFoto'=>false]);

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

            return $this->redirectToRoute('category', ['id' => $category->getId()]);
        }

        // replace this example code with whatever you need
        return $this->render('administracion/nuevaCategoria.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/nuevaAsociacion/", name="nuevaAsociacion")
     */
    public function nuevaAsociacionAction(Request $request)
    {
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
            $asociacion->setMiembros(0);
            $asociacion->setMiembrosIds([]);

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
        return $this->render('administracion/nuevaAsociacion.html.twig', [
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
        $goNew = false;

        if ($id != null) {

            $repository = $this->getDoctrine()->getRepository(Asociacion::class);
            $asociacion = $repository->findOneById($id);

            if ($asociacion != null) {

                // recojo los valores que pueden no cambiar
                $oldFoto = $asociacion->getFoto();
                $oldMiembros = $asociacion->getMiembros();
                $oldMiembrosIds = $asociacion->getMiembrosIds();


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

                    // preservamos los valores que pueden no cambiar
                    $asociacionNew->setMiembros($oldMiembros);
                    $asociacionNew->setMiembrosIds($oldMiembrosIds);


                    // almacenar la actividad

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($asociacionNew);
                    $entityManager->flush();

                    return $this->redirectToRoute('asociacion', ['id' => $asociacion->getId()]);
                }

                return $this->render('administracion/nuevaAsociacion.html.twig', [
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
            return $this->redirectToRoute('nuevaAsociacion');
        }

    }

        private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}