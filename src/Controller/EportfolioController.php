<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EportfolioController extends AbstractController
{
    #[Route('/eportfolio', name: 'app_eportfolio')]
    public function index(): Response
    {
        return $this->render('eportfolio/index.html.twig');
    }

    #[Route('/eportfolio/rt1', name: 'app_rt1')]
    public function rt1(): Response
    {
        return $this->render('eportfolio/rt1.html.twig');
    }

    #[Route('/eportfolio/rt2', name: 'app_rt2')]
    public function rt2(): Response
    {
        return $this->render('eportfolio/rt2.html.twig');
    }

    #[Route('/eportfolio/rt3', name: 'app_rt3')]
    public function rt3(): Response
    {
        return $this->render('eportfolio/rt3.html.twig');
    }

    #[Route('/eportfolio/ac11/{number}', name: 'app_ac11')]
    #[Route('/eportfolio/ac12/{number}', name: 'app_ac12')]
    #[Route('/eportfolio/ac13/{number}', name: 'app_ac13')]
    public function ac(string $number): Response
    {
        // Extraire le numéro RT et AC du chemin de la requête
        $path = $_SERVER['REQUEST_URI'];
        preg_match('/ac(\d{2})(\d{2})/', $path, $matches);
        $rt_number = $matches[1];
        $ac_number = $matches[2];

        // Données des ACs (à remplacer par une base de données dans un vrai projet)
        $ac_data = [
            '11' => [
                '01' => [
                    'title' => 'Maîtriser les lois fondamentales de l\'électricité',
                    'preuves' => 'Contenu des preuves pour AC11.01',
                    'analyses' => 'Analyses réflexives pour AC11.01'
                ],
                '02' => [
                    'title' => 'Comprendre l\'architecture et les fondamentaux des systèmes numériques',
                    'preuves' => 'Contenu des preuves pour AC11.02',
                    'analyses' => 'Analyses réflexives pour AC11.02'
                ],
                // Ajoutez les autres ACs de RT1 ici
            ],
            '12' => [
                '01' => [
                    'title' => 'Mesurer et analyser les signaux',
                    'preuves' => 'Contenu des preuves pour AC12.01',
                    'analyses' => 'Analyses réflexives pour AC12.01'
                ],
                // Ajoutez les autres ACs de RT2 ici
            ],
            '13' => [
                '01' => [
                    'title' => 'Utiliser un système informatique et ses outils',
                    'preuves' => 'Contenu des preuves pour AC13.01',
                    'analyses' => 'Analyses réflexives pour AC13.01'
                ],
                // Ajoutez les autres ACs de RT3 ici
            ]
        ];

        // Récupérer les données de l'AC spécifique
        $ac_info = $ac_data[$rt_number][$ac_number] ?? [
            'title' => 'Titre non disponible',
            'preuves' => 'Contenu non disponible',
            'analyses' => 'Analyses non disponibles'
        ];

        return $this->render('eportfolio/ac_template.html.twig', [
            'ac_code' => "AC{$rt_number}{$ac_number}",
            'ac_title' => $ac_info['title'],
            'preuves_content' => $ac_info['preuves'],
            'analyses_content' => $ac_info['analyses'],
            'rt_number' => $rt_number
        ]);
    }
}