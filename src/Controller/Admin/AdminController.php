<?php
namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Bien;
use App\Form\BienType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Form\AbstractType;






class AdminController extends AbstractController
{
    /**
     * @var Environement
     */
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function nouvelle_methode(ManagerRegistry $doctrine): Response
    {

        $var_bien = $doctrine->getRepository(Bien::class)->findAll();
        
        return new Response($this->twig->render('admin/admin.html.twig', [
            'biens' => $var_bien]));
    }

    public function nouvelle_methode_edit(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        
        $var_bien = $doctrine->getRepository(Bien::class)->find($id);
        $form = $this->createForm(BienType::class, $var_bien);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $nom_entitee = $doctrine->getManager();
            $nom_entitee->persist($var_bien);
            $nom_entitee->flush();
            $this->addFlash('success', 'Le bien a bien été modifié');
            return $this->redirectToRoute('admin');
        }

        return new Response($this->twig->render('admin/edit.html.twig', [
            'bien' => $var_bien,
            'form' => $form->createView()
        ]));
    }

    public function nouvelle_methode_new(ManagerRegistry $doctrine, Request $request): Response
    {
        $var_bien = new Bien();
        // $var_bien = $doctrine->getRepository(Bien::class)->find($id);
        $form = $this->createForm(BienType::class, $var_bien);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $nom_entitee = $doctrine->getManager();
            $nom_entitee->persist($var_bien);
            $nom_entitee->flush();
            $this->addFlash('success', 'Le bien a bien été créé');
            return $this->redirectToRoute('admin');
        }

        return new Response($this->twig->render('admin/new.html.twig', [
            'bien' => $var_bien,
            'form' => $form->createView()
        ]));
    }

    public function nouvelle_methode_delete(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        if($this->isCsrfTokenValid('delete'.$id , $request->get('_token')))
        {
            $var_bien = $doctrine->getRepository(Bien::class)->find($id);
            $nom_entitee = $doctrine->getManager();
            $nom_entitee->remove($var_bien);
            $nom_entitee->flush();
            $this->addFlash('success', 'Le bien a bien été supprimé');
            return $this->redirectToRoute('admin');
        }
        return $this->redirectToRoute('admin');
    }

}