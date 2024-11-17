@extends ('layouts.principal')
@section('content')

<br>
<div value="{{$con=0}}"></div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!--Tarjeta-->
                <div class="card">
                    <!--Tarjeta_CABEZA-->
                    <div class="card-header">
                        <h1 class="card-title">LISTA SUCURSAL</h1>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">+NUEVO</button>
                            <a href="{{ url('inicio') }}" class="btn btn-secondary">VOLVER</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!--Tabla-->
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="text-center bg-danger text-white">
                                <tr>
                                    <th>n°</th>
                                    <th>CODIGO</th>
                                    <th>MUNICIPIO</th>
                                    <th>NOMBRE</th>
                                    <th>ESTADO</th>
                                    <th>FECHA_CREACION</th>
                                    <th>CREADO_POR</th>
                                    <th>FECHA_MODIFICACION</th>
                                    <th>MODIFICADO_POR</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Sucursales as $Sucursal)
                                    <tr>
                                        <th>{{$con=$con+1}}</th>
                                        <td>{{ $Sucursal["id_sucursal"]}}</td>
                                        <td>{{ $Sucursal["municipio"]}}</td>
                                        <td>{{ $Sucursal["nombre_sucursal"]}}</td>
                                        <td>{{ $Sucursal["estado"]}}</td>
                                        <td>{{ $Sucursal["fecha_creacion"]}}</td>
                                        <td>{{ $Sucursal["creado_por"]}}</td>
                                        <td>{{ $Sucursal["fecha_modificacion"]}}</td>
                                        <td>{{ $Sucursal["modificado_por"]}}</td>
                                        <th>
                                            <div class="btn-group" role="group">
                                                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-editor-{{$Sucursal['id_sucursal']}}">
                                                    <i class="bi bi-pencil-fill"></i> ACTUALIZAR
                                                </a>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--FIN_Tarjeta-->
            </div>
        </div>
    </div>
</section>

<!--MODAL EDITAR-->
@foreach ($Sucursales as $Sucursal)
<div class="modal fade" id="modal-editor-{{$Sucursal['id_sucursal']}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ACTUALIZAR SUCURSAL</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="editar_sucursal" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="cod" name="cod" class="form-control" value="{{ $Sucursal['id_sucursal']}}" required>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">MUNICIPIO</label>
                                <select id="muni" name="muni" class="form-control" required>
                                @foreach ($tblmunicipio as $tbl)
                              <option value="{{ $tbl['id_municipio']}}">{{$tbl["nombre_municipio"]}}</option>
                              @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">NOMBRE</label>
                                <input type="text" id="nomb" name="nomb" class="form-control" value="{{$Sucursal['nombre_sucursal']}}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">ESTADO</label>
                                <select id="estdo" name="estdo" class="form-control" required>
                                @foreach ($tblestado as $tbl)
                                <option value="{{ $tbl['id_estado']}}">{{$tbl["estado"]}}</option>
                                @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                    <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!--MODAL AGREGAR-->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">AGREGAR SUCURSAL</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="agregar_sucursal" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">MUNICIPIO</label>
                                <select id="muni" name="muni" class="form-control" required>
                                    <option>SELECCIONA</option>
                                    @foreach ($tblmunicipio as $tbl)
                                        <option value="{{ $tbl['id_municipio'] }}">{{ $tbl["nombre_municipio"] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">NOMBRE</label>
                                <input type="text" id="nomb" name="nomb" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">ESTADO</label>
                                <select id="estdo" name="estdo" class="form-control" required>
                                    <option>SELECCIONA</option>
                                    @foreach ($tblestado as $tbl)
                                        <option value="{{ $tbl['id_estado'] }}">{{ $tbl["estado"] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                    <button type="submit" class="btn btn-primary">AGREGAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection