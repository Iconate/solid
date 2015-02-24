<?php
namespace App\Handlers;

use Http\Request;
use Http\Response;
use App\Template\FrontendRenderer;

class HomeController
{
    private $request;
    private $response;
    private $renderer;

    public function __construct(
        Request $request,
        Response $response,
        FrontendRenderer $renderer
    )
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
    }

    public function index()
    {
        $data = [
            'name' => $this->request->getParameter('name', 'stranger'),
        ];
        $html = $this->renderer->render('homepage', $data);
        $this->response->setContent($html);
    }
}