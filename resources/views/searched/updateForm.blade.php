<!DOCTYPE html>
<html lang="en">
<head>
    <title>USERS || Page</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />
    <!--------Tilte------------------->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--------Meta------------------->
    <link rel="stylesheet" href="../main.css/main-dash.css">
    <link rel="stylesheet" href='../Global.css/font-awesome.min.css'>
    <link rel="stylesheet" href="../Global.css/main.css">
    <link rel="stylesheet" href="../main.css/main-dash-media.css">
    <!--------Links------------------->
</head>


<body>


 @if (is_array($subscribers) || is_object($subscribers))

    @foreach($subscribers as $msb)

    <form action="/mobile-update/{{ $msb->id }}" class = "get_data_form_small" method="post">
        @csrf
            <span class="close_data_small"><a href="/dashboard/{{$msb->id}}">X</a></span>
            <h1>بينات المستخدم</h1>
            <label for="">اسم المستخدم</label>

            <input type="text" name="mName" value="{{ $msb->name }}">

            <label for="">البريد الاكتروني</label>

            <input type="text" name="mEmail" value="{{ $msb->email }}">

            <label for="">رقم الهاتف</label>

            <input type="number" name="mMobile" value="{{ $msb->mobile }}">

            <label for="">تاريخ الدفع</label>

            <input type="text" name="" value="{{ $msb->payment_date }}" disabled>

            <label for="">تاريخ الانتهتاء</label>

            <input type="text" name="" value="{{ $msb->expire_date }}" disabled>

            <label for="">قيمه الاشتراك</label>

            <input type="text" name="mPrice" value="{{ $msb->price }}">

            <div class="small_data_control">
                <a href="/pdf-details/{{$msb->id}}" target="_blank" class="fa fa-print"></a>
                <button type="submit" class="fa fa-pencil-square-o"></button>
            </div>
    </form>
    @endforeach
    @endif

<script src="../main.js/main-dash.js"></script> <script src="../main.js/main.js"></script>

</body>  