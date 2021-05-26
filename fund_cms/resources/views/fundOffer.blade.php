<table>
    <thead>
    <tr>
        <th>الرقم المعرف</th>
        <th>اسم المستفيد</th>
        <th>رقم المستفيد</th>
        <th>اسم المكتب  </th>
        <th>نوع العقار</th>
        <th>مدينة العقار</th>


    </tr>
    </thead>
    <tbody>
    @foreach($offers as $offersItem)
        <tr>
            <td>{{ $offersItem->uuid }}</td>
            <td>{{ $offersItem->beneficiary_name }}</td>
            <td>{{ $offersItem->beneficiary_mobile }}</td>
            <td>{{ $offersItem->provider->name }}</td>
            <td>{{ $offersItem->estate->estate_type_name }}</td>
            <td>{{ $offersItem->estate->city_name }}</td>


        </tr>
    @endforeach
    </tbody>
</table>