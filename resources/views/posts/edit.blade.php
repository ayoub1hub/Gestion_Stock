@extends('layouts.app') <!-- we match the show page with the app.blade -->
@section('title') Update @endsection <!-- we fill the empty sapce by the right title of the page.blade -->
@section('content')


<form action="{{route('posts.update',$post->id)}}" method="post">
    @csrf <!-- it's a default directive that secures the form submittion from some security issues , what we're obligated to use -->
    @method('put') <!-- we use this diractive to help the html form supporting the method we used with Route which is 'put' , knowing that the default methods understood by htlm forms are : post & get -->
    <div class="mb-3">
    <label for="CodeArticle" class="form-label">Code Article</label>
    <input name="CodeArticle" type="text" value='{{$post->CodeArticle}}' class="form-control" id="CodeArticle">
  </div>
  <div class="mb-3">
    <label for="NomArticle" class="form-label">Nom Article</label>
    <input name="NomArticle" type="text" value='{{$post->NomArticle}}' class="form-control" id="NomArticle">
  </div>
  <div class="mb-3">
    <label for="quantite" class="form-label" >Quantité</label>
    <input name="quantite" type="number" value='{{$post->quantite}}' class="form-control" id="quantite" readonly>
  </div>
  <div class="mb-3">
    <select name="es" id="es" onchange="EouS()">
      <option value="init"  disabled selected>E/S</option>
      <option value="in">Entrée</option>
      <option value="out">Sortie</option>
    </select>
  </div>
  <div class="mb-3">
    <input style='display : none' type="number" name='in' id='in' placeholder='pieces entrées'>
  </div> 
  <div class="mb-3">
    <input style='display : none' type="number" name='out' id='out' placeholder='pieces sorties'>
  </div>      
  <div class="mb-3">
    <label for="puht" class="form-label">Prix Unitaire HT</label>
    <input name="puht" type="text" value='{{$post->puht}}' class="form-control" id="puht">
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
<script>
  
  function EouS(){
    let selected = document.getElementById('es').value;
    if(selected === 'in'){
      document.getElementById('in').style.display = 'block';
      document.getElementById('out').style.display = 'none';
    }else if(selected === 'out'){
      document.getElementById('out').style.display = 'block';
      document.getElementById('in').style.display = 'none';
    }
  }
</script>
@endsection