@extends('layouts.app')

@section('content')
  <div id="app">
    <input id="nameInput" type="text" v-model="newName">
    <button v-on:click="addName">Add Name</button>
    <ul>
      <li v-for="name in names" v-text="name"></li>
    </ul>
  </div>
@stop

@section('scripts')
  @parent

  <script>
    var app = new Vue({
        el: '#app',

        data: {
          newName: '',
            names: []
        },

        methods: {
          addName() {
              alert('adding name');
          }
        }
    });
  </script>
@stop