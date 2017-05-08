<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/interessados", name="interessados")
     * @Method({"GET"})
     */
    public function getInteressadosAction(Request $request)
    {
        $pesquisa = [
             'nome'=>''
            ,'convite'=>''
            ,'data'=>''
            ,'data-de'=>''
            ,'data-ate'=>''
            ];
        foreach ($pesquisa as $key => $value) {
            if($request->get($key)){
                $pesquisa[$key] = $request->get($key);
            }
        }

        $qb = $this->container
            ->get('doctrine')
            ->getRepository('AppBundle:Interessado')
            ->createQueryBuilder('interessado');
        $qb->select('interessado,convite')
           ->innerJoin('interessado.convite','convite')
            ->where('1 = 1');

        if($pesquisa['nome']){
            $qb->andWhere('UPPER(interessado.nome) LIKE UPPER(:nome)')
               ->setParameter('nome', '%' . mb_strtoupper($pesquisa['nome']) . '%');
        }
        if($pesquisa['convite']){
            $qb->andWhere('convite.id = :convite_id')
               ->setParameter('convite_id', $pesquisa['convite']);
        }

        $result = $qb->getQuery()->getArrayResult();
        return  new JsonResponse($result);
        
    }

    /**
     * @Route("/convites", name="convites")
     * @Method({"GET"})
     */
    public function getConvitesAction(Request $request)
    {
        $pesquisa = ['convite'=>''];
        foreach ($pesquisa as $key => $value) {
            if($request->get($key)){
                $pesquisa[$key] = $request->get($key);
            }
        }

        $qb = $this->container
            ->get('doctrine')
            ->getRepository('AppBundle:Convite')
            ->createQueryBuilder('convite');
        $result = $qb->select('convite')
           ->getQuery()->getArrayResult();
        return  new JsonResponse($result);
    }

    /**
     * @Route("/convites", name="convites")
     * @Method({"POST"})
     */
    public function postConvitesAction(Request $request)
    {
        $result = $request->all();
        return  new JsonResponse($result);
    }
}
