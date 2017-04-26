<?php

/* default/extends/base.html */
class __TwigTemplate_0e1e620f7f8101ef958981b8d71eaa364f942975db68baad9f9021b470e2479d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title_block' => array($this, 'block_title_block'),
            'content' => array($this, 'block_content'),
            'script_block' => array($this, 'block_script_block'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    ";
        // line 7
        $this->displayBlock('title_block', $context, $blocks);
        // line 10
        echo "</head>
<body>
    <div class=\"container\">
        <div class=\"row\">
            ";
        // line 14
        $this->displayBlock('content', $context, $blocks);
        // line 17
        echo "        </div>
    </div>
</body>
";
        // line 20
        $this->displayBlock('script_block', $context, $blocks);
        // line 24
        echo "</html>";
    }

    // line 7
    public function block_title_block($context, array $blocks = array())
    {
        // line 8
        echo "    <title>Document</title>
    ";
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "
            ";
    }

    // line 20
    public function block_script_block($context, array $blocks = array())
    {
        // line 21
        echo "

";
    }

    public function getTemplateName()
    {
        return "default/extends/base.html";
    }

    public function getDebugInfo()
    {
        return array (  70 => 21,  67 => 20,  62 => 15,  59 => 14,  54 => 8,  51 => 7,  47 => 24,  45 => 20,  40 => 17,  38 => 14,  32 => 10,  30 => 7,  22 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/extends/base.html", "/Volumes/data/htdocs/sslproject/template/default/extends/base.html");
    }
}
