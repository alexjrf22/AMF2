<?php

namespace ALEX;

/** ArrayAcess é uma interface do php para trabalhar com uma coleção de dados e obriga
 * a implementação de 4 metodos OffsetExists. offsetGet, offsetSet e offsetUnset. Esses metodos estão implementados na trait Collection.
 */

class Router implements \ArrayAccess
{
    use Collection; 

    public function handler()
    {
        $path = $_SERVER['PATH_INFO'] ?? '/';

        if (strlen($path) > 1)
        {
            $path = rtrim($path, '/');
        }

        if($this->offsetExists($path))
        {
            return $this->offsetGet($path);
        }

        http_response_code(404);
        echo 'Página Não Encontrada';
        exit;
    }
}