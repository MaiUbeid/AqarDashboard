import React, { Component } from "react";
import { Breadcrumb } from "@gull";
import { formatDateTimeStamp } from "@utils";
import { getDeferredDetails } from '../../../services/bankServcies';
import { Loading } from "@gull";

class deferredInstallmentsDetails extends Component {
    state = {
        loading: false,
        itemId: '',
        itemDetails: {},
        itemImages: []
    };


    componentDidMount() {
        this.setState({ loading: true });
        this.setState({ itemId: this.props.match.params.id });
        if (this.props.match.params.id !== null) {
            getDeferredDetails(this.props.match.params.id).then(res => {
                this.setState({ itemDetails: res.data.data, loading: false });
            });
        }
    }

    render() {
        let {
            loading,
            itemId,
            itemDetails
        } = this.state;
        return (
            <div>
                <Breadcrumb
                    routeSegments={[
                        { name: "الرئيسية", path: "/" },
                        { name: "قائمة تقسيط التأجير ", path: "/bank/deferred-installments" },
                        { name: itemDetails.id }
                    ]}
                ></Breadcrumb>
                <div className="card m-sm-30 text-left">
                    {loading && <Loading></Loading>}

                    <div className={`card-body pt-4  ${loading ? 'invisible' : 'visible'}`}>
                        <h4>تفاصيل الطلب</h4>
                        <hr />

                        <div className="row">
                            <div className="col-md-4 col-6">
                                <div className="mb-4">
                                    <p className="text-primary mb-1">الاسم</p>
                                    <span> {itemDetails.user && itemDetails.user.name}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">رقم الهوية</p>
                                    <span> {itemDetails.tenant_identity_number}</span>
                                </div>


                                <div className="mb-4">
                                    <p className="text-primary mb-1">رقم الجوال</p>
                                    <span dir="ltr">{itemDetails.tenant_mobile} </span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">تاريخ الانشاء</p>
                                    <span>{formatDateTimeStamp(itemDetails.created_at)}</span>
                                </div>
                            </div>
                            <div className="col-md-4 col-6">
                                <div className="mb-4">
                                    <p className="text-primary mb-1">المدينة</p>
                                    <span>{itemDetails.city_name}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">اجمالي الراتب</p>
                                    <span>{itemDetails.tenant_total_salary}</span>
                                </div>

                                <div className="mb-4">
                                    <p className="text-primary mb-1">نوع العقار</p>
                                    <span>{itemDetails.estate_type && itemDetails.estate_type.name_ar}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">الحي</p>
                                    <span>{itemDetails.neighborhood_name}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1"> نوع العمل</p>
                                    <span>{itemDetails.tenant_job_type}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">السعر</p>
                                    <span>{itemDetails.rent_price}</span>
                                </div>
                            </div>

                            <div className="col-md-4">
                                <div className="card bg-dark text-white o-hidden mb-4">
                                    <img
                                        className="card-img"
                                        src={itemDetails.tenant_identity_file}
                                        alt="Card"
                                        onError={(e) => { e.target.onerror = null; e.target.src = "/assets/images/default-id-card.png" }}
                                    />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        );
    }
}

export default deferredInstallmentsDetails;