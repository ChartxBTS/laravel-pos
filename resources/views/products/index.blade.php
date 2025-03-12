@extends('layouts.admin')

@section('title', 'Productos')
@section('content-header', 'Productos')
@section('content-actions')
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="card product-list">
    <div class="card-body">
        <div class="row">
            <div class="col-md-7">
                <a href="{{route('products.create')}}" class="btn btn-success"><i></i>Crear Producto</a>
            </div>
            <div class="col-md-5">
            </div>
        </div>
        <table id="tablaProductos" class="table table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Código de barras</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Creado en</th>
                    <th>Actualizado en</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td><img class="product-img" src="{{ asset('storage/'.$product->image) }}" alt=""></td>
                    <td>{{$product->barcode}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>
                        <span class="right badge badge-{{ $product->status ? 'success' : 'danger' }}">{{$product->status ? 'Activo' : 'Inactivo' }}</span>
                    </td>
                    <td>{{$product->created_at}}</td>
                    <td>{{$product->updated_at}}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('products.destroy', $product)}}"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->render() }}
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="module">
        $(document).ready(function() {
            $(document).on('click', '.btn-delete', function() {
                var $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: '¿Estás seguro?',
                    text: 'Realmente quieres eliminar este producto?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post($this.data('url'), {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        }, function(res) {
                            $this.closest('tr').fadeOut(500, function() {
                                $(this).remove();
                            });
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
        $('#tablaProductos').DataTable({
            "order": [[ 0, "desc" ]]            
        });
    });
    </script>
@endsection