<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket {{ $movieTitle }}</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/ticket.css') }}">
</head>
<body>

    <header>
        <section class="img">
            <img src="{{ asset('assets/images/logotipo.png') }}" alt="">
        </section>
    </header>

    <article class="ticket">
        <section class="photo">
            <img src="http://localhost:8000/api/portraits/{{ $moviePortrait }}">
        </section>
    
        <section class="info">
            <h1 class="title">{{ $movieTitle }}</h1>
            <h1 class="datetime">Hora: {{ $time }} <br> Fecha: {{ $date }} </h1>
            <h1 class="seat">Fila {{ $row }} - Sillón {{ $col }}</h1>
        </section>
    </article>

    <section class="qr">
        <img src="{{ asset('assets/images/qr.png') }}">
    </section>

</body>
</html>
