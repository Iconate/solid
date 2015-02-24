<?php
namespace App\Template;

use Twig_Environment;
use App\Template\FrontendRenderer;

class FrontendTwigRenderer implements FrontendRenderer
{
    private $renderer;

    public function __construct(Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }
    public function render($template, $data = [])
    {
        $data = array_merge($data, [
            'menuItems' => [['href' => '/', 'text' => 'Homepage']],
        ]);
        return $this->renderer->render("$template.html", $data);
    }
}