import React, { Component } from "react";
import { Breadcrumb } from "@gull";
import { formatDateTimeStamp } from "@utils";
import { getFinanceDetails } from '../../../services/bankServcies';
import { Loading } from "@gull";


class financeRequestsDetails extends Component {
    state = {
        loading: false,
        itemId: '',
        itemDetails: {
            bank: {},
            estate_type: {},
            estate: {
                comforts: [],
                estate_file: []
            },
            provider: {}
        },
        itemImages: []
    };


    componentDidMount() {
        this.setState({ loading: true });
        this.setState({ itemId: this.props.match.params.id });
        if (this.props.match.params.id !== null) {
            getFinanceDetails(this.props.match.params.id).then(res => {
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
                        { name: "قائمة التمويل", path: "/bank/finance-requests" },
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
                                    <span> {itemDetails.name}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">رقم الهوية</p>
                                    <span> {itemDetails.identity_number}</span>
                                </div>
                                
                                
                                <div className="mb-4">
                                    <p className="text-primary mb-1">رقم الجوال</p>
                                    <span dir="ltr">{itemDetails.mobile} </span>
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
                                    <p className="text-primary mb-1">اسم البنك</p>
                                    <span>{itemDetails.bank.name_ar}</span>
                                </div>
                            
                                <div className="mb-4">
                                    <p className="text-primary mb-1">نوع العقار</p>
                                    <span>{itemDetails.estate_type.name_ar}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">الحي</p>
                                    <span>{itemDetails.neighborhood_name}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1"> نوع العمل</p>
                                    <span>{itemDetails.job_type}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">تاريخ بداية العمل</p>
                                    <span>{itemDetails.job_start_date}</span>
                                </div>
                            </div>

                            <div className="col-md-4">
                                <div className="card bg-dark text-white o-hidden mb-4">
                                    <img
                                        className="card-img"
                                        src={itemDetails.identity_file}
                                        alt="Card"
                                        onError={(e)=>{e.target.onerror = null; e.target.src="/assets/images/default-id-card.png"}}
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

export default financeRequestsDetails;