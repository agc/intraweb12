<?php


class DefectoController extends AppController
{

    public function display($pagina = null)
    {
        $this->layout = 'default';
        $titulo = Configure::read('Sitio.nombre') . ' ' .
            Configure::read('Sitio.agno') . ' versión ' .
            Configure::read('Sitio.version');
        $this->set('titulo', $titulo);
        if ($pagina != null) $this->render($pagina);

    }
}

