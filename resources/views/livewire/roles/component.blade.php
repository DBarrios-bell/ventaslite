<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h5 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h5>
                <ul class="tabs tab-pills">
                    @can('4.1 Crear Rol')
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal"
                            style="text-decoration: none">Agregar
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
            @include('common.searchbox')

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">ID</th>
                                <th class="table-th text-white text-center">DESCRIPCIÓN</th>
                                <th class="table-th text-white text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>
                                    <h6>{{$role->id}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$role->name}}</h6>
                                </td>
                                <td class="text-center">
                                @can('4.2 Editar Rol')
                                    <a href="javascript:void(0)"
                                    wire:click='Edit({{$role->id}})'
                                    class="btn btn-dark mtmobile" title="Editar Registro">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('4.3 Eliminar Rol')
                                    <a href="javascript:void(0)"
                                    onclick="Confirm('{{$role->id}}')"
                                    class="btn btn-dark " title="Eliminar Registro">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$roles->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.roles.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){

        window.livewire.on('role-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('role-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('role-deleted', Msg => {
            noty(Msg)
        })
        window.livewire.on('role-exists', Msg => {
            noty(Msg)
        })
        window.livewire.on('role-error', Msg => {
            noty(Msg)
        })
        // oculta la modal
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })
        // muestra la modal
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        // oculta los mensajes de validacion en la modal
        $('#theModal').on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none');
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
            if (result.value){
                window.livewire.emit('deleteRow', id)
                swal.close()
            }
        })
    }
</script>
