import React, { useState, useEffect, useRef } from 'react';
import { Link } from "react-router-dom";
import ReactPaginate from "react-paginate";
import { OverlayTrigger, Tooltip, Alert } from "react-bootstrap";
import { formatDateTimeStamp } from "@utils";
import { sendMatchedOffer, getMatchedOffers } from '../../services/requestsService';
import LoadingButton from "@gull/components/buttons/LoadingButton";
import swal from "sweetalert2";

const MatchedOffersInRequest = (props) => {
    const [savingSpinner, setsavingSpinner] = useState(false);
    const [page_number, setPageNumber] = useState(10);
    const [page, setPage] = useState();
    const [matchedList, setMatchedList] = useState(props.offers);
    const isInitialMount = useRef(true);

    useEffect(() => {
        if (isInitialMount.current) {
            if(props.uuid)
                setPage(1);
            // isInitialMount.current = false;
        } else {
            // Your useEffect code here to be run on update
        }
    });

    useEffect(() => {
        async function populateData() {
            getData(props.uuid, page, page_number, props.type);
        }
        populateData();
    }, [page]);

    const getData = async (uuid, page, limit, type) => {
        try {
            
            if (!props.uuid) return;
            const Res = await getMatchedOffers(uuid, page, limit, type);
            setMatchedList(Res.data.data);
            isInitialMount.current = false;

        } catch (ex) {
            // Console err
        }
    };

    const onSubmit = async (estate_id) => {
        // setsavingSpinner(true);

        // try {
        //     let { uuid } = props.uuid;
        //     var res;
        //     var values = {
        //         estate_id: estate_id,
        //         uuid: props.uuid
        //     };

        //     res = await sendMatchedOffer(values);
        // } catch (ex) {
        //     setsavingSpinner(false);
        // }
        var values = {
            estate_id: estate_id,
            uuid: props.uuid
        };

        swal.fire({
            title: 'تأكيد أرسال العرض؟',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `تأكيد`,
            denyButtonText: `إلغاء`,
            cancelButtonText: `إلغاء`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                sendMatchedOffer(values);
                swal.fire('تم حفظ التغييرات!', '', 'success');

            } else if (result.isDenied) {
                // swal.fire('لم يتم تغيير', '', 'info')
            }
        })
    };

    return (
        <div>
            {matchedList.data && matchedList.data.length > 0
                ? <div>
                    <div className="table-responsive mt-2">
                        <table id="excel-table" className="display table w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>نوع العقار</th>
                                    <th>اسم المكتب</th>
                                    <th>حالة العرض</th>
                                    <th>المدينة</th>
                                    <th>الحي</th>
                                    <th>السعر</th>
                                    <th>المساحه</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                {matchedList.data
                                    .slice(0, page_number)
                                    .map((item, ind) => (
                                        <tr key={ind}>
                                            <td valign="middle">
                                                <div className="ul-widget-app__profile-pic">
                                                    {item.id}
                                                </div>
                                            </td>
                                            <td>
                                                {item.estate_type_name_web}</td>
                                            <td>{item.owner_name}</td>
                                            <td valign="middle">
                                                <div className='badge badge-info p-2 text-capitalize'>
                                                    {item.status == '1' ? 'متاح' : 'غير متاح'}
                                                </div>
                                            </td>
                                            <td dir="ltr">{item.city_name}</td>
                                            <td>{item.neighborhood_name_web}</td>
                                            <td>{item.total_price}</td>
                                            <td>{item.total_area}</td>
                                            <td>
                                                <div className="d-flex">
                                                    <OverlayTrigger placement={"top"} overlay={<Tooltip id="tooltip-top">عرض التفاصيل</Tooltip>}>
                                                        <Link to={`/estate/${item.id}`} className="btn btn-light btn-md m-1 mt-3">
                                                            <i className="i-Eye"></i>
                                                        </Link>
                                                    </OverlayTrigger>
                                                    <LoadingButton
                                                        className="btn btn-primary btn-md m-1 mt-3"
                                                        loading={savingSpinner}
                                                        animation="border"
                                                        spinnerSize="sm">
                                                        <span onClick={() => onSubmit(item.id)}> إرسال العرض</span>
                                                    </LoadingButton>
                                                </div>
                                            </td>
                                        </tr>
                                    ))}
                            </tbody>
                        </table>
                    </div>
                    <div className="d-flex justify-content-end mr-lg-4">
                        <div className="col-sm-12 col-md-6 mb-2">

                            <ReactPaginate
                                previousLabel={"السابق"}
                                nextLabel={"التالي"}
                                breakLabel={"..."}
                                breakClassName={"break-me"}
                                pageCount={Math.ceil(matchedList.total / page_number)}
                                marginPagesDisplayed={2}
                                pageRangeDisplayed={3}
                                onPageChange={data => { setPage(data.selected + 1) }}
                                containerClassName={"pagination pagination-lg"}
                                subContainerClassName={"pages pagination"}
                                activeClassName={"active"}
                            />
                        </div>
                        <div className="col-sm-12 col-md-6 mb-2">
                            <div className="d-flex align-items-center float-right">
                                <span className="mr-1">عناصر</span>
                                <div className="mr-1">
                                    <select
                                        value={page_number}
                                        className="form-control"
                                        onChange={({ target: { value } }) => {
                                            setPageNumber(value);
                                            setPage(1);
                                        }}>
                                        <option value={10}>10</option>
                                        <option value={25}>25</option>
                                        <option value={50}>50</option>
                                        <option value={100}>100</option>
                                    </select>
                                </div>
                                <span>عرض</span>
                            </div>
                        </div>
                    </div>
                </div>
                : <div className="alert alert-info">
                    لا يوجد بيانات
                  </div>}
        </div>
    );
};

export default MatchedOffersInRequest;