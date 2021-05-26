import axios from "axios";
import http from "./../../http-common";
import localStorageService from "./localStorageService";
import { roles } from "app/services/role";
import history from "@history.js";

class JwtAuthService {

  user = {
    userId: "1",
    role: "ADMIN",
    fullName: "",
    userName: "",
    photoURL: "/assets/images/face-7.jpg",
    age: 25,
    token: "",
  };

  loginWithEmailAndPassword = (username, password, type) => {
    return http.post(process.env.REACT_APP_BASEURL + "login", { username, password, type }).then((response) => {
      this.setSession(response.data.data.api_token, response.data.data.role);
      this.setUser(response.data.data);

      switch (response.data.data.role) {
        case roles.fund:
          history.push('/fund/dashboard');
          break;
        case roles.bank:
          history.push('/bank/dashboard');
          break;
        case roles.admin:
          history.push('/admin/users');
          break;
        default:
          history.push('/session/signin');
      }

      window.location.reload();
      return response.data;
    });
  };



  loginWithToken = () => {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        resolve(localStorageService.getItem("userAqarz"));
      }, 100);
    }).then((data) => {
      if (data) this.setSession(data.api_token, data.role);
      else this.setSession(null, null);
      this.setUser(data);
      return data;
    });
  };



  logout = () => {
    this.setSession(null, null);
    this.removeUser();
    window.location = "/session/signin";
  }

  setSession = (token, role) => {
    if (token) {
      localStorage.setItem("jwt_token", token);
      // axios.defaults.headers.common["Authorization"] = "Bearer " + token;
      // axios.defaults.headers.common["auth"] = "token " + token;
      // axios.defaults.headers.common["role"] = role;
    } else {
      localStorage.removeItem("jwt_token");
      delete axios.defaults.headers.common["Authorization"];
    }
  };
  setUser = (user) => {
    localStorageService.setItem("userAqarz", user);
  }
  removeUser = () => {
    localStorage.removeItem("userAqarz");
  }
}

export default new JwtAuthService();
