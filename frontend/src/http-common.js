import axios from "axios";
import swal from "sweetalert2";
import localStorageService from './app/services/localStorageService';
import JwtAuthService from './app/services/jwtAuthService';

const user = JSON.parse(localStorage.getItem("userAqarz"));
axios.defaults.baseURL = process.env.REACT_APP_BASEURL;
//axios.defaults.headers.common["Content-type"] = "application/json";
if (user && user.api_token) {
  axios.defaults.headers.common["type"] = "admin";
  axios.defaults.headers.common["auth"] = "token " + user.api_token;
  axios.defaults.headers.common["role"] = user.role;
}
// console.log(user.api_token)
axios.interceptors.response.use(
  (successResponse) => {
    const dataExists = successResponse && (successResponse.status === 200 || successResponse.status === 201);
    if (dataExists) {
      if (successResponse.data.responseMessage) {
        let timer = 1200;
        if (successResponse.data.metadata && successResponse.data.metadata.isStaticAlert) timer = undefined;
        swal.fire({
          title: "عملية ناجحة",
          text: successResponse.data.responseMessage,
          type: "success",
          icon: "success",
          confirmButtonText: "حسناً",
          timer: timer,
        });
      }
    }
    return successResponse;
  },
  (error) => {
    const serveErrorResponse = error.message;
    //console.log(serveErrorResponse)
    //Check if the error is not server exception (custom made error or validation error)
    if (serveErrorResponse && serveErrorResponse.status >= 400 && serveErrorResponse.status < 500) {
      if (serveErrorResponse.status === 404) console.log("Server error details:" + serveErrorResponse); // window.location = "/not-found";
      else {
        // if (serveErrorResponse.status === 400) localStorage.removeItem("userAqarz");

        let errorMessage = "";
        //If an error message returned from the server, always display it.
        if (serveErrorResponse.data && serveErrorResponse.data.message) errorMessage = serveErrorResponse.data.message;

        //If we are working on the development mode, display the DB error messages.
        if (
          (axios.defaults.baseURL.includes("localhost")) &&
          serveErrorResponse.status === 400 &&
          serveErrorResponse.data.errors // dot net core errors object.
        ) {
          errorMessage += " " + return400ErrorMessage(serveErrorResponse.data.errors);
        }
        //#region Add support for error type 401 here.
        //Save the last request data to resend it again.
        //Call the refresh token api.
        //If success, recall the last request.
        //If failed, sign out.
        //#endregion
        if (!errorMessage) errorMessage = "Unknown error.";
        swal.fire({ title: "Error!", text: errorMessage, type: "error", icon: "error", confirmButtonText: "Close" });
      }
      return Promise.reject(error);
    }
    //500 internal server error.
    else if (serveErrorResponse && serveErrorResponse.status === 500) {
      let errorMessage = serveErrorResponse.data.responseMessage;
      if (axios.defaults.baseURL.includes("localhost") && serveErrorResponse.data.exceptionMessage)
        errorMessage = serveErrorResponse.data.exceptionMessage;
      console.error("Server error details:", serveErrorResponse.data, axios.defaults.baseURL);
      swal.fire({ title: "Server error message:", text: errorMessage, type: "error", icon: "error", confirmButtonText: "إغلاق" });
    }
    //Other error
    else swal.fire({ title: "Error!", text: error, type: "error", icon: "error", confirmButtonText: "Close" });
    return Promise.reject(error);
  }
);

//.net core 3.1 returns the errors object in the response as an array foreach element, so we need to loop through them to display them.
const return400ErrorMessage = (obj) => {
  let message = "";
  for (const property in obj) {
    for (let i = 0; i < obj[property].length; i++) {
      message = message + `${obj[property][i]} `;
    }
  }
  return message;
};

export default {
  get: axios.get,
  post: axios.post,
  put: axios.post,
  patch: axios.patch,
  delete: axios.delete,
  //setJWT
};
