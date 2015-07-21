<?php

namespace Nav\CMSBundle\Controller;

use CloudConvert\Api;
use CloudConvert\Process;
use Nav\CMSBundle\Entity\Document;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class ConvertController extends Controller
{
    public function convertAction(Request $request)
    {
        $document = new Document();

        $form = $this->createFormBuilder($document)
            ->add('file')
            ->add('Upload', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $document->upload();
            $document->setPath('uploads/pages/' . $document->getFileName());
            $em->persist($document);
            $api = new Api('p8L1xbJzlruisUxW8GJKSUefEIUoBlXk5PXvKSTWGZSlG897vlfKNBX1TFgi4xfRDKBFkUz8foF-7BjxQBDooQ');
            $response = $api->convert([
                "input" => "upload",
                "save" => true,
                "inputformat" => "pages",
                "outputformat" => "pdf",
                "file" => fopen($document->getFileName(), 'r'),
            ])
                ->wait()
                ->download();
            // TODO: Download file directly in browser
            $process = new Process($api, $response->url);
            $process->download($response->output->url);
            exit;
            $em->flush();
            return $this->redirect($this->generateUrl('nav_convert'));
        }

        return $this->render('@NavCMS/Convert/convert.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function downloadPDF($converted)
    {
        header('Content-type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Content-Transfer-Encoding: binary');
        readfile($filename);
    }

}
