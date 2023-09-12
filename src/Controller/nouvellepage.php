<?php
namespace App\Controller;

use App\Entity\Bien;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class nouvellepage
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
        //création d'une ligne de la basse de donnée
        // $var_bien = new Bien();
        // $var_bien->setTitle('Mon premier bien')
        //     ->setPrix(200000)
        //     ->setRooms(4)
        //     ->setBedrooms(3)
        //     ->setDescription('Une petite description')
        //     ->setSurface(60)
        //     ->setFloor(4)
        //     ->setHeat(1)
        //     ->setCity('Montpellier')
        //     ->setAddress('15 Boulevard Gambetta')
        //     ->setPostalCode(34000);
        // $nom_entitee = $doctrine->getManager();
        // $nom_entitee->persist($var_bien);
        // $nom_entitee->flush();

        // lecture d'une ligne de la base de données
        $var_bien = $doctrine->getRepository(Bien::class)->findAll();
        // dump($var_bien);

        // modification d'une ligne de la base de données
        // $var_bien = $doctrine->getRepository(Bien::class)->ma_fonction();
        // $var_bien[0]->setSold(true);
        // $nom_entitee = $doctrine->getManager();
        // $this->nom_entitee=$nom_entitee;
        // $this->nom_entitee->flush();
        
        
        // return new Response('<html><body>'.phpinfo().'</body></html>');
        return new Response($this->twig->render('ventes/index.html.twig',['variable_menu'=>'ventes', 'biens' => $var_bien]));
    }
}