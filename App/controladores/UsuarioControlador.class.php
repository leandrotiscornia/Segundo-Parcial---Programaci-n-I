<?php 
    require "../utils/autoload.php";

    class UsuarioControlador {
        public static function Alta($context){
            $usuario = new UsuarioModelo();
            $usuario -> NombreUsuario = $context['post']['usuario'];
            $usuario -> Nombre_Completo = $context['post']['nombre'];
            $usuario -> Password = $context['post']['password'];
            $usuario -> Guardar();
        }
        public static function Modificar($context){
            $usuario = new UsuarioModelo();
            $usuario -> Id = $context['post']['id'];
            $usuario -> NombreUsuario = $context['post']['usuario'];
            $usuario -> Nombre_Completo = $context['post']['nombre'];
            $usuario -> Password = $context['post']['password'];
            $usuario -> Guardar();
        }
        public static function Obtener(){
            $usuario = new UsuarioModelo();
            return $usuario -> ObtenerTodos();
        }
        public static function Eliminar($context){
            $usuario = new UsuarioModelo();
            $usuario -> Id = $context['post']['id'];
            $usuario -> Eliminar();
        }
    }

