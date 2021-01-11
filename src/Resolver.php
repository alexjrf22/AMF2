<?php

  /** 
         * API reflection é nativa do PHP ela serve para resolver as dependencias, 
         * no caso são duas qual classe e qual methodo usar para o controller saber quem vai renderizar as duas 
         * dependencias vão vim como strings
        */

namespace ALEX;

class Resolver implements \ArrayAccess
{
    use Collection; 

    public function handler(string $class, string $method = null)
    {
      
        $instance = null;
        $ref = new \ReflectionClass($class);
        
        $instance = $this->getInstance($ref);

        if(!$method)
        {
            return $instance;
        }

        $ref_method = new \ReflectionMethod($instance, $method);
        $parameters = $this->methodResolver($ref, $ref_method);
        return call_user_func_array([$instance, $method], $parameters);
    }

    private function getInstance($ref)
    {
        $constructor = $ref->getConstructor();

        if (!$constructor)
        {
            return $ref->newInstance();
        }
        $parameters = $this->methodResolver($ref, $constructor);
        return $ref->newInstanceArgs($parameters);
    }

    private function methodResolver($ref, $method)
    {
        $parameters = [];

        foreach ($method->getParameters() as $param)
        {
            //pega o tipo da classe, e se o tipo existir no array, converte e passa ele pra dentro do array parameters como string
            if ($param->getType() !== null and $this->offsetExists((string)$param->getType()))
            {
                $parameters[] = $this->offsetGet((string)$param->getType());
                continue;
            }
            //verifica se o valor é opcional
            if ($param->isOptional())
            {
                $parameters[] = $param->getDefaultValue(); //se for opcional adiciona ao array parameters, o valor padrão. 
                continue;
            }
            if($param->getClass())
            {
                $parameters[] = $this->handler($param->getClass()->getName());
                continue; // para a execução desse lopp e passa para o proximo item.
            }
        }
        return $parameters;
    }
}