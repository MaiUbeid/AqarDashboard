import React, { Component } from "react";
import { Card } from "react-bootstrap";
import { Breadcrumb } from "@gull";

import { getItemDetails } from './../../../services/fundProvidersService';
import { Loading } from "@gull";


class FundProvidersDetails extends Component {
    state = {
        loading: false,
        itemId: '',
        itemDetails: {
            estate: {},
            provider: {}
        },
    };


    componentDidMount() {
        this.setState({ loading: true });
        this.setState({ itemId: this.props.match.params.id });
        if (this.props.match.params.id !== null) {
            getItemDetails(this.props.match.params.id).then(res => {
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
                        { name: "قائمة العروض المرسلة", path: "/fund/providers" },
                        { name: itemDetails.name }
                    ]}
                ></Breadcrumb>
                <div className="card m-sm-30 text-left">
                    {loading && <Loading></Loading>}

                    <div className={`card-body pt-4  ${loading ? 'invisible' : 'visible'}`}>
                        <h4>تفاصيل العقاري</h4>
                        <hr />
                        <div className="row">
                            <div className="col-md-4 col-6">
                                <div className="mb-4">
                                    <p className="text-primary mb-1">اسم العقاري</p>
                                    <span> {itemDetails.name}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">رقم المكتب</p>
                                    <span dir="ltr">{itemDetails.country_code}{itemDetails.mobile}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">تاريخ الانشاء</p>
                                    <span>{itemDetails.created_at}</span>
                                </div>
                            </div>
                            <div className="col-md-4 col-6">
                                <div className="mb-4">
                                    <p className="text-primary mb-1">العنوان</p>
                                    <span>{itemDetails.address}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1"> الحالة</p>
                                    <span>{itemDetails.status}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">اجمالي العروض المرسلة</p>
                                    <span>{itemDetails.count_offer}</span>
                                </div>
                            </div>
                            <div className="col-md-4 col-6">
                                <div className="mb-4">
                                    <p className="text-primary mb-1">إجمالي الطلبات</p>
                                    <span>{itemDetails.count_request}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">إجمالي المعاينات</p>
                                    <span>{itemDetails.count_visit}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">البريد الالكتروني</p>
                                    <span>{itemDetails.email}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        );
    }
}

export default FundProvidersDetails;
