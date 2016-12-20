<?php

namespace AppBundle\Controller\Admin;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Role;
use AppBundle\Entity\User;
use AppBundle\Form\UserEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @Route("/admin/users")
 * @package AppBundle\Controller\Admin
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="admin_users")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listUsers()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('admin/user/list.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/edit/{id}", name="admin_user_edit")
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function EditUser($id, Request $request)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if ($user === null) {
            return $this->redirectToRoute('admin_users');
        }

        $originalPassword = $user->getPassword();

        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rolesRequest = $user->getRoles();
            $roleRepository = $this->getDoctrine()->getRepository(Role::class);
            $roles = [];

            foreach ($rolesRequest as $roleName) {
                $roles[] = $roleRepository->findOneBy(['name' => $roleName]);
            }

            $user->setRoles($roles);

            if ($user->getPassword()) {
                $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPassword());
                $user->setPassword($password);
            } else {
                $user->setPassword($originalPassword);
            }

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/user/edit.html.twig', ['form' => $form->createView(), 'user' => $user]);

    }

    /**
     * @Route("/delete/{id}", name="admin_user_delete")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteUser($id, Request $request){
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if ( $user === null) {
            return $this->redirectToRoute('admin_users');
        }


        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach ($user->getArticles() as $article){
                $em->remove($article);
            }

            $em->remove($user);
            $em->flush();

            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/user/delete.html.twig', ['form' => $form->createView(), 'user' => $user]);

    }
}