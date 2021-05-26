import React, { Component } from "react";
import { Breadcrumb } from "@gull";
import BootstrapTable from "react-bootstrap-table-next";
import paginationFactory from "react-bootstrap-table2-paginator";
import ToolkitProvider, { Search } from "react-bootstrap-table2-toolkit";
import { SimpleCard } from "@gull";
import axios from "axios";
import { getMatchedRequests } from '../../services/estatesServices';


class MatchedRequestsInEstate extends Component {
    state = {
        userList: [],
        allList: [],
        sameList: [],
        estateId: '',
        type: 'all',
        page: 1,
        pagesCount: 0,
        page_number: 0,
        loading: false,
        estateId: null
    };

    defaultSorted = [
        {
            dataField: "name",
            order: "asc"
        }
    ];

    // get items list
    getItemsList = async (estateId, limit, page, type) => {
        this.setState({ loading: true });
        getMatchedRequests(
            estateId,
            page,
            limit,
            type
        ).then(res => {
            console.log(res);
            let allList = [];
            let sameList = [];
            if(type == 'all') {
                allList = [...res.data.data.data];
            } else {
                sameList = [...res.data.data.data];
            }
            this.setState({
                allList: [...allList],
                sameList: [...sameList],
                page: res.data.data.current_page,
                pagesCount: res.data.data.total,
                loading: false
            })
        });
    }

    componentDidMount() {
 
        this.setState({ estateId: this.props.estateId });
        if (this.props.estateId !== null) {
                this.getItemsList(this.props.estateId, this.state.page_number, this.state.page, 'all');
                this.getItemsList(this.props.estateId, this.state.page_number, this.state.page, 'same');
        }

        axios.get("/api/user/all").then(({ data }) => {
            let userList = data.map(
                ({ id, name, email, age, company, balance }, ind) => ({
                    id,
                    name,
                    email,
                    age,
                    balance,
                    company,
                    index: ind + 1
                })
            );
            this.setState({ userList });
        });
    }

    columns = [
        {
            dataField: "index",
            text: "No"
        },
        {
            dataField: "name",
            text: "User Name"
        },
        {
            dataField: "email",
            text: "User Email"
        },
        {
            dataField: "company",
            text: "Company"
        },
        {
            dataField: "balance",
            text: "Balance",
            align: "center",
            headerAlign: "center"
        },
        {
            dataField: "age",
            text: "Age",
            align: "center",
            headerAlign: "center"
        }
    ];

    sortableColumn = [
        {
            dataField: "index",
            text: "No",
            sort: true
        },
        {
            dataField: "name",
            text: "User Name",
            sort: true
        },
        {
            dataField: "email",
            text: "User Email",
            sort: true
        },
        {
            dataField: "company",
            text: "Company",
            sort: true
        },
        {
            dataField: "balance",
            text: "Balance",
            sort: true,
            align: "center",
            headerAlign: "center"
        },
        {
            dataField: "age",
            text: "Age",
            sort: true,
            align: "center",
            headerAlign: "center"
        }
    ];

    paginationOptions = {
        // custom: true,
        paginationSize: 5,
        pageStartIndex: 1,
        firstPageText: "First",
        prePageText: "Back",
        nextPageText: "Next",
        lastPageText: "Last",
        nextPageTitle: "First page",
        prePageTitle: "Pre page",
        firstPageTitle: "Next page",
        lastPageTitle: "Last page",
        showTotal: true,
        totalSize: this.state.userList.length
    };

    render() {
        let { userList } = this.state;
        let { SearchBar } = Search;

        return (
            <div>

                <SimpleCard>
                    <BootstrapTable
                        bootstrap4
                        keyField="id"
                        data={userList}
                        columns={this.sortableColumn}
                        defaultSorted={this.defaultSorted}
                        pagination={paginationFactory(this.paginationOptions)}
                        noDataIndication={"Table is empty"}
                    />
                </SimpleCard>
            </div>
        );
    }
}

export default MatchedRequestsInEstate;
