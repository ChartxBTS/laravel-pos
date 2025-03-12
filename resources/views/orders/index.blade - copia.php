@extends('layouts.admin')

@section('title', 'Lista de Pedidos')
@section('content-header', 'Lista de Pedidos')
@section('content-actions')
    <a href="{{route('cart.index')}}" class="btn btn-success">VENDER</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <form action="{{route('orders.index')}}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" />
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary" type="submit">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table id="tablaOrdenes" class="table ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Cliente</th>
                    <th>Total</th>
                    <th>Cantidad Recibida</th>
                    <th>Estado</th>
                    <th>Vuelto</th>
                    <th>Creado En</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->getCustomerName()}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedTotal()}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedReceivedAmount()}}</td>
                    <td>
                        @if($order->receivedAmount() == 0)
                            <span class="badge badge-danger">No Pagado</span>
                        @elseif($order->receivedAmount() < $order->total())
                            <span class="badge badge-warning">Parcial</span>
                        @elseif($order->receivedAmount() == $order->total())
                            <span class="badge badge-success">Pagado</span>
                        @elseif($order->receivedAmount() > $order->total())
                            <span class="badge badge-info">Cambio</span>
                        @endif
                    </td>
                    <td>{{config('settings.currency_symbol')}} {{number_format($order->total() - $order->receivedAmount(), 2)}}</td>
                    <td>{{$order->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($total, 2) }}</th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($receivedAmount, 2) }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{ $orders->render() }}
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#tablaOrdenes').DataTable({
            "order": [[ 0, "desc" ]]
        });
    });
</script>
@endsection