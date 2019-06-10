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
 * @Route("/administracionActivities")
 */

class ActivityController extends Controller {
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
        return $this->render('administracionActivities/nuevaActividad.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/nuevaCategoria", name="nuevaCategoria")
     */
    public function nuevaCategoriaAction(Request $request)
    {
        // creates an activity and gives it some dummy data for this example
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

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
        return $this->render('administracionActivities/nuevaCategoria.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/nuevaAsociacion", name="nuevaAsociacion")
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

            // almacenar la actividad

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($asociacion);
            $entityManager->flush();

            return $this->redirectToRoute('asociacion', ['id' => $asociacion->getId()]);
        }

        // replace this example code with whatever you need
        return $this->render('administracionActivities/nuevaAsociacion.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }

    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}