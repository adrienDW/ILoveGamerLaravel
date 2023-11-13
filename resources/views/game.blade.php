<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--x-welcome /-->
                <!-- resources/views/monFormulaire.blade.php -->

                <x-guest-layout>
                    <div class="pt-4 bg-gray-130">
                        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                            <div>
                                <!--x-authentication-card-logo /-->
                            </div>

                            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                                <x-validation-errors class="mb-4" />

                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ url('/game/list') }}" method="POST">
                                    @csrf

                                    <div>
                                        <x-label for="game" value="{{ __('Game') }}" />
                                        <x-input id="game" class="block mt-1 w-full" type="text" name="game" :value="old('game')" required autofocus autocomplete="game" />
                                    </div>
                                    
                                    <div class="flex items-center justify-end mt-4">
                                        <x-button class="ms-4">
                                            {{ __('Search') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>
                           

                            @if(isset($listGames))
                            <div class="row">
                                <!--div class="col-sm-6 mb-3 mb-sm-0"-->
                                @foreach($listGames as $game)
                                <div class="col-sm-3">
                                    <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><strong>{{$game->name}}</strong></h5>
                                        <img src="{{$game->background_image}}" alt="" width="300px">                            
                                        <a href="{{ route('gameAdd', $game->id) }}" class="btn btn-primary" style="margin-top: 5">Add</a>
                                        
                                    </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            @if(isset($listGameFavorites))
                                @if (count($listGameFavorites) === 1)
                                    <div class="row">
                                    I have one record!
                                    </div>
                                @elseif (count($listGameFavorites) > 1)
                                    <div class="row">
                                    I have multiple records!
                                    </div>
                                @else
                                    <div class="row">
                                    I don't have any records!
                                    </div>
                                @endif

                                <div class="row">
                                    <!--div class="col-sm-6 mb-3 mb-sm-0"-->
                                    @foreach($listGameFavorites as $game)
                                    <div class="col-sm-3">
                                        <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><strong>{{$game->name}}</strong></h5>
                                            <img src="{{$game->image_path}}" alt="" width="300px">                            
                                            <a href="{{ route('gameDelete', $game->id) }}" class="btn btn-primary " style="margin-top: 5">Delete</a>
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </x-guest-layout>



                
                                
            </div>
        </div>
    </div>
</x-app-layout>
