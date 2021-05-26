import React, { Component } from "react";
import { Breadcrumb } from "@gull";
// import { getList } from '../../services/estatesServices';
// import {
//     getCities,
//     getStates,
//     getNeighborhood,
//     geAreaList,
//     geTypeList,
//     gePriceList
// } from '../../services/settingsServcie';
import { Loading } from "@gull";
import EstateCard from '../common/EstateCard';

class estateList extends Component {
    state = {
        page: 1,
        pagesCount: 0,
        loading: false,
        list: [],
        data: '',
        states: [
            {
                value: "الرياض",
                id: 1
            }
        ],
        cities: [],
        neighborhood: [],
        typeList: [],
        areaList: [],
        priceList: [],

        page_number: 10, // limit items
        estates: [{ id: 1, name: ' فيلا', image: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80', reason: '' }, { id: 2, name: ' فيلا', image: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80', reason: '' }, { id: 3, name: ' فيلا', image: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80', reason: '' }, { id: 4, name: ' فيلا', image: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80', reason: '' }, { id: 5, name: ' فيلا', image: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80', reason: '' }, { id: 6, name: ' فيلا', image: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80', reason: '' }]
    };


    //   updatePageData = () => {
    //     getStates().then(res => {
    //       this.setState({ states: res.data.data });
    //     });

    //     geAreaList().then(res => {
    //       this.setState({ areaList: res.data.data });
    //     });

    //     geTypeList().then(res => {
    //       this.setState({ typeList: res.data.data });
    //     });

    //     gePriceList().then(res => {
    //       this.setState({ priceList: res.data.data });
    //     });
    //     this.getItemsList(this.state.page_number, this.state.page);
    //   };

    //   // get items list
    //   getItemsList = async (limit, page) => {
    //     this.setState({ loading: true });
    //     getList(
    //       page,
    //       this.state.state_id,
    //       this.state.status,
    //       this.state.time,
    //       this.state.estate_type_id,
    //       this.state.area_estate_id,
    //       this.state.dir_estate_id,
    //       this.state.estate_price_id,
    //       this.state.city_id,
    //       this.state.neighborhood_id,
    //       this.state.form_date,
    //       this.state.to_date,
    //       limit,
    //       this.state.uuid
    //     ).then(res => {
    //       let list = [...res.data.data.data];
    //       this.setState({
    //         list: [...list],
    //         page: res.data.data.current_page,
    //         pagesCount: res.data.data.total,
    //         loading: false
    //       })
    //     });
    //   }

    //   onStatesChange = (e) => {
    //     if (e !== '') {
    //       getCities(e).then(res =>
    //         this.setState({
    //           cities: res.data.data
    //         })
    //       );
    //     } else {
    //       this.setState({
    //         neighborhood: [],
    //         cities: []
    //       })
    //     }
    //   };

    //   onCitiesChange = (e) => {
    //     if (e[0] && e[0].serial_city) {
    //       getNeighborhood(e[0].serial_city).then(res => {
    //         this.setState({
    //           neighborhood: res.data.data,
    //           city_id: e[0].serial_city
    //         })
    //       });
    //     } else {
    //       this.setState({
    //         neighborhood: [],
    //         cities: []
    //       })
    //     }
    //   };

    //   onNeighborhoodChange = (e) => {
    //     let list = [];
    //     e.forEach(element => {
    //       list.push(element.neighborhood_serial);
    //     });
    //     this.setState({ neighborhood_id: list });
    //   };

    //   handlePageClick = data => {
    //     let page = data.selected + 1;
    //     this.setState({ page: page });
    //     setTimeout(() => {
    //       this.getItemsList(this.state.page_number, page);
    //     }, 200);
    //   };

    //   getBadgeColor = role => {
    //     switch (role) {
    //       case "جديد":
    //         return "primary";

    //       case "مستعمل":
    //         return "success";

    //       default:
    //         return "primary";
    //     }
    //   };

    //   componentDidMount() {
    //     this._ismounted = true;
    //     this.updatePageData();
    //   }
    //   componentWillUnmount() {
    //     this._ismounted = false;
    //   }

    //   componentDidUpdate() {
    //     // this.updatePageData();
    //   }

    //   handlePageSizeChange = async (pageObj) => {
    //     this.setState({ page: 1, page_number: pageObj.value });
    //     this.getItemsList(pageObj.value, 1);
    //   };

    //   onSearch = () => {
    //     this.getItemsList(this.state.page_number, 1);
    //   }

    //   exportAllData = async () => {
    //     this.setState({ exportAllLoading: true });
    //     getList(
    //       1,
    //       this.state.state_id,
    //       this.state.status,
    //       this.state.time,
    //       this.state.estate_type_id,
    //       this.state.area_estate_id,
    //       this.state.dir_estate_id,
    //       this.state.estate_price_id,
    //       this.state.city_id,
    //       this.state.neighborhood_id,
    //       this.state.form_date,
    //       this.state.to_date,
    //       this.state.pagesCount,
    //       this.uuid
    //     ).then(res => {
    //       let list = [...res.data.data.data];
    //       let exportList = [];
    //       list.forEach(element => {
    //         exportList.push({
    //           uuid: element.uuid,
    //           address: element.address,
    //           estate_type_name_web: element.estate.estate_type_name_web,
    //           provider_name: element.provider.name,
    //           status_name: element.status_name,
    //           mobile: element.provider.country_code + element.provider.mobile,
    //           date: formatDateTimeStamp(element.estate.created_at),
    //           city_name: element.estate.city_name,
    //           neighborhood_name: element.estate.neighborhood_name_web,
    //           total_price: element.estate.total_price,
    //           total_area: element.estate.total_area
    //         });
    //       });

    //       exportexcel(exportList, 'Offers_');
    //       this.setState({ exportAllLoading: false });

    //     });
    //   }

    render() {
        let { loading, estates } = this.state;

        return (
            <div>
                <Breadcrumb
                    routeSegments={[
                        { name: "الرئيسية", path: "/" },
                        { name: "قائمة العقارات " }
                    ]}
                ></Breadcrumb>

                <section className="contact-list">
                    <div className="row">
                        <div className="col-md-12 mb-4">
                            <div className="card text-left">
                                <div className="row px-4 mt-3">
                                    {estates.map(item => {
                                        return (
                                            <div className="col-md-4">
                                                <EstateCard key={item.id} imageUrl={item.image} />
                                            </div>
                                        )
                                    })}
                                </div>
                                {loading && <Loading></Loading>}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        );
    }
}

export default estateList;
