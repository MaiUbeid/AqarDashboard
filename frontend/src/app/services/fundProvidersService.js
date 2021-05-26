import http from "./../../http-common";

// Get All
export const getList = (page, user_status, time, form_date, to_date, page_number) => {
    return http.get(`fund/providers?page=${page}&user_status=${user_status}&time=${time}&form_date=${form_date}&to_date=${to_date}&page_number=${page_number}`);
};

export const getItemDetails = (id) => {
    return http.get(`fund/provider/${id}/show`);
}
