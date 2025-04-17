@extends('layouts.app') <!-- we match the index page with the app.blade -->
@section('title') Index @endsection <!-- we fill the empty title by the name of the right title page.blade -->
@section('content') <!-- we fill the empty page we've created ,with the yield method ; it should have the same name -->
        
        <table class="table m-2">
            <thead>
                <tr>
                    <th scope="col">Code Article</th>
                    <th scope="col">Nom Article</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix Unitaire HT</th>
                    <th scope="col">Créé à</th>                    
                    <th scope="col">Mise à jour à</th>                    
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider"> 
                @foreach($posts as $post)
                <tr>
                    <td>{{$post->CodeArticle}}</td>
                    <td>{{$post->NomArticle}}</td>
                    <td>{{$post->quantite}}</td>
                    <td>{{$post->puht}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                    <td>
                        <a href="{{route('posts.show', $post->id)}}" type="button" class="btn btn-info">View</a>
                        <a href="{{route('posts.edit', $post->id)}}" type="button" class="btn btn-primary">Edit</a>
                        <form style="display: inline" id="deleteForm{{$post->id}}" action="{{route('posts.destroy', $post->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{$post->id}})" class="btn btn-danger">Delete</button>
                        </form>
                        <script>
                            function confirmDelete(postId) {
                                if (confirm('Are you sure you want to delete this post?')) {
                                    document.getElementById('deleteForm' + postId).submit();
                                    
                                }
                            }
                        </script>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            <a href="{{route('posts.create')}}" type="button" class="btn btn-success mt-5">Create post</a>
        </div>
@endsection