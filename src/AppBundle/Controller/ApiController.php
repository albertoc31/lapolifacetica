<?php


namespace AppBundle\Controller;


use http\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use AppBundle\Entity\Category;
use AppBundle\Entity\Activity;


/**
 * @Route("/api", name="api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/", name="_doc")
     */
    public function docAction()
    {
        // Esto es una siple lista de metodos de la API para montar con el tiempo una documentación

        $array1 = get_class_methods($this);
        if($parent_class = get_parent_class($this)){
            $array2 = get_class_methods($parent_class);
            $array3 = array_diff($array1, $array2);
        }else{
            $array3 = $array1;
        }
        $array3 = array_diff($array3,[__FUNCTION__]);
        return new JsonResponse($array3);
    }
    /**
     * @Route("/listaCategorias", name="_lista_categoria", methods={"GET"})
     */
    public function listaCategoriasAction()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categorias = $repository->findAll();

        $categorias_array = array_map( function($categoria){return [
            "id" => $categoria->getId(),
            "name" => $categoria->getName(),
            "description" => strip_tags( html_entity_decode( $categoria->getDescription() ) )
        ];} , $categorias );

        $response = new JsonResponse();
        // $encoding = $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        $response->setData($categorias_array);

        // var_dump($encoding); die(' ==>bye');
        return $response;

//        return new Response("<html><head></head><body>Lista Categorías</body></head></html>");

    }

    /**
     * @Route("/insertaCategoria/{name}/{description}", name="_inserta_categoria", methods={"POST"})
     */
    public function insertaCategoriaAction($name = '', $description = '')
    {
        if ( strlen($name) > 0 ) {
            $category = new Category();
            $category->setName($name);
            $category->setDescription($description);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            $categoria_array = [
                "id" => $category->getId(),
                "name" => $category->getName(),
                "description" => $category->getDescription()
                ];

            return new JsonResponse($categoria_array);
        }

        throw new BadRequestHttpException ('Falta Nombre', null, 400);
//        $category = new Category();

    }
}