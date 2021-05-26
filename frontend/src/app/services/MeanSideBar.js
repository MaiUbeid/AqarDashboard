import http from "./../../http-common";
// Get Mean Side Bar

export const getMeanSideBar = () => {
    return http.get(`/getMeanSideBar`);
}

export const getMeanSideBarUser = () => {
    return http.get(`/getMeanSideBarUser`);
}
