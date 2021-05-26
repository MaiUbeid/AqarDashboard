import http from "../../http-common";

// Get All
export const getList = (page, state_id, status, time, estate_type_id, area_estate_id, dir_estate_id, estate_price_id, city_id, neighborhood_id, form_date, to_date, page_number, uuid) => {
    return http.get(`fund/offers?page=${page}&state_id=${state_id}&status=${status}&time=${time}&estate_type_id=${estate_type_id}&area_estate_id=${area_estate_id}&dir_estate_id=${dir_estate_id}&estate_price_id=${estate_price_id}&city_id=${city_id}&neighborhood_id=${neighborhood_id}&form_date=${form_date}&to_date=${to_date}&page_number=${page_number}&uuid=${uuid}`);
};

export const getItemDetails = (id) => {
    return http.get(`fund/offer/${id}/show`);
}
