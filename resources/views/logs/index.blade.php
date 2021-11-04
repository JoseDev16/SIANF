@extends('base')
@section('title')
Logs
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Registros de actividad</li>
                </ol>
            </nav>

            <div class="col-md-12 pt-4 ">

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Fecha y hora </th>
                            <th scope="col">Actividad</th>

                        </tr>
                        @foreach ($logs as $log )
                        <tr>
                            <td> {{ $log->created_at }} </td>
                             <td> {{ $log->actividad }} </td>
                        </tr>
                        @endforeach
                    </thead>
                </table>
                <!-- Paginacion de tabla -->
                <div class="d-flex justify-content-center">
                    {{ $logs->links() }}
                </div>
                <!-- Fin Paginacion de tabla-->


            </div>

        </div>
    </div>
</div>

@endsection

