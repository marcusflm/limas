<?php

namespace App\Traits;


trait Navegavel
{

    public function navegar(string $url)
    {
        return redirect()->to($url);
    }
}
