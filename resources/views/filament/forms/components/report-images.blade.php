<div class="container mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach ($getRecord()->images as $image)
    <a href="{{ Storage::url($image) }}" class="w-full">
        <img class="w-full p-3 max-w-lg h-auto object-cover shadow-xl rounded-xl hover:shadow-xxl transition-shadow duration-300"
            src="{{ Storage::url($image) }}" alt="">
    </a>
    @endforeach
</div>