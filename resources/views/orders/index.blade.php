@extends('layouts.admin')

@section('title', 'Lista de Pedidos')
@section('content-header', 'Lista de Ventas')
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
        <table id="tablaOrdenes" class="table text-center align-middle">
            <thead>
                <tr>
                    <th class="align-middle  text-center">ID</th>
                    <th  class="align-middle text-center">Nombre del Cliente</th>
                    <th  class="align-middle text-center">Fecha</th>
                    <th  class="align-middle text-center">Productos Vendidos</th>
                    <th class="align-middle text-center">Total</th>
                    <th class="align-middle text-center">Ticket</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td class="align-middle text-center">{{ $order->id }}</td>
                    <td class="align-middle text-center">{{ $order->getCustomerName() }}</td>
                    <td class="align-middle text-center">{{ $order->created_at }}</td>
                    <td>
                        <table class="table table-bordered table-sm text-center align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->barcode }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                    <td class="align-middle text-center">{{ config('settings.currency_symbol') }} {{ $order->formattedTotal() }}</td>
                    <td class="align-middle text-center">
                        <a class="btn btn-info" href="{{ route('orders.print', ['id' => $order->id]) }}" target="_blank">
                            <i class="fa fa-print"></i>
                        </a>
                    </td>                                    
                </tr>
                @endforeach
            </tbody>
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