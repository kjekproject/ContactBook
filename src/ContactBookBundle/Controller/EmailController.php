<?php

namespace ContactBookBundle\Controller;

use ContactBookBundle\Entity\Email;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Email controller.
 *
 * @Route("email")
 */
class EmailController extends Controller
{
    /**
     * Creates a new email entity.
     *
     * @Route("/new/{id}", name="email_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request, $id)
    {
        $email = new Email();
        $form = $this->createForm('ContactBookBundle\Form\EmailType', $email);
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('ContactBookBundle:Person')->find($id);        

        if ($form->isSubmitted() && $form->isValid()) {
            $email->setPerson($person);
            $em->persist($email);
            $em->flush();
        }
        return $this->redirectToRoute('show', array('id' => $id));
    }

    /**
     * Displays a form to edit an existing email entity.
     *
     * @Route("/{id}/edit", name="email_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Email $email)
    {
        $editForm = $this->createForm('ContactBookBundle\Form\EmailType', $email);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('show', array('id' => $email->getPerson()->getId()));
        }

        return $this->render('email/edit.html.twig', array(
            'email' => $email,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a email entity.
     *
     * @Route("/{id}", name="email_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Email $email)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($email);
        $em->flush();

        return $this->redirectToRoute('show', array('id' => $email->getPerson()->getId()));
    }
}
