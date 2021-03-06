<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                @can('7.1 Crear Usuario')
                    <ul class="tabs tab-pills">
                        <li>
                            <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal"
                                data-target="#theModal">Agregar</a>
                        </li>
                    </ul>
                @endcan
            </div>
            @include('common.searchbox')

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white">
                            <tr>
                                <th class="table-th text-white">USUARIO</th>
                                <th class="table-th text-white text-center">TELEFONO</th>
                                <th class="table-th text-white text-center">EMAIL</th>
                                <th class="table-th text-white text-center">PERFIL</th>
                                <th class="table-th text-white text-center">STATUS</th>
                                <th class="table-th text-white text-center">IMAGEN</th>
                                <th class="table-th text-white text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $r)
                                <tr>
                                    <td>
                                        <h6>{{ $r->name }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $r->phone }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $r->email }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $r->profile }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge {{ $r->status == 'ACTIVE' ? 'badge-success' : 'badge-danger' }} text-uppercase">{{ $r->status }}</span>
                                    </td>
                                    <td class="text-center">
                                        <img src=" {{ asset('storage/users/' . $r->image) }} " alt="Sin Imagen"
                                            height="30" width="40" class="rounded"> {{-- class="card-img-top img-fluid" --}}
                                    </td>
                                    <td class="text-center">
                                        @can('7.2 Actualizar Usuario')
                                            <a href="javascript:void(0)" wire:click='Edit({{ $r->id }})'
                                                class="btn btn-dark mtmobile" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('7.3 Eliminar usuario')
                                            <a href="javascript:void(0)" onclick="Confirm('{{ $r->id }}')"
                                                class="btn btn-dark" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.users.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('user-add', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('user-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('user-deleted', Msg => {
            $('#theModal').modal('hide')
            noty(Msg, 2)
        })
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('user-withsales', Msg => {
            noty(Msg, 2)
        })
    });

    function Confirm(id) {
        swal.fire({
            title: 'CONFIRMAR',
            text: 'CONFIRMAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#2C272E',
            confirmButtonColor: '#3b3f5c',
            confirmButtonText: 'Aceptar',
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                swal.close()
            }
        })
    }
</script>
