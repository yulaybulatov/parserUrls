<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\ParserModule\Parser;

class ParserController extends AbstractController
{
    function __construct(
        private readonly Parser $parser,
    )
    {
    }

    #[Route('/parser', name: 'parser')]
    public function index():Response {

        return $this->render('/parser.html.twig', [
            'urls'     => $this->parser->parse()
        ]);
    }

}