@extends('layouts.app') <!-- we match the show page with the app.blade -->
@section('title') Create @endsection <!-- we fill the empty sapce by the right title of the page.blade -->
@section('content')


<form action="{{route('posts.store')}}" method="post">
    @csrf <!-- its a default directive that secures the form submittion from some security issues , what we're obligated to use -->
  <div class="mb-3">
    <label for="CodeArticle" class="form-label">Code Article</label>
    <input name="CodeArticle" type="text" class="form-control" id="CodeArticle">
  </div>
  <div class="mb-3">
    <label for="NomArticle" class="form-label">Nom Article</label>
    <input name="NomArticle" type="text" class="form-control" id="NomArticle">
  </div>
  <div class="mb-3">
    <label for="quantite" class="form-label">Quantité</label>
    <input name="quantite" type="number" class="form-control" id="quantite">
  </div>
  <div class="mb-3">
    <label for="puht" class="form-label">Prix Unitaire HT</label>
    <input name="puht" type="text" class="form-control" id="puht">
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
  @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
</form>
@endsection
<script>
    document.querySelector('form').addEventListener('submit', function (event) {
        const puhtInput = document.getElementById('puht');
        const puhtValue = parseFloat(puhtInput.value);

        if (isNaN(puhtValue) || puhtValue <= 0 ) {
            event.preventDefault(); // Empêche l'envoi du formulaire
            alert('Veuillez entrer un nombre valide et raisonnable pour le Prix Unitaire HT.');
            puhtInput.focus(); // Met le focus sur le champ concerné
        }
    });
</script>


