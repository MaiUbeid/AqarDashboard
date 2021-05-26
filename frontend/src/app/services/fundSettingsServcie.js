import http from "./../../http-common";

// Get All
// export const getList = (request_fund, form_date, to_date, time) => {
//     return http.get(`fund/dashboard?request_fund=${request_fund}&from_date=${form_date}&to_date=${to_date}&time=${time}`);
// };
export const getList = () => {
    return http.get(`fund/dashboard`);
};

export const getDashMap = () => {
    return http.get(`getDashMap`);
};

// getDashYear?year=2021
export const getDashYear = (year) => {
    return http.get(`getDashYear?year=${year}`);
}
