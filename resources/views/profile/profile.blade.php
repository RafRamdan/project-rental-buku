@extends('layouts.mainlayout')

@section('title', 'Profile')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
    body{
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background-color: #ddd;
        align-items: center;
        justify-content: center;
    }

    *{
        box-sizing: border-box;
    }

    .container{
        display: flex;
        width: 100%;
        height: 100%;
        padding: 20px 20px;
    }

    .box{
        flex: 30%;
        display: table;
        align-items: center;
        text-align: center;
        font-size: 20px;
        background-color: #0d1425;
        color: #fff;
        padding: 30px 30px;
        border-radius: 20px;
    }

    .box img{
        border-radius: 50%;
        border: 2px solid #fff;
        height: 250px;
        width: 250px;
    }

    .box ul{
        margin-top: 30px;
        font-size: 30px;
        text-align: center;
    }
    .box ul li{
        list-style: none;
        margin-top: 50px;
        font-weight: 100;
    }

    .box ul li i{
        cursor: pointer;
        margin: 10px;
        font-size: 40px;
    }

    .box ul li i:hover{
        opacity: 0.6;
    }

    .About{
        margin-left: 20px;
        flex: 50%;
        display: table;
        padding: 30px 30px;
        font-size: 20px;
        background-color: #fff;
        border-radius: 20px;
    }

    .About h1{
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 50px;
        font-weight: 500;
    }

    .About ul li{
        list-style: none;
    }

    .About ul{
        margin-top: 20px;
    }

    @media screen and (max-width: 1068px) {
        .container{
            display: table;
        }

        .box{
            width: 100%;
        }

        .About{
            width: 100%;
            margin: 0;
            margin-top: 20px;
        }

        .About h1{
            text-align: center;
        }
    }
</style>

<body>
    <div class="container">
        <div class="mt-5">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="About">
            <ul>
                <h1>Profile</h1>
            </ul>
            <ul>
                <h3>Username</h3>
                <li>{{$rent_logs->user->username}}</li>
            </ul>
            <ul>
                <h3>Nis</h3>
                <li>{{$rent_logs->user->nis}}</li>
            </ul>
            <ul>
                <h3>Class</h3>
                <li>{{$rent_logs->user->class}}</li>
            </ul>
            <ul>
                <h3>Phone</h3>
                <li>{{$rent_logs->user->phone}}</li>
            </ul>
            <ul>
                <h3>Address</h3>
                <li>{{$rent_logs->user->address}}</li>
            </ul>
        </div>
    </div>
</body>

@endsection