<?php
namespace App\Handlers;

use Http\Request;
use Http\Response;
use App\Template\FrontendRenderer;

class PageController
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

    public function index($params)
    {
        $data = [
            'id_passed' => $params['id'],
        ];
        $html = $this->renderer->render('page', $data);
        $this->response->setContent($html);
    }
}