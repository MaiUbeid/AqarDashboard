import http from "./../../http-common";

export const getStates = () => {
    return http.get(`state`);
};

export const getCities = (state) => {
    return http.get(`cities?state_id=${state}`);
};

export const getNeighborhood = (cityId) => {
    return http.get(`neighborhood/${cityId}`);
};

// estate/price
export const gePriceList = () => {
    return http.get(`estate/price`);
};

// estate/area
export const geAreaList = () => {
    return http.get(`estate/area`);
};

// estate/type
export const geTypeList = () => {
    return http.get(`estate/type`);
};