<x-app-layout>
<form method="post">
    @csrf
    <div>
        <x-input-label for="game" :value="__('Game')" />
        <x-text-input id="game" class="block mt-1 w-full" type="text" name="game" :value="old('game')" required autofocus  />
        <x-input-error :messages="$errors->get('game')" class="mt-2" />
    </div>
    <button type="submit">Rechercher</button>
</form>





@foreach($games as $game)

<p>{{$game->name}}</p>

<img src="{{$game->background_image}}" alt="" width="200px">

<button>add</button>
<a href

@endforeach

</x-app-layout>