<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h3 {
            text-decoration: underline;
            text-align: center;
            font-size: 24px;
        }

        .logo{
            margin-bottom: 18px;
            color: brown;
        }

        .main {
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 250px;
        }

        .content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-weight: bold;
        }

        .border {
            border: 1px solid red;
        }
        .mb-0{
            margin-bottom: 0px;
        }
        h4 {
            margin-top: 0;
        }
        .ml {
            margin-left: 50px;
        }
        .w-50 {
            width: 150px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="logo">Mon restaurant</h2>
        <h3 >Commandes {{ $data['table_client']['numero_table']}}</h3>
        <div class="main">
            @foreach ($data['plat_commandes'] as $item)
                
                <div class="content">
                    <span class="w-50">{{ucfirst($item['plat']['libelle'])}}</span>
                    <span>{{number_format($item['plat']['prix'], 0, '.', ' ')}} x {{$item['quantite']}}</span>
                </div>
            @endforeach
        </div>
        <hr>
        <div class="content">
            <div class="w-50"><h4>Total</h4></div>
            <div style="display: inline-block;"><h4>{{number_format($total, 0, '.', ' ')}} FCFA</h4></div>
        </div>

        <div>{{$data['date']}}</div>
    </div>
</body>

</html>
