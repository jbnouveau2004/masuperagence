<?php
namespace App\Controller\Admin;

use App\Entity\Picture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;


class AdminPictureController extends AbstractController
{

    public function methode_delete(ManagerRegistry $doctrine, Picture $picture, Request $request)
    {
        $data = json_decode($request->getContent(), true);
        if($this->isCsrfTokenValid('delete'.$picture->getId() , $data['_token']))
        {
            $em = $doctrine->getManager();
            $em->remove($picture);
            $em->flush();
            return new JsonResponse(['success' => 1]);
        }
        return new JsonResponse(['error' => 'Token invalide'], 400);
    }

}