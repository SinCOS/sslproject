<?php

/* default/index.html */
class __TwigTemplate_1d2580a0a66b6039a4c60c73c978d4fe64f22476fcdc832177be5ad6a2670613 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("default/extends/base.html", "default/index.html", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'script_block' => array($this, 'block_script_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "default/extends/base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    
";
    }

    // line 8
    public function block_script_block($context, array $blocks = array())
    {
        // line 9
        echo "

";
    }

    public function getTemplateName()
    {
        return "default/index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 9,  37 => 8,  32 => 4,  29 => 3,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/index.html", "/Volumes/data/htdocs/sslproject/template/default/index.html");
    }
}
