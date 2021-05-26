import React from 'react';
import { formatDateTimeStamp } from "@utils";

const OffersInRequest = (data) => {

    return (
        <div>
            <h3>العروض المقاربة</h3>
            {data.offers && data.offers.length > 0
                ? <div>
                    <div className="table-responsive mt-2">
                        <table id="excel-table" className="display table w-100">
                            <thead>
                                <tr>
                                    <th>UUID</th>
                                    <th>اسم المستفيد</th>
                                    <th>جوال المستفيد</th>
                                    <th>حالة العرض</th>
                                    <th>رقم المنشأة</th>
                                    <th>تاريخ الارسال</th>
                                    <th>تاريخ التعديل</th>
                                    <th>تاريخ الحذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.offers
                                    .map((item, ind) => (
                                        <tr key={ind}>
                                            <td valign="middle">
                                                <div className="ul-widget-app__profile-pic">
                                                    {item.uuid}
                                                </div>
                                            </td>
                                            <td>
                                                {item.beneficiary_name}</td>
                                            <td>{item.beneficiary_mobile}</td>
                                            <td valign="middle">
                                                <div className='badge badge-info p-2 text-capitalize'>
                                                    {item.status_name}
                                                </div>
                                            </td>
                                            <td dir="ltr">{item.instument_number}</td>
                                            <td>{formatDateTimeStamp(item.created_at)}</td>
                                            <td>{formatDateTimeStamp(item.updated_at)}</td>
                                            <td>{formatDateTimeStamp(item.deleted_at)}</td>
                                        </tr>
                                    ))}
                            </tbody>
                        </table>
                    </div>
                </div>
                : <div className="alert alert-info">
                    لا يوجد بيانات
                  </div>}
        </div>
    );
};

export default OffersInRequest;