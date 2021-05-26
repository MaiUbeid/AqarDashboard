import http from "./../../http-common";

// Get All bank/finance/requests
export const getFinanceRequestsList = (status, estate_type_id, city_id, form_date, to_date, state_id, page_number, search, page) => {
    return http.get(`bank/finance/requests?status=${status}&estate_type_id=${estate_type_id}&city_id=${city_id}&form_date=${form_date}&to_date=${to_date}&state_id=${state_id}&page_number=${page_number}&search=${search}&page=${page}`);
};

// bank/finance/1/show
export const getFinanceDetails = (id) => {
    return http.get(`bank/finance/${id}/show`);
}

// bank/finance/update/status
export const updateFinanceStatus = (body) => {
    return http.post(`bank/finance/update/status`, body);
}



// Get All bank/deferred/installments/requests
export const getDeferredRequestsList = (status, estate_type_id, city_id, form_date, to_date, state_id, page_number, search, page) => {
    return http.get(`bank/deferred/installments/requests?status=${status}&estate_type_id=${estate_type_id}&city_id=${city_id}&form_date=${form_date}&to_date=${to_date}&state_id=${state_id}&page_number=${page_number}&search=${search}&page=${page}`);
};

// deferred/installments/6/show
export const getDeferredDetails = (id) => {
    return http.get(`bank/deferred/installments/${id}/show`);
}