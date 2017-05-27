<?php

namespace ContactBookBundle\Controller;

use ContactBookBundle\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ContactBookBundle\Entity\Address;
use ContactBookBundle\Entity\Email;
use ContactBookBundle\Entity\Phone;
use ContactBookBundle\Entity\Team;

/**
 * Person controller.
 *
 * @Route("person")
 */
class PersonController extends Controller
{ 
    /**
     * Lists all person entities.
     *
     * @Route("/", name="person_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $people = $em->getRepository('ContactBookBundle:Person')->findAll();

        return $this->render('person/index.html.twig', array(
            'people' => $people,
        ));
    }

    /**
     * Creates a new person entity.
     *
     * @Route("/new", name="person_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $person = new Person();
        $form = $this->createForm('ContactBookBundle\Form\PersonType', $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute('person_show', array('id' => $person->getId()));
        }

        return $this->render('person/new.html.twig', array(
            'person' => $person,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a person entity.
     *
     * @Route("/{id}", name="person_show")
     * @Method("GET")
     */
    public function showAction(Person $person)
    {
        $deleteForm = $this->createDeleteForm($person);

        return $this->render('person/show.html.twig', array(
            'person' => $person,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing person entity.
     *
     * @Route("/{id}/edit", name="person_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Person $person)
    {
        $editForm = $this->createForm('ContactBookBundle\Form\PersonType', $person);
        $editForm->handleRequest($request);
        
        $address = new Address();
        $addressForm = $this->createForm('ContactBookBundle\Form\AddressType', $address, array(
            'action' => $this->generateUrl('address_new', ['id' => $person->getId()])));
        
        $email = new Email();
        $emailForm = $this->createForm('ContactBookBundle\Form\EmailType', $email, array(
            'action' => $this->generateUrl('email_new', ['id' => $person->getId()])));
        
        $phone = new Phone();
        $phoneForm= $this->createForm('ContactBookBundle\Form\PhoneType', $phone, array(
            'action' => $this->generateUrl('phone_new', ['id' => $person->getId()])));

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('person_show', array('id' => $person->getId()));
        }

        return $this->render('person/edit.html.twig', array(
            'person' => $person,
            'edit_form' => $editForm->createView(),
            'address_form' => $addressForm->createView(),
            'email_form' => $emailForm->createView(),
            'phone_form' => $phoneForm->createView(),
        ));
    }

    /**
     * Deletes a person entity.
     *
     * @Route("/{id}", name="person_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Person $person)
    {
        $form = $this->createDeleteForm($person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($person);
            $em->flush();
        }

        return $this->redirectToRoute('person_index');
    }

    /**
     * Creates a form to delete a person entity.
     *
     * @param Person $person The person entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Person $person)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('person_delete', array('id' => $person->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }   
    
    /**
     * @Route("/{id}/team", name="person_choose_team")
     */
    public function chooseTeam(Person $person)
    {
        $teams = $this->getDoctrine()->getRepository('ContactBookBundle:Team')->findAll();
        
        return $this->render('person/choose_team.html.twig', array(
            'teams' => $teams,
            'person' => $person,
        ));
    }
    
    /**
     * @Route("/{personId}/{teamId}", name="person_team_add")
     */
    public function addPersonToTheTeam($personId, $teamId)
    {
        $person = $this->getDoctrine()->getRepository('ContactBookBundle:Person')->find($personId);
        $team = $this->getDoctrine()->getRepository('ContactBookBundle:Team')->find($teamId);
        
        $person->addTeam($team);
        
        $this->getDoctrine()->getManager()->flush();
        
        return $this->redirectToRoute('person_show', array('id' => $person->getId()));
    }
    
    /**
     * @Route("/{personId}/{teamId}/remove", name="person_team_remove")
     */
    public function removePersonFromTheTeam($personId, $teamId)
    {
        $person = $this->getDoctrine()->getRepository('ContactBookBundle:Person')->find($personId);
        $team = $this->getDoctrine()->getRepository('ContactBookBundle:Team')->find($teamId);
        
        $person->removeTeam($team);
        
        $this->getDoctrine()->getManager()->flush();
        
        return $this->redirectToRoute('person_show', array('id' => $person->getId()));
    }
}
