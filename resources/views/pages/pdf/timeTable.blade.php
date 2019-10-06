<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>REPORT CARD</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" ></script>
</head>
<body class="bg-white">
    <div class="container-fluid">

        <h1 class="text-center border-bottom my-4 p-1">Grade {{$grade}} Timetable </h1>

        <table class="table table-sm table-bordered mt-5 " width="100%">
            <thead class="thead-light">
                <tr>
                    <th scope="col" width="5%"><h3>DAY</h3></th>
                    <th scope="col" width="10%"><h3>Les 1</h3></th>
                    <th scope="col" width="10%"><h3>Les 2</h3></th>
                    <th scope="col" width="2%"><h3>B</h3></th>
                    <th scope="col" width="10%"><h3>Les 3</h3></th>
                    <th scope="col" width="10%"><h3>Les 4</h3></th>
                    <th scope="col" width="2%"><h3>B</h3></th>
                    <th scope="col" width="10%"><h3>Les 5</h3></th>
                    <th scope="col" width="10%"><h3>Les 6</h3></th>
                    <th scope="col" width="2%"><h3>L</h3></th>
                    <th scope="col" width="10%"><h3>Les 7</h3></th>
                    <th scope="col" width="10%"><h3>Les 8</h3></th>
                    <th scope="col" width="2%"><h3>B</h3></th>
                    <th scope="col" width="7%"><h3>Games</h3></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($table as $day)

                <tr>
                    <td>{{$day[0]}}</td>
                    <td><?php echo $day[1]; ?></td>
                    <td><?php echo $day[2]; ?></td>
                    <td><h2>B</h2></td>
                    <td><?php echo $day[4]; ?></td>
                    <td><?php echo $day[5]; ?></td>
                    <td><h2>B</h2></td>
                    <td><?php echo $day[7]; ?></td>
                    <td><?php echo $day[8]; ?></td>
                    <td><h2>L</h2></td>
                    <td><?php echo $day[10]; ?></td>
                    <td><?php echo $day[11]; ?></td>
                    <td><h2>B</h2></td>
                    <td>Games</td>


                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
</body>
</html>
