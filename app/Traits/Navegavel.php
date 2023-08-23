<?php

namespace App\Traits;


trait Navegavel
{

    public function navegar(string $url)
    {
        if ($url != null) {
            return redirect()->to($url);
        }
    }
}
