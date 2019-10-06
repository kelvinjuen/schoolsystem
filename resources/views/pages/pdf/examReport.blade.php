<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>REPORT CARD</title>
    <script src="{{ asset('vendor/DataTables/jQuery-3.3.1/jquery-3.3.1.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" ></script>
</head>
<body class="bg-white">
    <div class="container-fluid">

        <h1 class="text-center border-bottom my-4 p-1">Grade {{$grade}} Exam Report </h1>

        <table class="table table-sm table-borderless  my-2">
            <thead>
                <tr>
                <th scope="col"><h5><strong>Grade : </strong><span>{{$grade}}</span></h5></th>
                <th scope="col"><h5><strong>Term : </strong><span>{{$term}}</span></h5></th>
                <th scope="col"><h5><strong>Exam : </strong><span>{{$type}}</span></h5></th>

                </tr>
            </thead>
        </table>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col"  width="5%">#</th>
                    <th scope="col"  width="10%">Name</th>
                    <th scope="col"  width="5%">Math</th>
                    <th scope="col"  width="5%">Eng</th>
                    <th scope="col"  width="5%">Comp</th>
                    <th scope="col"  width="5%">Swa</th>
                    <th scope="col"  width="5%">Insha</th>
                    <th scope="col"  width="5%">Sci</th>
                    <th scope="col"  width="5%">Social</th>
                    <th scope="col"  width="5%">Cre</th>
                    <th scope="col"  width="5%">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; $count = 0; ?>
                @foreach ($exam as $sub)

                    <?php $total += $sub->total ; $count++;?>
                    <tr>
                        <td>{{$sub->position}}</td>
                            <td>{{$sub->name}}</td>
                            <td>{{$sub->math}}</td>
                            <td>{{$sub->english}}</td>
                            <td>{{$sub->composition}}</td>
                            <td>{{$sub->swahili}}</td>
                            <td>{{$sub->insha}}</td>
                            <td>{{$sub->science}}</td>
                            <td>{{$sub->social}}</td>
                            <td>{{$sub->cre}}</td>
                            <td>{{round($sub->total)}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="11">Class Average</th>
                </tr>
                <tr>
                    <th colspan="2"></th>

                    <th>{{round($average->math)}}</th>
                    <th>{{round($average->english)}}</th>
                    <th>{{round($average->comp)}}</th>
                    <th>{{round($average->swahili)}}</th>
                    <th>{{round($average->insha)}}</th>
                    <th>{{round($average->science)}}</th>
                    <th>{{round($average->social)}}</th>
                    <th>{{round($average->cre)}}</th>
                    <th>{{round($total/$count)}}</th>
                </tr>
                <tr>
                    <th colspan="2"></th>
                    <th>{{$average_grade['math']}}</th>
                    <th>{{$average_grade['english']}}</th>
                    <th>{{$average_grade['comp']}}</th>
                    <th>{{$average_grade['swahili']}}</th>
                    <th>{{$average_grade['insha']}}</th>
                    <th>{{$average_grade['science']}}</th>
                    <th>{{$average_grade['social']}}</th>
                    <th>{{$average_grade['cre']}}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>


    </div>
</body>
</html>
