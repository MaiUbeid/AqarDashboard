import http from "../../http-common";

// Get All
export const getList = (page, state_id, offer_status, time, estate_type_id, area_estate_id, dir_estate_id, estate_price_id, city_id, neighborhood_id, form_date, to_date, page_number, uuid) => {
    return http.get(`fund/requests?page=${page}&state_id=${state_id}&offer_status=${offer_status}&time=${time}&estate_type_id=${estate_type_id}&area_estate_id=${area_estate_id}&dir_estate_id=${dir_estate_id}&estate_price_id=${estate_price_id}&city_id=${city_id}&neighborhood_id=${neighborhood_id}&form_date=${form_date}&to_date=${to_date}&page_number=${page_number}&uuid=${uuid}`);
};

export const getItemDetails = (id) => {
    return http.get(`fund/request/${id}/show`);
}

// fund/available/estate/offers/56fef866-88c0-4bfe-ac9f-133aeeda13bd?search_type=all
export const getMatchedOffers = (uuid, page, page_number, type) => {
    return http.get(`fund/available/estate/offers/${uuid}?page=${page}&page_number=${page_number}&search_type=${type}`);
}

// fund/send/offer/fund/dash
export const sendMatchedOffer = (body) => {
    return http.post(`fund/send/offer/fund/dash`, body);
}
