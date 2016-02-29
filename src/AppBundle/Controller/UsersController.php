<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User;

class UsersController extends DefaultController
{
    /**
     * @Route("/profile/show/{id}", name="user_show")
     */
    public function showAction($id)
    {
        $contacts = array();
        $user = $this->getDoctrine()->getManager()->getRepository('AppBundle:User')->find($id);;
        if(!$user){
            $this->addFlash(
                'danger',
                $this->get('translator')->trans('message.error_profile',array(),'AppBundle')
            );
            return $this->redirectToRoute('homepage');
        }
        else{
            $contact = $this->getDoctrine()->getRepository('AppBundle:Contact')->byContact($id, $this->getUser()->getId());
            if($contact) {
                foreach ($contact as $co) {
                    if ($co->getSender()->getId() != $this->getUser()->getId()) {
                        $contacts[$co->getSender()->getId()] = array(
                            "id_sender" => $co->getSender()->getId(),
                            "id_receiver" => $co->getReceiver()->getId(),
                            "confirmed" => $co->getConfirmed()
                        );
                    } else {
                        $contacts[$co->getReceiver()->getId()] = array(
                            "id_sender" => $co->getSender()->getId(),
                            "id_receiver" => $co->getReceiver()->getId(),
                            "confirmed" => $co->getConfirmed()
                        );
                    }
                }
            }
        }
        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'contacts'=> $contacts
        ));
    }
    /**
     * @Route("/profile/search/", name="user_search")
     * @Method({"POST"})
     */
    public function searchAction(Request $request)
    {
        $value = null;
        $em = $this->getDoctrine()->getRepository('AppBundle:User');
        if($request->isXmlHttpRequest() && $request->isMethod("POST")){
            if($request->get('keyword'))
            {
                $datas = $em->byUser($request->get('keyword'));
                if(count($datas) > 0){
                    $value = "<ul class='autocomplete'>";
                    foreach($datas as $data){
                        $value.="<li data-id='".$data['id']."' class='valueUser'>".$data['username']."</li>";
                    }
                    $value.="</ul>";
                }
            }
            $response = new \Symfony\Component\HttpFoundation\Response(json_encode($value));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        else if($request->isMethod("POST")){
            $contacts =array();
            if($request->get('keyword'))
            {
                $datas = $em->byUserContact($request->get('keyword'));
                foreach($datas as $data){
                    $contact = $this->getDoctrine()->getRepository('AppBundle:Contact')->byContact($data['id'], $this->getUser()->getId());
                    if($contact){
                        foreach($contact as $co){
                            if($co->getSender()->getId() != $this->getUser()->getId())
                            {
                                $contacts[$co->getSender()->getId()] = array(
                                    "id_sender" => $co->getSender()->getId(),
                                    "id_receiver" => $co->getReceiver()->getId(),
                                    "confirmed" => $co->getConfirmed()
                                );
                            }
                            else{
                                $contacts[$co->getReceiver()->getId()] =  array(
                                    "id_sender" => $co->getSender()->getId(),
                                    "id_receiver" => $co->getReceiver()->getId(),
                                    "confirmed" => $co->getConfirmed()
                                );
                            }
                        }
                    }
                }
                return $this->render('user/index.html.twig',array(
                    'users'=> $datas,
                    'contacts'=> $contacts
                ));
            }
            return $this->redirectToRoute('homepage');

        }
        return $this->redirectToRoute('homepage');
    }
}