<?php

namespace App\Traits;

trait Navegavel
{

    public function navegar(string $url)
    {
        return $this->redirect($url, navigate: true);
    }
}
