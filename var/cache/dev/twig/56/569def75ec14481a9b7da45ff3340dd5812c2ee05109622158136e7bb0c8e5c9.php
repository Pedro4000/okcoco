<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* events.html.twig */
class __TwigTemplate_cc8b345fe7a143d04aa73cc099416b0a90406823e42324b9e47b4112cdfd6132 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "events.html.twig"));

        // line 1
        echo "<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <title>Landing Club Culture</title>
    <script src=\"script.js\"></script>
</head>
<body>
<header>

</header>
<main>
    <section>
        <h2>Culture Club</h2>
        <p>Culture club vous permet d'échanger du contenu cuturel avec des centaines de curieux</p>
    </section>

</main>
<footer>

</footer>
</body>
</html>";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "events.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <title>Landing Club Culture</title>
    <script src=\"script.js\"></script>
</head>
<body>
<header>

</header>
<main>
    <section>
        <h2>Culture Club</h2>
        <p>Culture club vous permet d'échanger du contenu cuturel avec des centaines de curieux</p>
    </section>

</main>
<footer>

</footer>
</body>
</html>", "events.html.twig", "C:\\Users\\Boulanger\\dev\\cultureClub\\templates\\events.html.twig");
    }
}
