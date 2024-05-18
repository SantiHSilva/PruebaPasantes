@extends('app')

@section('scripts')
<script>
    function crearTipoPokemon(){
        Swal.fire({
            title: "Crear Tipo Pokemon",
            html: `
                <input type="text" id="tipo" class="swal2-input" placeholder="Nombre">
            `,
            showCancelButton: true,
            confirmButtonText: "Crear",
            cancelButtonText: "Cancelar",
            preConfirm: () => {
                return fetch("{{route('tipo_pokemon.store')}}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        tipo: document.getElementById("tipo").value
                    })
                })
                .then(() => {
                    Swal.fire("Tipo Pokemon creado", "", "success").then(() => {
                            location.reload();
                    });
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            }
        })
    }

    function deleteTipoPokemon(id){
        Swal.fire({
            title: "Eliminar Tipo Pokemon",
            text: "¿Estás seguro de que deseas eliminar este tipo pokemon?",
            showCancelButton: true,
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#dc3545",
            preConfirm: () => {
                return fetch(`{{route('tipo_pokemon.delete', '')}}/${id}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(() => {
                    Swal.fire("Tipo Pokemon eliminado", "", "success").then(() => {
                        location.reload();
                    });
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            }
        })
    }

    function editarTipoPokemon(id, tipo){
        console.log(tipo);
        Swal.fire({
            title: "Editar Tipo Pokemon",
            html: `
                <input type="text" id="name" class="swal2-input" placeholder="Nombre" value="${tipo}">
            `,
            showCancelButton: true,
            confirmButtonText: "Editar",
            cancelButtonText: "Cancelar",
            preConfirm: () => {
                return fetch(`{{route('tipo_pokemon.edit', '')}}/${id}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        tipo: document.getElementById("name").value
                    })
                })
                .then(() => {
                    Swal.fire("Tipo Pokemon editado", "", "success").then(() => {
                            location.reload();
                    });
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            }
        })
    }
</script>

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Tipos de Pokemon</h1>
            <button class="btn btn-primary" onclick="crearTipoPokemon()">Crear Tipo Pokemon</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipos as $tipo)
                    <tr>
                        <td>{{$tipo->tipo}}</td>
                        <td>
                            <button class="btn btn-primary" onclick="editarTipoPokemon({{$tipo->id}}, '{{$tipo->tipo}}')">Editar</button>
                            <button class="btn btn-danger" onclick="deleteTipoPokemon({{$tipo->id}})">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
