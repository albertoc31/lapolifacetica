<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Category;
use AppBundle\Entity\Activity;


/**
 * @Route("/api", name="api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/listaCategorias", methods={"GET"})
     */
    public function listaCategoriasAction()
    {
        // ... return a JSON response with the post


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

        return new Response("<html><head></head><body>Lista Categorías</body></head></html>");

    }

    /**
     * @Route("/insertaCategoria/{categoria}", methods={"POST"})
     */
    public function insertaCategoriaAction($categoria)
    {
        // ... edit a post
        return new Response("<html><head></head><body>Inserta Categoría: " . $categoria . "</body></head></html>");
    }
}