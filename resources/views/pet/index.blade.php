<head>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $( document ).ready(function() {
            $('.store #addTag').on('click', function(event) {
                event.preventDefault();
                $( ".store .tags" ).append( '<input type="text" name="tags[][name]"><button id="deleteTag">Usuń</button><br>');
            });

            $('.store .tags ').on('click', 'button', function (event) {
                event.preventDefault();
                $(this).prev('input').remove();
                $(this).prev('br').remove();
                $(this).remove();
            });

            $('.edit #addTag').on('click', function(event) {
                event.preventDefault();
                $( ".edit .tags" ).append( '<input type="text" name="tags[][name]"><button id="deleteTag">Usuń</button><br>');
            });

            $('.edit .tags ').on('click', 'button', function (event) {
                event.preventDefault();
                $(this).prev('input').remove();
                $(this).prev('br').remove();
                $(this).remove();
            });

            $('.store .photos ').on('click', 'button', function (event) {
                event.preventDefault();
                $(this).prev('input').remove();
                $(this).prev('br').remove();
                $(this).remove();
            });
            
            $('.store #addPhoto').on('click', function(event) {
                event.preventDefault();
                $( ".store .photos" ).append( '<input type="text" name="photoUrls[]"><button id="deletePhoto">Usuń</button><br>');
            });

            $('.edit .photos ').on('click', 'button', function (event) {
                event.preventDefault();
                $(this).prev('input').remove();
                $(this).prev('br').remove();
                $(this).remove();
            });

            $('.edit #addPhoto').on('click', function(event) {
                event.preventDefault();
                $( ".edit .photos" ).append( '<input type="text" name="photoUrls[]"><button id="deletePhoto">Usuń</button><br>');
            });
        });
    </script>
</head>

<body>
    <div>
        <h1>Dodaj zwierzaka</h1>
        <form class="store" method="post" action="{{ route('pet.store') }}">
            @csrf
            <label for="name">ID</label>
            <input type="text" name="id"><br>
            <label for="name">Nazwa</label>
            <input type="text" name="name"><br>
            <label for="name">Nazwa kategorii</label>
            <input type="text" name="categoryName"><br>
            <label for="name">Tagi</label>
            <div class="tags">
                <input type="text" name="tags[][name]"><br>
            </div>
            <button id="addTag">Dodaj taga</button><br>
            <label for="photos">URL zdjęć</label>
            <div class="photos">
                <input type="text" name="photoUrls[]"><br>
            </div>
            <button id="addPhoto">Dodaj zdjęcie</button><br>
            <label for="name">Status</label>
            <select name="status">
                <option value="available">Dostępny</option>
                <option value="pending">Oczekujący</option>
                <option value="sold">Sprzedany</option>
            </select><br>
            <button>Dodaj</button>
        </form>

        @if (session('addStatus'))
            <div>
                {{ session('addStatus') }}
            </div>
        @endif
    </div>

    <div>
        <h1>Pobierz zwierzaka po ID</h1>
        <form method="get" action="{{ route('pet.findById') }}">
            <label for="petId">ID zwierzaka</label>
            <input type="text" name="petId"><br>
            <button>Znajdź</button>
        </form>
        @if (session('notFound'))
            <div>
                {{ session('notFound') }}
            </div>
        @endif
    </div>

    @if (is_array($pet))
        <ul>
            <li>ID : {{ $pet['id'] ?? ''}}</li>
            <li>Nazwa : {{ $pet['name'] ?? ''}}</li>
            <li>Nazwa kategorii : {{ $pet['category']['name'] ?? ''}}</li>
            <li>
            Tagi:
                @foreach ($pet['tags'] as $tag)
                    {{ $tag['name'] ?? '' }}
                @endforeach
            </li>
            <li>
            Zdjęcia:
                @foreach ($pet['photoUrls'] as $photoUrl)
                    @if ($photoUrl != null)
                        <img src="{{ $photoUrl }}" width="300" height="300">
                    @endif
                @endforeach
            </li>
            <li>Status : {{ $pet['status'] ?? ''}}</li>
        </ul>
    @endif

    <div>
        <h1> Edytuj zwierzaka </h1>
        <form class="edit" method="post" action="{{ route('pet.edit') }}">
            @csrf
            @method('put')
            <label for="name">ID</label>
            <input type="text" name="id"><br>
            <label for="name">Nazwa</label>
            <input type="text" name="name"><br>
            <label for="categoryName">Nazwa kategorii</label>
            <input type="text" name="categoryName"><br>
            <label for="tags">Tagi</label>
            <div class="tags">
                <input type="text" name="tags[][name]"><br>
            </div>
            <button id="addTag">Dodaj taga</button><br>
            <label for="photos">URL zdjęć</label>
            <div class="photos">
                <input type="text" name="photoUrls[]"><br>
            </div>
            <button id="addPhoto">Dodaj zdjęcie</button><br>
            <label for="name">Status</label>
            <select name="status">
                <option value="available">Dostępny</option>
                <option value="pending">Oczekujący</option>
                <option value="sold">Sprzedany</option>
            </select><br>
            <button>Edytuj</button>
        </form>
        @if (session('editStatus'))
            <div>
                {{ session('editStatus') }}
            </div>
        @endif
    </div>

    <div>
        <h1>Usuwanie zwierzaka po ID</h1>
        <form method="post" action="{{ route('pet.delete') }}">
            @csrf
            @method('delete')
            <label for="petIdToRemove">ID zwierzaka</label>
            <input type="text" name="petIdToRemove"><br>
            <button>Usuń</button>
        </form>
        @if (session('deleteStatus'))
            <div>
                {{ session('deleteStatus') }}
            </div>
        @endif
    </div>
</body>