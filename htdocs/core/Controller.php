<?php

class Controller {
    /**
     * Istanza unica del singleton
     * @var object
     */
    private static object $instance;

    /**
     * Costruttore privato per prevenire che venga istanziato da codice esterno.
     */
    private function __construct() {
    }

    /**
     * Metodo pubblico per l'accesso all'istanza unica di classe.
     * @return object|Controller
     */
    public static function getInstance() {
        if ( !isset(self::$instance) ) {
            $calledClass = get_called_class();
            self::$instance = new $calledClass();
        }
        return self::$instance;
    }
}