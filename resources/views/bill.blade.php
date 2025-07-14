<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>

        <link rel="stylesheet" href="{{ url('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/font_lao.css') }}">

</head>
<body>
     <div class="container text-center" style="width: 794px;">
        <p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
        <p>ສັນຕິພາ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນະຖາວອນ</p>
        

        <h2 class="mt-4">ໃບບິນຮັບເງິນ</h2>
        <div class=" d-flex justify-content-end ">
            <span>ໃບບິນເລກທີ່: {{ $id }}</span>
        </div>

    

        <div class="text-start">
            
            @if($bill[0]['CustomerName']==null || $bill[0]['CustomerName']=='' )
                ລູກຄ້າ: ລູກຄ້າທົ່ວໄປ
            @else
                ລູກຄ້າ: {{ $bill[0]['CustomerName'] }}, {{ $bill[0]['PhoneNumber']}}
            @endif
    
        </div>
       
        <table class="table table-bordered">
            <thead>
                <th width="80">ລ/ດ</th>
                <th class="text-start">ລາຍການ</th>
                <th width="120">ລາຄາ</th>
                <th width="90">ຈຳນວນ</th>
                <th width="160">ລວມ</th>
            </thead>
            <tbody>

                    @php($num=1)
                    @php($total=0)
                    @foreach($bill_item as $b)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td class="text-start">{{ $b['ItemName'] }}</td>
                        <td class="text-end">{{ number_format($b['Price'],0,'.',',') }}</td>
                        <td class="text-end">{{ $b['Qty'] }}</td>
                        <td class="text-end">{{ number_format($b['Price']*$b['Qty'],0,'.',',') }}</td>
                        @php($total += $b['Price']*$b['Qty'])
                    </tr>
                    @endforeach
                <tr>
                    <td colspan='4' class="text-end" > ລວມທັງໝົດ </td>
                    <td class="text-end">  {{ number_format($total,0,'.',',') }}</td>
                </tr>
            </tbody>
        </table>
        <div class=" d-flex justify-content-between p-4">
            <span >ພະນັກງານ</span>
            <span >ຜູ້ຈ່າຍເງິນ</span>
        </div>
    </div>

     <script>
        window.print();
        setTimeout('window.close();', 3000);
    </script>

    
</body>
</html>