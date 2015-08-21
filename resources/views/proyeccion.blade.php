@extends('layouts.dashboard')
@section('page_heading','Proyección')
@section('section')

<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">
            <ul id="myTabs" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Home</a></li>
                <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Profile</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                    <table class="table table-sortable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr draggable="true" class="" style="display: table-row;">
                                <td><span class="glyphicon glyphicon-move"></span> 1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr><tr draggable="true" class="" style="display: table-row;">
                                <td><span class="glyphicon glyphicon-move"></span> 2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr draggable="true">
                                <td><span class="glyphicon glyphicon-move"></span> 3</td>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
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
