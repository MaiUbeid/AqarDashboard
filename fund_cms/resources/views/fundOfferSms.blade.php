<table>
    <thead>
    <tr>
        <th>الرقم </th>
        <th>الرقم المعرف</th>
        <th>حالة الطلب</th>
        <th>الرسالة</th>
        <th>الكود </th>
        <th>المدينة </th>
        <th>الأحياء </th>
        <th>نوع العملية </th>


    </tr>
    </thead>
    <tbody>
    @foreach($offers as $offersItem)
        <tr>
            <td>{{ $offersItem->id }}</td>
            <td>{{ $offersItem->uuid }}</td>
            <td>{{ $offersItem->code=='1000'?'نجاح':'فشل' }}</td>
            <td>{{ $offersItem->error_msg }}</td>
            <td>{{ $offersItem->code }}</td>
            <td>{{ $offersItem->fund_request_name->city_name }}</td>
            <td>{{ $offersItem->fund_request_name->neighborhood_name }}</td>
            <td>{{ __('views.'.$offersItem->type) }}</td>



        </tr>
    @endforeach
    </tbody>
</table>