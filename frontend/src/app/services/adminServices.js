import http from "../../http-common";

// Get All users
export const getUsersList = (page, status, type, page_number, search, form_date, to_date, is_verified) => {
    return http.get(`admin/users?page=${page}&status=${status}&type=${type}&page_number=${page_number}&search=${search}&form_date=${form_date}&to_date=${to_date}&is_verified=${is_verified}`);
};

export const getUsersDetails = (id) => {
    return http.get(`admin/user/${id}/show`);
}

export const setUserActivationStatus = (value) => {
    return http.post(`admin/user/status`, value);
}
