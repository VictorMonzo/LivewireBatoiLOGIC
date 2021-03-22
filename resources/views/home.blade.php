@extends('plantilla')
@section('titulo', 'Home')
@section('contenido')
    <div class="page-home">
        <div class="container my-5">

            <div class="row">
                <div class="col-md-6 ">
                    <img src="{{ asset('imgs/laravel-livewire.jpg') }}" class="img-responsive center-block" alt="laravel-livewire"/>
                    <div class="h-30"></div>
                </div>
            </div>

            <p class="text-justify">Livewire es un <strong>framework full-stack</strong> para el desarrollo de componentes Laravel que pueden comunicarse automáticamente entre la vista y el controlador, de modo que se produzcan <strong>comportamientos dinámicos</strong> sin usar JavaScript. Ofrece la posibilidad de realizar componentes con programación JavaScript avanzada, pero sin necesidad de escribir código del lado del cliente.</p>

        </div>
    </div>
@endsection
