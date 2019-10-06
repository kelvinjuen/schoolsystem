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

        <h1 class="text-center border-bottom my-4 p-1">School Exam Report </h1>

        <table class="table table-sm table-borderless  my-2">
            <thead>
                <tr>
                <th scope="col"><h5><strong>Names : </strong><span>{{$name}}</span></h5></th>
                <th scope="col"><h5><strong>Admission No : </strong><span>{{$admission}}</span></h5></th>
                <th scope="col"><h5><strong>Grade : </strong><span>{{$grade}}</span></h5></th>
                <th scope="col"><h5><strong>Term : </strong><span>{{$term}}</span></h5></th>
                </tr>
            </thead>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col"  width="30%">Subject</th>
                    <th scope="col"  width="10%">Marks</th>
                    <th scope="col"  width="10%">Position</th>
                    <th scope="col"  width="10%">Grade</th>
                    <th scope="col"  width="40%">Comment</th>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <th scope="row">Math</td>
                    <td>{{$math}}</td>
                    <td>{{$position_math}}</td>
                    <td>{{$math_grade}}</td>
                    <td>{{$math_comment}}</td>
                </tr>
                <tr class="text-muted">
                    <td class="text-center">Grammer</td>
                    <td>{{$english}}</td>
                    <td>{{$position_english}}</td>
                    <td>{{$eng_grade}}</td>
                    <td>{{$english_comment}}</td>
                </tr>
                <tr  class="text-muted">
                    <td class="text-center">Composition</td>
                    <td>{{$composition}}</td>
                    <td>{{$position_composition}}</td>
                    <td>{{$comp_grade}}</td>
                    <td>{{$composition_comment}}</td>
                </tr>
                <tr >
                    <th scope="row">English</td>
                    <td>{{$eng_total}}</td>
                    <td>{{$pos_eng_total}}</td>
                    <td>{{$eng_grade_total}}</td>
                    <td>{{$english_comment_total}}</td>
                </tr>
                <tr class="text-muted">
                    <td class="text-center">Lugha</td>
                    <td>{{$swahili}}</td>
                    <td>{{$position_swahili}}</td>
                    <td>{{$swa_grade}}</td>
                    <td>{{$swahili_comment}}</td>
                </tr>
                <tr class="text-muted">
                    <td class="text-center">Insha</td>
                    <td>{{$insha}}</td>
                    <td>{{$position_insha}}</td>
                    <td>{{$insha_grade}}</td>
                    <td>{{$insha_comment}}</td>
                </tr>
                <tr >
                    <th scope="row">Swahili</td>
                    <td>{{$swa_total}}</td>
                    <td>{{$pos_swa_total}}</td>
                    <td>{{$swa_grade_total}}</td>
                    <td>{{$swahili_comment_total}}</td>
                </tr>
                <tr >
                    <th scope="row">Science</td>
                    <td>{{$science}}</td>
                    <td>{{$position_science}}</td>
                    <td>{{$science_grade}}</td>
                    <td>{{$science_comment}}</td>
                </tr>
                <tr >
                    <th scope="row">Social</td>
                    <td>{{$social}}</td>
                    <td>{{$position_social}}</td>
                    <td>{{$social_grade}}</td>
                    <td>{{$social_comment}}</td>
                </tr>
                <tr >
                    <th scope="row">Cre</td>
                    <td>{{$cre}}</td>
                    <td>{{$position_cre}}</td>
                    <td>{{$cre_grade}}</td>
                    <td>{{$cre_comment}}</td>
                </tr>
                <tr >
                    <th scope="row">Total</td>
                    <td>{{$total}}</td>
                    <td>{{$position}}</td>
                    <td>{{$total_grade}}</td>
                    <td>{{$total_comment}}</td>
                </tr>
            </tbody>
        </table>


    </div>
</body>
</html>
