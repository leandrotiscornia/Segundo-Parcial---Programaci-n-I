<?php
require "../utils/autoload.php"
    
    class PostModelo{
        public $Id;
        public $Titulo;
        public $Fecha;


        public function __construct($id =""){
            parent::__construct();
            if($id !=""){
                $this -> Id = $id;
                $this -> Obtener();
            }
        }
        public function Guardar(){
            if($this -> Id ==NULL) $this -> insertar();
            else $this -> actualizar();
        }
        private function insertar(){
            
        }
        private function actualizar(){

        }
        public function Obtener(){

        }
        public function ObtenerTodos(){

        }
        public function Eliminar(){
            
        }
    }