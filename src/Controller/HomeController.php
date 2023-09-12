<?php
namespace App\Controller;

use App\Entity\Bien;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class HomeController
{

    /**
     * @var Environement
     */
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function methode_appeler_a_cette_class(ManagerRegistry $doctrine): Response
    {
        $var_bien = $doctrine->getRepository(Bien::class)->ma_fonction2();
        return new Response($this->twig->render('pages/home.html.twig', [
            'biens' => $var_bien
        ]));
    }

    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $var_bien = $doctrine->getRepository(Bien::class)->find($id);
        return new Response($this->twig->render('biens/bien.html.twig', [
            'bien' => $var_bien
        ]));
    }
}
