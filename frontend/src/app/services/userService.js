import http from "./../../http-common";
let controllerName = "";


// 
function login(user) {
  return http.post(`login`, user);
}


//////////////////////// 
function checkUserName(user) {
  return http.post(`${controllerName}/check-userName`, user);
}

function sendConfirmationCode(data) {
  return http.post(`${controllerName}/send-confirmation-code`, data);
}

function getProfileInfo() {
  return http.get(`${controllerName}/get-profile-info`);
}

function register(user, confirmationCode) {
  return http.post(`${controllerName}/register?confirmationCode=${confirmationCode}`, user);
}



function confirmCode(data) {
  return http.post(`${controllerName}/confirm-code`, data);
}

function updateProfile(data) {
  return http.post(`${controllerName}/update-profile`, data);
}

const uploadImage = (data) => {
  return http.post(`${controllerName}/upload-image`, data);
};

function changeUserName(user, confirmationCode) {
  return http.post(`${controllerName}/change-username?confirmationCode=${confirmationCode}`, user);
}

function changePassword(model) {
  return http.post(`${controllerName}/change-password`, model);
}
function forgotPassword(model) {
  return http.post(`${controllerName}/forgot-password`, model);
}
function resetPassword(model) {
  return http.post(`${controllerName}/reset-password`, model);
}
// function delayLoading(ms = 2000) {
//   return http.get("/test/delayloading?ms=" + ms);
// }

export default {
  register,
  login,
  confirmCode,
  checkUserName,
  sendConfirmationCode,
  getProfileInfo,
  updateProfile,
  uploadImage,
  changeUserName,
  changePassword,
  forgotPassword,
  resetPassword,
};
