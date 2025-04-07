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

    #[Route('/eportfolio/cv', name: 'app_cv')]
    public function cv(): Response
    {
        return $this->render('eportfolio/cv.html.twig');
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
        // Extraire le numéro RT du chemin de la requête
        $path = $_SERVER['REQUEST_URI'];
        if (preg_match('/ac(\d{2})/', $path, $matches)) {
            $rt_number = $matches[1];
            
            // Si c'est AC11.01, AC11.02, AC11.03, AC11.04, AC11.05 ou AC11.06, utiliser les templates spécifiques
            if ($rt_number === '11') {
                if ($number === '01') {
                    return $this->render('eportfolio/ac11_01.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '02') {
                    return $this->render('eportfolio/ac11_02.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '03') {
                    return $this->render('eportfolio/ac11_03.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '04') {
                    return $this->render('eportfolio/ac11_04.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '05') {
                    return $this->render('eportfolio/ac11_05.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '06') {
                    return $this->render('eportfolio/ac11_06.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                }
            } elseif ($rt_number === '12') {
                if ($number === '01') {
                    return $this->render('eportfolio/ac12_01.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '02') {
                    return $this->render('eportfolio/ac12_02.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '03') {
                    return $this->render('eportfolio/ac12_03.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '05') {
                    return $this->render('eportfolio/ac12_05.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                }
            } elseif ($rt_number === '13') {
                if ($number === '01') {
                    return $this->render('eportfolio/ac13_01.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '02') {
                    return $this->render('eportfolio/ac13_02.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '03') {
                    return $this->render('eportfolio/ac13_03.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '04') {
                    return $this->render('eportfolio/ac13_04.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '05') {
                    return $this->render('eportfolio/ac13_05.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                } elseif ($number === '06') {
                    return $this->render('eportfolio/ac13_06.html.twig', [
                        'rt_number' => $rt_number
                    ]);
                }
            }

            // Pour les autres cas, utiliser le template générique
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
            $ac_info = $ac_data[$rt_number][$number] ?? [
                'title' => 'Titre non disponible',
                'preuves' => 'Contenu non disponible',
                'analyses' => 'Analyses non disponibles'
            ];

            return $this->render('eportfolio/ac_template.html.twig', [
                'ac_code' => "AC{$rt_number}{$number}",
                'ac_title' => $ac_info['title'],
                'preuves_content' => $ac_info['preuves'],
                'analyses_content' => $ac_info['analyses'],
                'rt_number' => $rt_number
            ]);
        }

        return $this->render('eportfolio/ac_template.html.twig', [
            'ac_code' => "AC{$rt_number}{$number}",
            'ac_title' => 'Titre non disponible',
            'preuves_content' => 'Contenu non disponible',
            'analyses_content' => 'Analyses non disponibles',
            'rt_number' => $rt_number
        ]);
    }
}