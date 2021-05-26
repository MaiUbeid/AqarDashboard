import React, { Component } from "react";
import { Card } from "react-bootstrap";
import { Breadcrumb } from "@gull";
import { formatDateTimeStamp } from "@utils";
import { getItemDetails } from '../../services/offersService';
import { Loading } from "@gull";


class OffersDetails extends Component {
    state = {
        loading: false,
        itemId: '',
        itemDetails: {
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
                        { name: "قائمة العروض المرسلة", path: "/offers" },
                        { name: itemDetails.uuid }
                    ]}
                ></Breadcrumb>
                <div className="card m-sm-30 text-left">
                    {loading && <Loading></Loading>}

                    <div className={`card-body pt-4  ${loading ? 'invisible' : 'visible'}`}>
                        <h4>تفاصيل العرض</h4>
                        <hr />
                        <div className="row">
                            <div className="col-md-4 col-6">
                                <div className="mb-4">
                                    <p className="text-primary mb-1">اسم المكتب</p>
                                    <span> {itemDetails.provider.user_name}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">رقم المكتب</p>
                                    <span dir="ltr">{itemDetails.provider.country_code}{itemDetails.provider.mobile} </span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">تاريخ الانشاء</p>
                                    <span>{formatDateTimeStamp(itemDetails.created_at)}</span>
                                </div>
                            </div>
                            <div className="col-md-4 col-6">
                                <div className="mb-4">
                                    <p className="text-primary mb-1">المدينة</p>
                                    <span>{itemDetails.estate.city_name}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1"> الحالة</p>
                                    <span>{itemDetails.status_name}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">نوع العقار</p>
                                    <span>{itemDetails.estate.estate_type_name_web}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">الحي</p>
                                    <span>{itemDetails.estate.neighborhood_name}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">السعر</p>
                                    <span>{itemDetails.estate.total_price}</span>
                                </div>
                                <div className="mb-4">
                                    <p className="text-primary mb-1">إجمالي المساحة</p>
                                    <span>{itemDetails.estate.total_area}</span>
                                </div>
                            </div>

                            <div className="col-md-4">
                                <div className="card bg-dark text-white o-hidden mb-4">
                                    <img
                                        className="card-img"
                                        src={itemDetails.estate.first_image}
                                        alt="Card"
                                    />
                                    <div className="card-img-overlay">
                                        <h5 className="card-title text-white">العنوان</h5>
                                        <p className="card-text">{itemDetails.estate.address}</p>
                                        <p className="card-text">
                                            {itemDetails.estate.comforts.map((item, ind) => (
                                                <img width="50" className="p-1" key={ind} src={item.icon} alt={item.name_ar} />
                                            ))}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <h3 className="mb-2">صور العرض</h3>
                        <div className="row">
                            {
                                itemDetails.estate.estate_file.map((item, ind) => (
                                    <div className="col-md-4">
                                        <a key={ind} href={item.file} target="_blank"><img className="img-thumbnail" src={item.file} /></a>
                                    </div>
                                ))}
                        </div>
                    </div>
                </div>
            </div>

        );
    }
}

export default OffersDetails;
