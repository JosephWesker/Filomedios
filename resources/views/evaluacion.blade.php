@extends('layouts.dashboard')
@section('page_heading','Evaluación de Vendedores')
@section('section')
<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">    
            <div class="full-width-tabs">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">                    
                    <li role="presentation" class="active fill_width"><a href="#results" role="tab" id="home-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Consultar Resultados</a></li>
                    <li role="presentation" class="fill_width"><a href="#projections" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Proyecciones</a></li>
                    <li role="presentation" class="fill_width"><a href="#goals" id="profile-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Registro de Metas</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="results" aria-labelledby="home-tab">
                        <div class="col-lg-12">
                            <h3><b>Buscar</b></h3> 
                            <hr>
                            <div class="form-group col-lg-5">
                               {{ Form::label('employee','Empleado')}}
                               {{ Form::select('employee', ['null'=>'---Seleccionar Empleado---'],null,['class' => 'form-control','id'=>'eva_emp_id']) }}
                           </div>                           
                           <div class="form-group col-lg-5">
                               {{ Form::label('employee','Mes y Año')}}
                               {{ Form::select('employee', ['null'=>'---Seleccionar Mes/Año---'],null,['class' => 'form-control','id'=>'eva_emp_id', 'disabled']) }}
                           </div>
                           <div class="col-lg-2">
                                <br>
                                <button type="button" class="btn btn-success" onclick="updateEvaluations()">
                                    Actualizar Evaluaciones
                                </button>
                            </div>
                       </div>                   
                       <h3><b>Tabla de Resultados</b></h3> 
                       <hr>
                       <table class="table table-striped table-hover table-bordered margin-top20">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>% de Clientes</th>
                                <th>Duración Promedio del Contrato</th>
                                <th>Valumen de Ventas</th>
                                <th>Metas Conseguidas</th>
                                <th>Mes</th>
                                <th>Año</th>
                                <th>Metas Conseguidas</th>
                            </tr>
                        </thead>
                        <tbody id="results">
                            <td colspan="8">Selecciona Empleado y Fecha para ver resultados</td>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="projections" aria-labelledby="profile-tab">
                   <h3><b>Parámetros</b></h3> 
                   <hr>
                   <div class="col-lg-12">
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ Form::label('amount','% de Clientes Esperado')}}
                            {{ Form::number('amount',null,['class' => 'form-control','id' => 't_res_customer_porcent','placeholder' => '%'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('amount','Duración Promedio del Contrato Esperado')}}
                            {{ Form::number('amount',null,['class' => 'form-control','id' => 't_res_duration_average','placeholder' => 'Meses'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('amount','Valumen de Ventas Esperado')}}
                            {{ Form::number('amount',null,['class' => 'form-control','id' => 't_res_sales_volume','placeholder' => '$$$$$'])}}
                        </div>
                    </div>                        
                </div>
                <h3><b>Escenario</b></h3> 
                <hr>
                <table class="table table-striped table-hover table-bordered margin-top20">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>% de Clientes</th>
                            <th>Duración Promedio del Contrato</th>
                            <th>Valumen de Ventas</th>
                            <th>Metas Conseguidas</th>
                        </tr>
                    </thead>
                    <tbody id="proyections">

                    </tbody>
                </table> 

            </div>
            <div role="tabpanel" class="tab-pane fade" id="goals" aria-labelledby="profile-tab">
                <div class="col-lg-12">
                    <!-- Modal -->
                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addShow">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Agregar Programa</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        {{ Form::label('amount','% de Clientes Esperado')}}
                                        {{ Form::number('amount',null,['class' => 'form-control','id' => 'res_customer_porcent','placeholder' => '%'])}}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('amount','Duración Promedio del Contrato Esperado')}}
                                        {{ Form::number('amount',null,['class' => 'form-control','id' => 'res_duration_average','placeholder' => 'Meses'])}}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('amount','Valumen de Ventas Esperado')}}
                                        {{ Form::number('amount',null,['class' => 'form-control','id' => 'res_sales_volume','placeholder' => '$$$$$'])}}
                                    </div>
                                    <div class=text-right>
                                        {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'saveGoals()']) }}
                                        {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                                    </div>
                                    {{ Form::close() }}                        
                                </div>
                            </div>
                        </div>
                    </div>    
                    <br>
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add">
                        Agregar Evaluación
                    </button>            
                    <h3><b>Evaluaciones</b></h3> 
                    <hr>
                    <table class="table table-striped table-hover table-bordered margin-top20">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>% de Clientes</th>
                                <th>Duración Promedio del Contrato</th>
                                <th>Valumen de Ventas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="evaluations">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>       
var createGoalsRoute = '{{ action('evaluationController@postCreateGoal'); }}';
var readGoalsRoute = '{{ action('evaluationController@postReadGoals'); }}';
var activateRoute = '{{ action('evaluationController@postActivateGoal'); }}';
var updateEvaluationsRoute = '{{ action('evaluationController@postEvaluate'); }}';
</script>
<script src="{{ asset("assets/scripts/evaluation_ajax.js") }}" type="text/javascript"></script>

@stop
