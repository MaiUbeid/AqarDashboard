import React, { Component } from "react";
import { Tabs, Tab, ProgressBar } from "react-bootstrap";
import { Breadcrumb } from "@gull";
import { formatDateTimeStamp } from "@utils";
import { getItemDetails, getMatchedOffers } from '../../services/requestsService';
import { Loading } from "@gull";
import OffersInRequest from './OffersInRequest';
import MatchedOffersInRequest from './MatchedOffersInRequest';

class RequestsDetails extends Component {
    state = {
        loading: false,
        itemId: '',
        itemDetails: {},
        matchedList: []
    };


    componentDidMount() {
        this.setState({ loading: true });
        this.setState({ itemId: this.props.match.params.id });
        if (this.props.match.params.id !== null) {
            getItemDetails(this.props.match.params.id).then(res => {
                this.setState({ itemDetails: res.data.data, loading: false });
                // getMatchedOffers(this.state.itemDetails.uuid, 0, 15).then(matchedList => {
                //     this.setState({ matchedList: matchedList.data.data });
                // });
            });

        }
    }

    render() {
        let {
            loading,
            itemId,
            itemDetails,
            matchedList
        } = this.state;
        return (
            <div>
                <Breadcrumb
                    routeSegments={[
                        { name: "الرئيسية", path: "/" },
                        { name: "قائمة الطلبات", path: "/requests" },
                        { name: itemDetails.uuid }
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
                                    <p className="text-primary mb-1">المساحة</p>
                                    <span> {itemDetails.area_estate_range}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">المدينة</p>
                                    <span>{itemDetails.city_name_web} </span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">تاريخ انشاء الطلب</p>
                                    <span>{formatDateTimeStamp(itemDetails.created_at)}</span>
                                </div>
                            </div>
                            <div className="col-md-4 col-6">
                                <div className="mb-4">
                                    <p className="text-primary mb-1">السعر</p>
                                    <span>{itemDetails.estate_price_range}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1"> الحالة</p>
                                    <span>{itemDetails.estate_status}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">نوع العقار</p>
                                    <span>{itemDetails.estate_type_name_web}</span>
                                </div>
                            </div>
                            <div className="col-md-4 col-6">
                                <div className="mb-4">
                                    <p className="text-primary mb-1">الحي</p>
                                    <span>{itemDetails.neighborhood_name}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">مساحة الشارع</p>
                                    <span>{itemDetails.street_view_range}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">عدد العروض المقدمة</p>
                                    <span>{itemDetails.count_offers}</span>
                                </div>
                            </div>
                            <div className="col-md-12">
                                <hr />
                                <Tabs defaultActiveKey="MatchedOffersInRequest">
                                    <Tab eventKey="MatchedOffersInRequest" title="العروض المطابقة">
                                        <MatchedOffersInRequest offers={matchedList} uuid={itemDetails.uuid} type={`same`} ></MatchedOffersInRequest>
                                    </Tab>
                                    <Tab eventKey="OffersInRequest" title="العروض المقاربة">
                                        <MatchedOffersInRequest offers={matchedList} uuid={itemDetails.uuid} type={`all`} ></MatchedOffersInRequest>
                                    </Tab>
                                </Tabs>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default RequestsDetails;
