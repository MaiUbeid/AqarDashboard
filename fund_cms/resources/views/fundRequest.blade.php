<table>
    <thead>
    <tr>
        <th>الرقم المعرف</th>
        <th>نوع العقار</th>
        <th>اسم المدينة</th>
        <th>اسماء الأحياء </th>

        <th>مدى  السعر</th>
        <th>مدى  مساحة الشارع</th>
        <th>عدد العروض</th>
        <th>اتجاه الواجهة</th>
        <th>حالة العقار</th>

    </tr>
    </thead>
    <tbody>
    @foreach($requests as $requestItem)
        <tr>
            <td>{{ $requestItem->uuid }}</td>
            <td>{{ $requestItem->estate_type_name }}</td>
            <td>{{ $requestItem->city_name }}</td>
            <td>{{ $requestItem->neighborhood_name }}</td>
            <td>{{ $requestItem->estate_price_range }}</td>
            <td>{{ $requestItem->street_view_range }}</td>
            <td>{{ $requestItem->offers()->count() }}</td>
            <td>{{ $requestItem->dir_estate }}</td>
            <td>{{ $requestItem->estate_status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>