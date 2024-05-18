@extends('app')

@section('scripts')
<script>
    function crearPokemon(){
        Swal.fire({
            title: "Crear Pokemon",
            html: `
                <input type="text" id="name" class="swal2-input" placeholder="Nombre">
                <input type="text" id="tipo1" class="swal2-input" placeholder="Tipo 1">
                <input type="text" id="tipo2" class="swal2-input" placeholder="Tipo 2">
            `,
            showCancelButton: true,
            confirmButtonText: "Crear",
            cancelButtonText: "Cancelar",
            preConfirm: () => {
                return fetch("{{route('pokemon.store')}}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        name: document.getElementById("name").value,
                        tipo1: document.getElementById("tipo1").value,
                        tipo2: document.getElementById("tipo2").value
                    })
                })
                .then(() => {
                    Swal.fire("Pokemon creado", "", "success").then(() => {
                            location.reload();
                    });
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            }
        })
    }

    function deletePokemon(id){
        Swal.fire({
            title: "Eliminar Pokemon",
            text: "¿Estás seguro de que deseas eliminar este pokemon?",
            showCancelButton: true,
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#dc3545",
            preConfirm: () => {
                return fetch(`{{route('pokemon.delete', '')}}/${id}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(() => {
                    Swal.fire("Pokemon eliminado", "", "success").then(() => {
                        location.reload();
                    });
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            }
        })
    }

    function modifyPokemon(id, nombre, tipo1, tipo2){
            Swal.fire({
                title: "Modificar Pokemon",
                html: `
                    <input type="text" id="name" class="swal2-input" placeholder="Nombre" value="${nombre}">
                    <section>
                        <label for="tipo1">Tipo 1</label>
                        <select name="tipo1">
                            // iterar sobre los tipos de pokemon
                            @foreach($tipos as $tipo)
                                <option value="{{$tipo->tipo}}">{{$tipo->tipo}}</option>
                            @endforeach
                        </select>
                    </section>

                    <section>
                        <label for="tipo2">Tipo 2</label>
                        <select name="tipo2">
                            // iterar sobre los tipos de pokemon
                            @foreach($tipos as $tipo)
                                <option value="{{$tipo->tipo}}">{{$tipo->tipo}}</option>
                            @endforeach
                        </select>
                    </section>

                `,
                showCancelButton: true,
                confirmButtonText: "Modificar",
                cancelButtonText: "Cancelar",
                preConfirm: () => {
                    return fetch(`{{route('pokemon.edit', '')}}/${id}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            name: document.getElementById("name").value,
                            tipo1: document.getElementById("tipo1").value,
                            tipo2: document.getElementById("tipo2").value
                        })
                    })
                    .then(() => {
                        Swal.fire("Pokemon modificado", "", "success").then(() => {
                            location.reload();
                        });
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    });
                }
            })
        }



// Swal.fire({
//   title: "Good job!",
//   text: "You clicked the button!",
//   icon: "success"
// });
</script>
@endsection

@section('content')
<div class="container text-center">
    <h1>
        CRUD POKEMON
    </h1>

    <button
        onclick="crearPokemon()"
    >
        <a>Crear pokemon</a>
    </button>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo 1</th>
                <th>Tipo 2</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pokemones as $pokemon)
            <tr>
                <td>{{$pokemon->name}}</td>
                <td>{{$pokemon->tipo1}}</td>
                <td>{{$pokemon->tipo2}}</td>
                <td>
                    <button onclick="modifyPokemon({{$pokemon->id}}, '{{$pokemon->name}}', '{{$pokemon->tipo1}}', '{{$pokemon->tipo2}}')">
                        <a>Editar</a>
                    </button>
                    <button onclick="deletePokemon({{$pokemon->id}})">
                        <a>Eliminar</a>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


</div>
@endsection
