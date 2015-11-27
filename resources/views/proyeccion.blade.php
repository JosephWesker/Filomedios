@extends('layouts.dashboard')
@section('page_heading','Proyección')
@section('section')

<!-- jQuery -->
        <script src="{{ asset("assets/stylesheets/proyeccion/jquery.min.js") }}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function () {
        //Helper function to keep table row from collapsing when being sorted
        var fixHelperModified = function (e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function (index)
            {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        };

        //Make diagnosis table sortable
        $("#diagnosis_list tbody").sortable({
            helper: fixHelperModified,
            stop: function (event, ui) {
                renumber_table('#diagnosis_list')
            }
        }).disableSelection();


        //Delete button in table rows
        $('table').on('click', '.btn-delete', function () {
            tableID = '#' + $(this).closest('table').attr('id');
            r = confirm('¿Estás seguro que deseas eliminar?');
            if (r) {
                $(this).closest('tr').remove();
                renumber_table(tableID);
            }
        });

    });

//Renumber table rows
    function renumber_table(tableID) {
        $(tableID + " tr").each(function () {
            count = $(this).parent().children().index($(this)) + 1;
            $(this).find('.priority').html(count);
        });
    }


</script>
<style type="text/css">
    .ui-sortable tr {
        cursor:pointer;
    }

    .ui-sortable tr:hover {
        background: #c9e2b3;
    }

</style>




<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">
<!--            <ul id="myTabs" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Home</a></li>
                <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Profile</a></li>
            </ul>-->
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">

                    <table class="table" id="diagnosis_list">
                        <thead>
                            <tr><th>ID</th><th>Nombre</th><th>Duración</th><th>Acciones</th></tr>
                        </thead>
                        <tbody class="ui-sortable">

                            <tr class="ui-sortable-handle"><td class="priority">1</td><td>John Adams</td><td>2:00</td><td><a class="btn btn-delete btn-danger">Eliminar</a></td></tr>
                            <tr class="ui-sortable-handle" style="display: table-row;"><td class="priority">2</td><td>Jeff</td><td>3:00</td><td><a class="btn btn-delete btn-danger">Eliminar</a></td></tr>
                            <tr class="ui-sortable-handle" style="display: table-row;"><td class="priority">3</td><td>Alexander Hamilton</td><td>3:32</td><td><a class="btn btn-delete btn-danger">Eliminar</a></td></tr>
                            <tr class="ui-sortable-handle" style="display: table-row;"><td class="priority">4</td><td>Thomas Jefferson</td><td>2:43</td><td><a class="btn btn-delete btn-danger">Eliminar</a></td></tr>
                            <tr class="ui-sortable-handle"><td class="priority">5</td><td>Ben Franklin</td><td>1:59</td><td><a class="btn btn-delete btn-danger">Eliminar</a></td></tr>

                        </tbody>
                    </table>

                </div>
                <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                </div>
            </div>
        </div>
    </div>
</div>

@stop
