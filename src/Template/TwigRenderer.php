<?php
namespace App\Template;

use Twig_Environment;
use App\Template\Renderer;

class TwigRenderer implements Renderer
{
    private $renderer;

    public function __construct(Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }
    public function render($template, $data = [])
    {
        return $this->renderer->render("$template.html", $data);
    }
}