@foreach ($authors as $author)
<div class="about-us__person">
    <h2 class="about-us__person-name">{{ $author['name'] }}</h2>
    @if ($author['position'] !== 'CEO')
    <div class="about-us__person-age">{{ $author['age'] }}</div>
    @endif
    <div class="about-us__person-position">{{ $author['position'] }}</div>
</div>
@endforeach
