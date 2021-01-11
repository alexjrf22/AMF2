<?php

namespace ALEX;

class Controller
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->configModel();
    }

    protected function render(array $data = [], string $view = null)
    {
        if(!$view)
        {
            $view = $this->ControllerName() . '/' . debug_backtrace()[1]['function'];
            /** debug_backtrace retorna as informações executadas até o momento em formato array, pegando o indice 1 e pega o nome do function ou seja o public function index. */
        }
        extract ($data);
        require __DIR__ . '/../template/' . $view . '.tpl.php';
    }

    private function ControllerName()
    {
        $class = get_class($this); /**Retorna o nome da classe completo App/Controller/UsersController */
        $class  = explode('\\', $class);  /** transforma o endereço da classe em array [App] , [Controller], [UsersController] */
        $class = array_pop($class); /** Pega o ultimo item do array que é a classe UsersController*/
        $class = preg_replace('/Controller$/', '', $class);/**retira a palavra Controller da classe ficando somente Users */
        return strtolower($class); /** retona a classe como minuscula ou seja users */
    }

    private function configModel()
    {
        if(!$this->model->getTableName())
        {
            $this->model->setTableName($this->ControllerName());
        }
    }
}

