@extends('layouts.dashboard')
@section('page_heading','Gestor de Órdenes de Servicio')
@section('section')

<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-3">    
            <div class="ibox-content dataTables_wrapper form-inline">

                <div id="editable_wrapper" class="dataTables_wrapper form-inline"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="editable_length"><label><select name="editable_length" aria-controls="editable" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> elementos</label></div></div><div class="col-sm-6"><div id="editable_filter" class="dataTables_filter"><label><input type="search" class="form-control input-sm" placeholder="Buscar..." aria-controls="editable"></label></div></div></div><table class="table table-striped table-bordered table-hover  dataTable" id="editable" role="grid" aria-describedby="editable_info">
                        <thead>
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 34px;">#</th><th class="sorting" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" aria-label="Fecha: activate to sort column ascending" style="width: 136px;">Fecha</th></tr>
                        </thead>
                        <tbody>

                            <tr class="gradeX odd" role="row">
                                <td class="sorting_1">1</td>
                                <td>5/Abr/2015</td>
                            </tr><tr class="gradeX even" role="row">
                                <td class="sorting_1">2</td>
                                <td>7/Abr/2015</td>
                            </tr><tr class="gradeX odd" role="row">
                                <td class="sorting_1">3</td>
                                <td>18/Abr/2015</td>

                            </tr><tr class="gradeX even" role="row">
                                <td class="sorting_1">4</td>
                                <td>14/Abr/2015</td>
                            </tr><tr class="gradeX odd" role="row">
                                <td class="sorting_1">5</td>
                                <td>7/Abr/2015</td>
                            </tr><tr class="gradeX even" role="row">
                                <td class="sorting_1">6</td>
                                <td>19/Abr/2015</td>
                            </tr><tr class="gradeX odd" role="row">
                                <td class="sorting_1">7</td>
                                <td>20/Abr/2015</td>
                            </tr><tr class="gradeX even" role="row">
                                <td class="sorting_1">8</td>
                                <td>15/May/2015</td>
                            </tr><tr class="gradeX odd" role="row">
                                <td class="sorting_1">9</td>
                                <td>7/Abr/2015</td>
                            </tr><tr class="gradeX even" role="row">
                                <td class="sorting_1">10</td>
                                <td>11/Abr/2015</td>
                            </tr></tbody>
                        <tfoot>
                            <tr><th rowspan="1" colspan="1">#</th><th rowspan="1" colspan="1">Fecha</th></tr>
                        </tfoot>
                    </table><div class="row"><div class="col-sm-6"><div class="dataTables_info" id="editable_info" role="status" aria-live="polite">Mostrando 1 a 10 de 22 elementos</div></div><div class="col-sm-6"><div class="dataTables_paginate paging_simple_numbers" id="editable_paginate"><ul class="pagination"><li class="paginate_button previous disabled" aria-controls="editable" tabindex="0" id="editable_previous"><a href="#">Anterior</a></li><li class="paginate_button active" aria-controls="editable" tabindex="0"><a href="#">1</a></li><li class="paginate_button " aria-controls="editable" tabindex="0"><a href="#">2</a></li><li class="paginate_button " aria-controls="editable" tabindex="0"><a href="#">3</a></li><li class="paginate_button next" aria-controls="editable" tabindex="0" id="editable_next"><a href="#">Siguiente</a></li></ul></div></div></div></div>

            </div>
        </div>
        <div class="col-lg-9">    

            <style type="text/css"> 
                /*                                h1 { color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 14pt; }*/
                p { color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 11pt; margin:0pt; }
                .s1 { color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 11pt; }
                .s3 { color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 11pt; }
                .s4 { color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 11pt; }
                td>p {display: inline; }

            </style>
            <div class="col-lg-12">    

                <p style="text-indent: 0pt;line-height: 5pt;text-align: left;"><br/></p>
                <div class="col-lg-2">

                    <p style="text-indent: 0pt;text-align: left;">

                        <span><img width="123" height="55" alt="image" src="{{ asset("assets/img/Image_001.png") }}"/>
                        </span></p>
                </div>
                <div class="col-lg-5">
                    <h1 style="text-indent: 0pt;text-align: center; color: black; font-family:Calibri, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 14pt; ">FILOMEDIOS HD</h1>

                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: center;">GRUPO CORPORATIVO FILCOC S.A. DE C.V.</p>

                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: center;">TEL. 01 228 8 12 59 43 Plaza Américas Xalapa</p>
                </div>
            </div>
            <p style="text-indent: 0pt;text-align: center;">ORDEN DE SERVICIO                                                                                                          

                <span class="s1">Fecha: 
                </span><u>                                                            </u></p>

            <p style="text-indent: 0pt;line-height: 1pt;text-align: left;"><br/></p>
            <table style="border-collapse:collapse;width:540pt;margin-left:5.25pt" cellspacing="0">
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="9">

                        <p class="s3" style="padding-left: 176pt;text-indent: 0pt;line-height: 13pt;text-align: left;">DATOS DEL CLIENTE PARA FACTURACIÓN</p>
                    </td>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Nombre comercial</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Contacto</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Puesto</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Teléfono</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Celular o Nextel</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Correo electrónico</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Dirección</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Razón social</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">RFC</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Dirección fiscal</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Calle</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">No. Ext</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">No. Int.</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                </tr>
                <tr>
                    <td style="border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" rowspan="2" bgcolor="#E6E6E6"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">C.P.</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Colonia</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Mun</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Loc.</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Estado</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">País</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Email fiscal</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Forma de pago</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Método de pago</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;padding-right: 15pt;text-indent: 0pt;line-height: 72%;text-align: left;">Últimos 4 dígitos cuenta que paga</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Representante legal</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Duración del contrato</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Impactos al mes</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Importe Total C/IVA</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" rowspan="4" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Importes y fechas de pago</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="9">

                        <p class="s3" style="padding-left: 129pt;text-indent: 0pt;line-height: 13pt;text-align: left;">SOLO PARA SER LLENADOS PARA CADENAS O CORPORATIVOS</p>
                    </td>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Número global de</p>

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">localización (GLN)</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4">

                        <p class="s4" style="text-indent: 0pt;line-height: 13pt;text-align: center;">EAN / UPC</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4">

                        <p class="s4" style="padding-left: 1pt;text-indent: 0pt;line-height: 13pt;text-align: center;">SKU</p>
                    </td>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="9">

                        <p class="s3" style="padding-left: 171pt;text-indent: 0pt;line-height: 13pt;text-align: left;">DATOS PARA PRODUCCIÓN Y PROYECCIÓN</p>
                    </td>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Duración del spot</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Producción Filomedios</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Si</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">No</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" rowspan="2" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Entregado en formato</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">MPG 1</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">MOV</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">MP4</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">MPG 2</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">AVI</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">FLV</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Archivos recibidos</p>

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">(Fotos, logos, imágenes)</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Fecha de</p>

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">grabación</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Fecha de propuesta</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">1a</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">2ª</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Fechas de transmisión</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Inicio</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Termina</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3"/>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="9">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Observaciones</p>
                    </td>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="9">

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;">RECIBÍ LA CANTIDAD DE $                                                                                                                                                 00/100 M.N</p>

                        <p class="s4" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">POR CONCEPTO DE PAGO INICIAL DE SERVICIOS DE PIBLICIDAD AQUÍ DETALLADOS</p>
                    </td>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" bgcolor="#E6E6E6">

                        <p class="s3" style="text-indent: 0pt;line-height: 12pt;text-align: center;">Nombre y firma</p>

                        <p class="s3" style="padding-left: 1pt;text-indent: 0pt;text-align: center;">Ejecutivo Comercial</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3" bgcolor="#E6E6E6">

                        <p class="s3" style="padding-left: 30pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Nombre y Firma</p>

                        <p class="s3" style="padding-left: 33pt;text-indent: 0pt;text-align: left;">Administración</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2" bgcolor="#E6E6E6">

                        <p class="s3" style="text-indent: 0pt;line-height: 12pt;text-align: center;">Nombre y firma</p>

                        <p class="s3" style="text-indent: 0pt;text-align: center;">Productor</p>
                    </td>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3" bgcolor="#E6E6E6">

                        <p class="s3" style="text-indent: 0pt;line-height: 12pt;text-align: center;">Nombre y firma</p>

                        <p class="s3" style="padding-right: 1pt;text-indent: 0pt;text-align: center;">Cliente</p>
                    </td>
                </tr>
                <tr>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2"/>
                    <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="3"/>
                </tr>
            </table>



            <div class="bs-example margin-top20" data-example-id="single-button-dropdown">
                <div class="btn-group">
                    <button type="button" class="btn btn-success" data-toggle="" aria-haspopup="true" aria-expanded="false">Autorizar </button>
                </div><!-- /btn-group -->
                <div class="btn-group">
                    <button type="button" class="btn btn-warning" data-toggle="" aria-haspopup="true" aria-expanded="false">Revisar </button>
                </div><!-- /btn-group -->
                <div class="btn-group">
                    <button type="button" class="btn btn-danger" data-toggle="" aria-haspopup="true" aria-expanded="false">Cancelar </button>
                </div><!-- /btn-group -->
            </div>



        </div>
    </div>
</div>
@stop
