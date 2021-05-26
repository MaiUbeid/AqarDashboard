import { lazy } from "react";
import { roles } from "./../../services/role";


const Dashboard1 = lazy(() => import("./dashboard1/Dashboard1"));

const dashboardRoutes = [
  // {
  //   path: "/admin/dashboard",
  //   component: Dashboard1,
  //   auth: roles.admin,
  // },
  {
    path: "/bank/dashboard",
    component: Dashboard1,
    auth: [roles.bank],
  }
];

export default dashboardRoutes;
