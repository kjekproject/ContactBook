<?php

namespace ContactBookBundle\Controller;

use ContactBookBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Address controller.
 *
 * @Route("address")
 */
class AddressController extends Controller
{
    /**
     * Creates a new address entity.
     *
     * @Route("/new/{id}", name="address_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request, $id)
    {
        $address = new Address();
        $form = $this->createForm('ContactBookBundle\Form\AddressType', $address);
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('ContactBookBundle:Person')->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $address->setPerson($person);
            $em->persist($address);
            $em->flush();
        }
        return $this->redirectToRoute('person_show', array('id' => $id));
    }

    /**
     * Displays a form to edit an existing address entity.
     *
     * @Route("/{id}/edit", name="address_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Address $address)
    {
        $editForm = $this->createForm('ContactBookBundle\Form\AddressType', $address);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('person_show', array('id' => $address->getPerson()->getId()));
        }

        return $this->render('address/edit.html.twig', array(
            'address' => $address,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a address entity.
     *
     * @Route("/{id}", name="address_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Address $address)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();

        return $this->redirectToRoute('person_show', array('id' => $address->getPerson()->getId()));
    }
}