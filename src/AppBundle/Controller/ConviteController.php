<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Convite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Convite controller.
 *
 */
class ConviteController extends Controller
{
    /**
     * Lists all convite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $convites = $em->getRepository('AppBundle:Convite')->findAll();

        return $this->render('convite/index.html.twig', array(
            'convites' => $convites,
        ));
    }

    /**
     * Creates a new convite entity.
     *
     */
    public function newAction(Request $request)
    {
        $convite = new Convite();
        $form = $this->createForm('AppBundle\Form\ConviteType', $convite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($convite);
            $em->flush();

            return $this->redirectToRoute('convite_show', array('id' => $convite->getId()));
        }

        return $this->render('convite/new.html.twig', array(
            'convite' => $convite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a convite entity.
     *
     */
    public function showAction(Convite $convite)
    {
        $deleteForm = $this->createDeleteForm($convite);

        return $this->render('convite/show.html.twig', array(
            'convite' => $convite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing convite entity.
     *
     */
    public function editAction(Request $request, Convite $convite)
    {
        $deleteForm = $this->createDeleteForm($convite);
        $editForm = $this->createForm('AppBundle\Form\ConviteType', $convite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('convite_edit', array('id' => $convite->getId()));
        }

        return $this->render('convite/edit.html.twig', array(
            'convite' => $convite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a convite entity.
     *
     */
    public function deleteAction(Request $request, Convite $convite)
    {
        $form = $this->createDeleteForm($convite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($convite);
            $em->flush();
        }

        return $this->redirectToRoute('convite_index');
    }

    /**
     * Creates a form to delete a convite entity.
     *
     * @param Convite $convite The convite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Convite $convite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('convite_delete', array('id' => $convite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
