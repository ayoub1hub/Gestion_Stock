<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        // to select * (all) from posts : Post::all();
        $postsfromDB = Post::all(); // collection object

        //id , title , description
        
        return view('posts.index' , ['posts'=>$postsfromDB]); // we use either posts.index or posts/index
    }

    public function show($postId){

        //to select * from posts where id = $postId we use : Post::find($postId);
       
        $spostsfromDB = Post::find($postId); // model object (recommanded)
        // $spostsfromDB = Post::where( 'id' , $postId)->first(); // model object
        // $spostsfromDB = Post::where('id',$postId)->get(); // collection object


        $spostsfromDB = Post::findOrFail($postId); // model object (recommanded)
        // if(is_null($spostsfromDB)){
        //     return to_route('posts.index');
        // }


        //we can also use a feature named Route Model Binding which offers to us customizing the code so it works with 2 lines code or less
            // public function show(Post $post){  in parameters , we pass firstly the name of model , in this case is Post , then the value of the dynamic parameter we have in url {post} with the '$' that we return ; that's why we have to name variables and files the way the framework can understand them
            //     return view('posts.show', ['post' => $post]);
            //  }

       
        return view('posts.show', ['post' => $spostsfromDB]);
    }

    public function create(){
        // $users = User::all();
        // dd($users);,['users' => $users]
        return view('posts.create');
    }

    public function store()
{
    // Validation des données
    $validatedData = request()->validate([
        'CodeArticle' => 'required|string|max:255', // Le champ CodeArticle est requis et doit être une chaîne
        'NomArticle' => 'required|string|max:255', // Le champ NomArticle est requis et doit être une chaîne
        'puht' => 'required|numeric|min:0', // Le champ puht doit être un nombre valide >= 0
        'quantite' => 'required|integer|min:0|max:9999.00', // Le champ quantite doit être un entier valide >= 0
    ], [
        // Messages d'erreur personnalisés
        'CodeArticle.required' => 'Le champ Code Article est requis.',
        'NomArticle.required' => 'Le champ Nom Article est requis.',
        'puht.required' => 'Le champ Prix Unitaire HT est requis.',
        'puht.numeric' => 'Le champ Prix Unitaire HT doit être un nombre valide.',
        'quantite.required' => 'Le champ Quantité est requis.',
        'quantite.integer' => 'Le champ Quantité doit être un nombre entier.',
    ]);

    // Stockage des données dans la base
    $post = new Post;
    $post->CodeArticle = $validatedData['CodeArticle'];
    $post->NomArticle = $validatedData['NomArticle'];
    $post->quantite = $validatedData['quantite'];
    $post->puht = $validatedData['puht'];
    $post->save(); // Insertion dans la table 'posts'

    // Redirection avec un message de succès
    return to_route('posts.index')->with('success', 'Article ajouté avec succès.');
}

/*
    public function store(){

        //1- get the user data
            // $data1 =  $_POST;  // $data1 == $data2 ; request() is a method we can use to restore the information from the forms

            // 1st way to store form info. using one variable
                //$data2 = request()->all();  

            // 2nd way to store form info. using as variable as info de we have
                $CodeArticle = request()->CodeArticle;  
                $NomArticle = request()->NomArticle;  
                $puht = request()->puht;  
                $quantite = request()->quantite; 

                if($CodeArticle === null || $NomArticle=== null || $puht === null || $quantite=== null ){
                    return back()->withErrors([
                        'CodeArticle' => 'Le champ Code Article est requis.',
                        'NomArticle' => 'Le champ Nom Article est requis.',
                        'puht' => 'Le champ Prix Unitaire HT est requis.',
                        'quantite' => 'Le champ Quantité est requis.',
                    ])->withInput(); // Retourne les données déjà saisies
                }
                
                // dd($data2 , $title , $description , $creator); // dd() method is used to compact the variables we want to display ;
                
                
        //2- store the submitted data in database

            // 1st way to store info

                $post = new Post; // we create an object from the post model
                $post->CodeArticle = $CodeArticle; //the names of columns we have in the database = ids
                $post->NomArticle = $NomArticle;
                $post->quantite = $quantite;
                $post->puht = $puht;
                $post->save(); // inset into posts

            // 2st way to store info

                // Post::create([
                //     'title' => $title ,
                //     'description' => $description ,
                //     'posted_by' => $creator ,
                // ]); // to use this tool , you must front an error message and it will be about some security issues , 
                    // to solve them , you have to create a protected $fillable in Post.php
            



        //3- redirection to posts.index
        return to_route('posts.index');
    }
*/
    public function edit($postId){
        $post = Post::find($postId);
        return view('/posts/edit' , ['post' => $post]);
    }

    public function update($postId){

        //1- get the user data

        $CodeArticle = request()->CodeArticle;  
        $NomArticle = request()->NomArticle;  
        $puht = request()->puht;  
        $quantite = request()->quantite;
        $entree = request()->input('in', 0); // Valeur par défaut
        $sortie = request()->input('out', 0); // Valeur par défaut
        $selected = request()->input('es'); // Valeur par défaut
        //dd($entree,$quantite,$selected); 
    
        // Logique de mise à jour de la quantité
        if ($selected === 'in') {
            $quantite += $entree;
            //dd($entree,$quantite); 
        } elseif ($selected === 'out') {
            $quantite -= $sortie;
            //dd($sortie,$quantite); 
        }
 
        // dd($CodeArticle, $NomArticle, $puht, $quantite, $entree, $sortie, $selected); 
        
        
        //2- update the submitted data in database

        Post::updateOrCreate(
            // Search conditions to select post
            ['id' => $postId], // Specify the primary key(s) of the record you want to update
            
            // New attribute values
            [
                'CodeArticle' => $CodeArticle,
                'NomArticle' => $NomArticle ,
                'puht' => $puht ,
                'quantite' => $quantite
            ]
        );

        //3- redirection to posts.show
        return to_route('posts.show',['post' => $postId]);
    }

    public function destroy($postId){


        //1- delete the post from the database

            // Post::destroy($postId);
            // or
            $post = Post::find($postId);
            $post->delete();
            //or
            // Post::where('id' , $postId)->delete();

        //2- redirection to the index page
        return to_route('posts.index');
    }
}
