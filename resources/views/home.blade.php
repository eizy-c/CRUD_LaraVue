@extends('layouts.app')

@section('content')
    <div id="crud-task" class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CRUD LARAVEL - VUE 
                    <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#addTask">Nueva tarea</a>
                </div>
                <div class="card-body">
                     <table class="table table-hover">
                         <thead>
                            <tr>
                                <th>#</th>
                                <th>Tarea</th>
                                <th colspan="2">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="keep in keeps">
                                <td width="10px">@{{ keep.id }}</td>
                                <td width="10px">@{{ keep.keep }}</td>
                                <td width="10px">
                                    <a href="#" class="btn btn-danger ml-3 btn-sm float-right" v-on:click.prevent="deleteKeep(keep)">Delete</a>
                                    <a href="#" class="btn btn-secondary ml-3 btn-sm float-right" v-on:click.prevent="editKeep(keep)">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <nav class="my-3">
  <ul class="pagination">
    <li class="page-item " v-if="pagination.current_page > 1">
      <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)"><</a>
    </li>

    <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active page-item' : 'page-item']">
      <a class="page-link" href="#" @click.prevent="changePage(page)">@{{ page }}</a>
    </li>

    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
      <a class="page-link" href="#"  @click.prevent="changePage(pagination.current_page + 1)">></a>
    </li>
  </ul>
</nav>

        </div>
        <div class="col-md-4 bg-dark ">
            <pre class="text-white">@{{ $data }}</pre>
        </div>
        @include('modal.editTask')
        @include('modal.addTask')
    </div>


@endsection
