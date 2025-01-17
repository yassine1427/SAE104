<?php

namespace App\Controller;

use Mpdf\Mpdf;
use PhpOffice\PhpWord\PhpWord;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class EportfolioController extends AbstractController
{
    #[Route('/', name: 'app_eportfolio')]
    public function index(): Response
    {
        return $this->render('eportfolio/index.html.twig', [
            'controller_name' => 'EportfolioController',
        ]);
    }

    #[Route('/c', name: 'app_cv')]
    public function cv(): Response
    {
        return $this->render('cv.html.twig');
    }

    #[Route('/submit-form', name: 'submit_form', methods: ['POST'])]
    public function submitForm(Request $request): Response
    {
        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');

        // Redirect to the thank you page with form data
        return $this->redirectToRoute('thank_you', [
            'firstName' => $firstName,
            'lastName' => $lastName,
        ]);
    }

    #[Route('/thank_you/{firstName}/{lastName}', name: 'thank_you')]
    public function thankYou(string $firstName, string $lastName): Response
    {
        return $this->render('eportfolio/thank_you.html.twig', [
            'firstName' => $firstName,
            'lastName' => $lastName,
        ]);
    }

    #[Route('/generate-pdf', name: 'generate_pdf', methods: ['POST'])]
    public function generatePdf(Request $request): Response
    {
        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');

        $html = $this->renderView('cv.html.twig', [
            'firstName' => $firstName,
            'lastName' => $lastName,
        ]);

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $pdfContent = $mpdf->Output('', 'S');

        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="cv.pdf"',
        ]);
    }

    #[Route('/generate-docx', name: 'generate_docx', methods: ['POST'])]
    public function generateDocx(Request $request): Response
    {
        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText('First Name: ' . $firstName);
        $section->addText('Last Name: ' . $lastName);

        $tempFile = tempnam(sys_get_temp_dir(), 'cv') . '.docx';
        $phpWord->save($tempFile, 'Word2007');

        return new Response(file_get_contents($tempFile), 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="cv.docx"',
        ]);
    }
}
