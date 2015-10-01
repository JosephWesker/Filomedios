@extends('layouts.dashboard')
@section('page_heading','Unidades de Negocio')
@section('section')

<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addBusinessUnit">
                Agregar Unidad de Negocio
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addBusinessUnit" tabindex="-1" role="dialog" aria-labelledby="addBusinessUnit">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Agregar Unidad de Negocio</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '', 'id' => 'agregarUnidadDeNegocio')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('address','Dirección')}}
                                {{ Form::text('address',null,['class' => 'form-control','id' => 'address','placeholder' => 'Dirección'])}}
                            </div>
                            <div class=text-right>
                                {{ Form::button('Aceptar',['class' => 'btn btn-success','id' => 'updateCustomerButton']) }}
                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                            </div>
                            {{ Form::close() }}                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 table-responsive">
            <table class="table table-striped table-hover table-bordered margin-top20">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Comercial</th>
                        <th>Dirección</th>
                    </tr>
                </thead>
                <tbody id="clientes">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
        var showCustomersRoute = '{{ action('customerController@postShowCustomers'); }}';
        var showEmployeesSelectRoute = '{{ action('customerController@postShowEmployeesSelect'); }}';
        var showPostalCodeSelectRoute = '{{ action('customerController@postShowPostalCodeSelect'); }}';
        var createCustomerRoute = '{{ action('customerController@postCreateCustomer'); }}';
        var deleteRoute = '{{ action('customerController@postDeleteCustomer'); }}';
        var getCustomerRoute = '{{ action('customerController@postGetCustomer'); }}';
        var updateRoute = '{{ action('customerController@postUpdateCustomer'); }}';
        var getPostalData = '{{ action('customerController@postPostalData'); }}';</script>
<script src="{{ asset("assets/scripts/clientes_ajax.js") }}" type="text/javascript"></script>

@stop