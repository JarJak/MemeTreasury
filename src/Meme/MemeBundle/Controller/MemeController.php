<?php

namespace Meme\MemeBundle\Controller;

use Meme\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Meme\MemeBundle\Entity\Meme;
use Meme\MemeBundle\Form\MemeType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Meme controller.
 *
 */
class MemeController extends BaseController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT m FROM MemeBundle:Meme m ORDER BY m.insertedAt DESC";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1)/*page number*/,
            40/*limit per page*/
        );

        // parameters to template
        return $this->render('MemeBundle:Meme:list.html.twig', array('pagination' => $pagination));
    }
    
    /**
     * Creates a new Meme entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Meme();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid() && $form['image']->getData()) {
            $file = $form['image']->getData();
            /* @var $file File */
            $entity->setOriginalFilename($file->getFilename());
//            $dir = $this->get('kernel')->getRootDir() . '/../web/uploads/memes/';
//            $form['filename']->getData()->move($dir);
            $entity->setUserIp($request->getClientIp());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        } else {
            throw new \InvalidArgumentException($form->getErrors());
        }

        return $this->render('MemeBundle:Meme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Meme entity.
     *
     * @param Meme $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Meme $entity)
    {
        $form = $this->createForm(MemeType::class, $entity, array(
            'action' => $this->generateUrl('meme_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Meme entity.
     *
     */
    public function newAction()
    {
        $entity = new Meme();
        $form   = $this->createCreateForm($entity);

        return $this->render('MemeBundle:Meme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function showAction(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MemeBundle:Meme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meme entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MemeBundle:Meme:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a random Meme entity.
     *
     */
    public function randomAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MemeBundle:Meme')->findOneBy([]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meme entity.');
        }

        return $this->render('MemeBundle:Meme:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Meme entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MemeBundle:Meme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meme entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MemeBundle:Meme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Meme entity.
    *
    * @param Meme $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Meme $entity)
    {
        $form = $this->createForm(new MemeType(), $entity, array(
            'action' => $this->generateUrl('_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Meme entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MemeBundle:Meme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meme entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_edit', array('id' => $id)));
        }

        return $this->render('MemeBundle:Meme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Meme entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MemeBundle:Meme')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Meme entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl(''));
    }

    /**
     * Creates a form to delete a Meme entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
