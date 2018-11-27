<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /** @var UserService $userService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/", name="userlist")
     */
    public function listUser()
    {
        $users = $this->userService->getAll();

        return $this->render('todolist/listUser.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/add", name="adduser")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('todolist');
        }

        return $this->render('todolist/user/addUser.html.twig', ['userForm' => $form->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="edituser")
     */
    public function updateAction(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('todolist');
        }

        return $this->render('todolist/user/editUser.html.twig',
            [
                'userForm' => $form->createView(),
                'id' => $user->getId()
            ]);
    }

    /**
     * @Route("/delete/{id}", name="deleteuser")
     */
    public function deleteAction(User $user)
    {
        $this->userService->delete($user);

        return $this->redirectToRoute('todolist');
    }
}
