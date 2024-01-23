<?php
require_once 'Controladores/ControladorViaje.php';
require_once 'Modelos/ModeloViaje.php';


?>
<div class="container mt-3">
    <div class="row">
        <div class="col-6">

            <div class="movimientoServicio shadow bg-light pb-3">
                <div class="cabeceraMovimientos p-2 rounded-top text-white " style="background: #154360;">
                    <h5 class="p-1 m-0 fw-bold text-center" style="font-size: 14px;">TABLA DE MOVIMIENTOS</h5>
                </div>
                <div class="contenidoMovimientos p-2 rounded-end">
                    <h5 class="p-1 m-0 text-left fw-bold mt-1 px-2" style="font-size: 15px;">SERVICIOS PUBLICOS</h5>
                    <div class="row px-2">
                        <div class="col-4 mt-3">
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0" style="font-size: 13px; background: #154360;">Interno - Dominio</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #154360;">AD273GM</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #154360;">DATOS</h5>
                        </div>
                        <div class="col-4 mt-3">
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0" style="font-size: 13px; background: #154360;">Ingreso</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #baddf3;">--</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #baddf3;">--</h5>
                        </div>
                        <div class="col-4 mt-3">
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0" style="font-size: 13px; background: #154360;">Egreso</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #baddf3;">--</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #baddf3;">--</h5>
                        </div>
                    </div>


                    <h5 class="p-1 m-0 text-left fw-bold mt-3 px-2" style="font-size: 15px;">ZONA DE DESCARGA</h5>
                    <div class="row px-2">
                        <div class="col-3 mt-3">
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0" style="font-size: 13px; background: #154360;">Interno - Dominio</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #154360;">AD273GM</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #154360;">DATOS</h5>
                        </div>
                        <div class="col-3 mt-3">
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0" style="font-size: 13px; background: #154360;">Ingreso</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #baddf3;">--</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #baddf3;">--</h5>
                        </div>
                        <div class="col-3 mt-3">
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0" style="font-size: 13px; background: #154360;">Pesaje</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #baddf3;">--</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #baddf3;">--</h5>
                        </div>
                        <div class="col-3 mt-3">
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0" style="font-size: 13px; background: #154360;">Egreso</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #baddf3;">--</h5>
                            <h5 class="text-center fw-bold text-white p-2 py-3 rounded shadow-sm m-0 mt-1" style="font-size: 13px; background: #baddf3;">--</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="movimientoServicio shadow bg-light pb-3">
                <div class="cabeceraMovimientos p-2 rounded-top text-white " style="background: #154360;">
                    <h5 class="p-1 m-0 fw-bold text-center" style="font-size: 14px;">EQUIPO DE TRABAJO</h5>
                </div>
                <div class="contenidoMovimientos p-2 rounded-end">
                    <h5 class="p-1 m-0 mt-2 text-center fw-bold px-2" style="font-size: 15px;">DATOS DEL CAMION <i class="fas fa-car"></i></h5>
                    <hr>
                    <div class="row px-2 container-fluid">
                        <div class="col-4">
                            <label class="">INTERNO: <span class="text-primary">004</span></label>
                        </div>
                        <div class="col-4">
                            <label class="">DOMINIO: <span class="text-primary">AD273GM</span></label>
                        </div>
                        <div class="col-4">
                            <label class="">MARCA: <span class="text-primary">CHEVROLET</span></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row px-2">
                        <div class="col-6">
                            <label class="">PROPIETARIO: <span class="text-primary">004</span></label>
                        </div>
                        <div class="col-6">
                            <label class="">TELEFONO: <span class="text-primary">AD273GM</span></label>
                        </div>
                        <div class="col-6">
                            <label class="">CHOFER: <span class="text-primary">004</span></label>
                        </div>
                        <div class="col-6">
                            <label class="">TELEFONO: <span class="text-primary">AD273GM</span></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row px-2">
                        <div class="col-6 text-center">
                            <label class="">TURNO: <span class="text-primary">AD273GM</span></label>
                        </div>
                        <div class="col-6 text-center">
                            <label class="">ZONA: <span class="text-primary">AD273GM</span></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row px-2">
                        <div class="col-12 mt-1">
                            <h5 class="rounded p-2 bg-warning fw-bold" style="font-size: 13px;">ESTADO: EN ESPERA <h5>
                        </div>
                    </div>
                    <hr>
                    <h5 class="p-1 m-0 mt-2 text-center fw-bold px-2" style="font-size: 15px;">DATOS DE LA COOPERATIVA <i class="fas fa-users"></i></h5>
                    <hr>
                    <div class="row px-2 pt-2">
                        <div class="col-12">
                            <label class="">COOPERATIVA: <span class="text-primary">17 DE OCTUBRE</span></label>
                        </div>
                        <div class="col-12">
                            <label class="">GRUPO: <span class="text-primary">N° 3</span></label>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>