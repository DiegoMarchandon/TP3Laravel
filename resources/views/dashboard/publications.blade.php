<div class="mt-6 flex justify-center flex-col space-y-6">
    @forelse(Auth::user()->posts as $post)
        <x-post-card :post="$post" :reactions="$reactions" />
    @empty
        <p class="text-black p-4 inline border-4 border-gray-900 bg-yellow-300 dark:text-blue-200 dark:bg-blue-800">No has publicado nada aún.</p>
    @endforelse
</div>