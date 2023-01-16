<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>about page</title>
</head>
<body>

    <h3>about page</h3>


    <?php    
        $name="Mohammad Saleh" ;
        $nationalities =["Palestinan","Jordanian","Qatari"];
       // $nationalities =[];
        $nothing ="no data found";
        
    
    ?>
    {{$name }}

    {!! "<h3>Html content</h3>" !!}

    @if (count($nationalities) > 0)
       <ul>
       @foreach ($nationalities as $nationality)
            <li> {{$nationality}} </li>
       @endforeach
       </ul>        
    @else    
       {{$nothing}}    
    @endif
    
    <br>
    <a href="{{ route('contact') }}">contact</a>
</body>
</html>