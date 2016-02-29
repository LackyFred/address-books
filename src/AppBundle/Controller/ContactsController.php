<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactsController extends Controller
{

    /**
     * @Route("/contact/add/{id}", name="add_contact")
     */
    public function add_contactAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user1 = $em->getRepository('AppBundle:User')->find($id);
        if($user1)
        {
            $user2 = $this->getUser();
            $contact = $em->getRepository('AppBundle:Contact')->findOneBy(array('sender'=>$user1->getId(),
                'receiver'=>$user2->getId()));
            if(!$contact){
                $contact = $em->getRepository('AppBundle:Contact')->findOneBy(array('sender'=>$user2->getId(),
                    'receiver'=>$user1->getId()));
                if(!$contact){
                    if($user1->getId() != $user2->getId())
                    {
                        $contact = new Contact();
                        $contact->setSender($user2)->setReceiver($user1)->setConfirmed(0);
                        $em->persist($contact);
                        $em->flush();
                    }
                }
            }
        }
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/contact/accept/{id}", name="accept_contact")
     */
    public function accept_contact($id)
    {
        $em = $this->getDoctrine()->getManager();
        $contact = $em->getRepository('AppBundle:Contact')->findOneBy(array('sender'=>$id,
            'receiver'=>$this->getUser()->getId()));
        if(!$contact){
            $contact = $em->getRepository('AppBundle:Contact')->findOneBy(array('sender'=>$this->getUser()->getId(),
                'receiver'=>$id));
            if($contact){
                $contact->setConfirmed(1);
                $em->persist($contact);
                $em->flush();
            }
        }
        else{
            $contact->setConfirmed(1);
            $em->persist($contact);
            $em->flush();
        }
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/contact/delete/{id}", name="delete_contact")
     */
    public function delete_contact($id)
    {
        $em = $this->getDoctrine()->getManager();
        $contact = $em->getRepository('AppBundle:Contact')->findOneBy(array('sender'=>$id,
            'receiver'=>$this->getUser()->getId()));
        if(!$contact){
            $contact = $em->getRepository('AppBundle:Contact')->findOneBy(array('sender'=>$this->getUser()->getId(),
                'receiver'=>$id));
            if($contact){
                $em->remove($contact);
                $em->flush();
            }
        }
        else{
            $em->remove($contact);
            $em->flush();
        }
        return $this->redirectToRoute('homepage');
    }
}
