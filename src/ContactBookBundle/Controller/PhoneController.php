<?php

namespace ContactBookBundle\Controller;

use ContactBookBundle\Entity\Phone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Phone controller.
 *
 * @Route("phone")
 */
class PhoneController extends Controller
{
    /**
     * Creates a new phone entity.
     *
     * @Route("/new/{id}", name="phone_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request, $id)
    {
        $phone = new Phone();
        $form = $this->createForm('ContactBookBundle\Form\PhoneType', $phone);
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('ContactBookBundle:Person')->find($id);        

        if ($form->isSubmitted() && $form->isValid()) {
            $phone->setPerson($person);
            $em->persist($phone);
            $em->flush();
        }
        return $this->redirectToRoute('show', array('id' => $id));
    }

    /**
     * Displays a form to edit an existing phone entity.
     *
     * @Route("/{id}/edit", name="phone_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Phone $phone)
    {
        $editForm = $this->createForm('ContactBookBundle\Form\PhoneType', $phone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('show', array('id' => $phone->getPerson()->getId()));
        }

        return $this->render('phone/edit.html.twig', array(
            'phone' => $phone,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a phone entity.
     *
     * @Route("/{id}", name="phone_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Phone $phone)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($phone);
        $em->flush();

        return $this->redirectToRoute('show', array( 'id' => $phone->getPerson()->getId()));
    }
}