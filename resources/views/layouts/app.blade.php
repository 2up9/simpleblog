<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
        <x-navbar></x-navbar>

        <main class="container pt-3">
            <x-alert></x-alert>
            @yield('content')
        </main>
    </div>

    <script>
        // Membuat variabel untuk menentukan ID Target
        const input    = document.querySelector('#inputImage');

        // Tambahkan event Change dengan function preview
        input.addEventListener('change', preview);
        // buat function preview
        function preview() {
            // perubahan akan dilakukan pada DOM berformat "File" dan kosong
            let fileObject = this.files[0];
            // File yang dimasukan akan dibaca oleh fungsi FILEREADER
            let fileReader = new FileReader();
            // File akan membaca DOM dengan format yang telah ditentukan
            fileReader.readAsDataURL(fileObject);
            // Ketika ada masukan dari User
            fileReader.onload = function(){
                // Baca file tersebut
                let result    = fileReader.result;
                // Tampilkan pada DOM yang telah dipilih "#preview"
                const img     = document.querySelector("#preview");
                // Masukan hasil dari pembaccan FIle kek SRC
                img.setAttribute("src", result);
            }
        }
            
    </script>
</body>
</html>
