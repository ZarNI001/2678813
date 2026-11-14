<x-layout>
  <x-slot:title>
    Welcome
  </x-slot:title>

  <div class="max-w-2xl mx-auto">
    @foreach ($wikis as $wiki)
      <div class="max-w-md rounded overflow-hidden shadow-lg mt-2">
        <div class="card-body">
          <div class="font-bold text-xl mb-2">{{ $wiki['title'] }}</div>
          <p>Links to: <a href={{ $wiki['url'] }}>{{ $wiki['url'] }}</a></p>
        </div>
      </div>
    @endforeach
  </div>
</x-layout>
